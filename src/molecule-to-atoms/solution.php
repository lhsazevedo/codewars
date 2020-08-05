<?php

function parse_molecule(string $formula): array
{
    $chars = str_split($formula);
    $el = '';
    $mul = '';
    $r = [];
    $sr = [];
    $level = 0;
    $mode = '';

    for ($pos = 0; $pos < count($chars); $pos++) {
        $char = $chars[$pos];

        switch ($mode) {
            case '':
                $el = $char;
                $mode = 'el';
                break;
            
            case 'el':
                if (ctype_upper($char)) {
                    $r[$el] = 1;
                } elseif (ctype_lower($char)) {

                } elseif () {

                }

                break;
        }

        if ($level) {
            if (in_array($char, ['[', '{', '('])) {
                $level++;
            } elseif (in_array($char, [']', '}', ')'])) {
                $level--;

                if ($level === 0) {
                    $sr = parse_molecule($el);
                    $el = '';
                    continue;
                }
            }

            $el .= $char;
            continue;
        }

        if ($el && ctype_upper($char)) {
            if ($r[$el]) $r[$el]++;
            else $r[$el] = 1;
            $el = $char;
            continue;
        } elseif (($el or $sr) && is_numeric($char)) {
            $mul .= $char;
            if (is_numeric($chars[$pos + 1])) {
                continue;
            }
            
            if ($el) {
                if ($r[$el]) $r[$el] += (int) $mul;
                else $r[$el] = (int) $mul;
                $el = '';
            } else {
                $sr = array_map(fn ($v) => $v * $mul, $sr);
                foreach ($sr as $sel => $v) {
                    if ($r[$sel]) $r[$sel] += $v;
                    else $r[$sel] = $v;
                }
                $sr = [];
            }
            $mul = '';
            continue;
        } elseif ((!$el && ctype_alpha($char)) or ($el && ctype_lower($char))) {
            $el .= $char;
            continue;
        } elseif (in_array($char, ['[', '{', '('])) {
            // @TODO: Remover duplicado abaixo
            if ($el) {
                if ($r[$el]) $r[$el]++;
                else $r[$el] = 1;
            }

            $el = '';
            $level++;
        }
    }

    if ($el) {
        if ($r[$el]) $r[$el]++;
        else $r[$el] = 1;
    }

    return $r;
}

// $sr = array_map(fn ($v) => $v * $mul, $sr);
function mergEls($a, $b) {
    $r = [];
    foreach ($b as $bk => $bv) {
        if ($a[$bk]) $r[$bk] = $a[$bk] + $bv;
        else $r[$bk] = $bv;
    }
    $sr = [];
}

echo json_encode(parse_molecule('H2O')) . PHP_EOL;
echo json_encode(parse_molecule('K4[ON(SO3)2]2')) . PHP_EOL;
