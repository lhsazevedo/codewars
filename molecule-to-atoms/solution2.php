<?php

function parse_molecule(string $formula): array
{
    $chars = str_split($formula);
    $el = '';
    $mul = '';
    $r = [];
    $level = 0;

    for ($pos = 0; $pos < count($chars); $pos++) {
        $char = $chars[$pos];

        if ($level) {
            if (in_array($char, ['[', '{', '('])) {
                $level++;
                $el .= $char;

                continue;
            } elseif (in_array($char, [']', '}', ')'])) {
                $level--;

                if ($level === 0) {
                    $sr = parse_molecule($el);
                    if (is_numeric($chars[$pos + 1])) {
                        if (is_numeric($chars[$pos + 2])) {
                            $multiplier = (int) ($chars[$pos + 1] . $chars[$pos + 2]);
                        } else {
                            $multiplier = $chars[$pos + 1];
                        }
                    } else {
                        $multiplier = 1;
                    }
                    $sr = array_map(function ($v) use ($multiplier) { return $v * $multiplier; }, $sr);
                    foreach ($sr as $sel => $v) {
                        if ($r[$sel]) $r[$sel] += $v;
                        else $r[$sel] = $v;
                    }
                    $el = '';
                    continue;
                }

                $el .= $char;
                continue;
            } else {
                $el .= $char;
                continue;
            }
        }

        if ($el && ctype_upper($char)) {
            if ($r[$el]) $r[$el]++;
            else $r[$el] = 1;
            $el = $char;
            continue;
        } elseif ($el && is_numeric($char)) {
            $mul .= $char;
            if (is_numeric($chars[$pos + 1])) {
                continue;
            }
            
            if ($r[$el]) $r[$el] += (int) $mul;
            else $r[$el] = (int) $mul;
            $mul = '';
            $el = '';
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

            $group = true;
        }
    }

    if ($el) {
        if ($r[$el]) $r[$el]++;
        else $r[$el] = 1;
    }

    return $r;
}

// echo json_encode(parse_molecule('H2O')) . PHP_EOL;
// echo json_encode(parse_molecule('Mg(OH)2')) . PHP_EOL;
// echo json_encode(parse_molecule('K4[ON(SO3)2]2')) . PHP_EOL;
// echo json_encode(parse_molecule('C6H12O6')) . PHP_EOL;
// echo json_encode(parse_molecule('(C5H5)Fe(CO)2CH3')) . PHP_EOL;
// echo json_encode(parse_molecule('UubFUub(Na(Si(MgOFUuoHe)12FB(SiCUunCCFeHOPN)5Mg(KUtnSiAlClUunMg)18)11UqnSUub)4(LiUuoUub((BeKUSiNaUbnHeUuu)25ArU(UubHeUubArOSUubO)10Mg(CUClUtnHeUUupCaF)14He)21FeArUbnUupF(SFKUtn(UupFeNaFeClNe)13(SKAlPUub)11MgH(SUupSiMgFCMg)10)25)5(((NHAlHAl)22K(UtnNeUuuAlUbnNaUtnLi)19CaUuuK(BCaAlKCAl)13FeAl)3((CFNeKUuuMgU)10SNaClHeHePU)10(AlH(MgHeAlMgUtnKCNeAlCa)9(NaSBeUubUupUqnKO)11Mg(UuoOArUunArLiUupUubUuo)18(SLiUuoUuoOKFeH)25Uun(UupUMgUuoMgUuoAlPAl)17)6(OB(UUupUqnUCaOHCAlBe)8(LiFeNaCaUuoNaSSAr)2BLi(BeUtnFeUubUuuSiMgN)5U)24Na((UbnPNaUqnCAlArUun)12(UtnHeNeCNaHeNeUqnNeUbn)23(OFLiBBUtnCUbnUunFe)23(UtnBUuoKUqn)3(BCaNUtnUubClPUuoUP)8(BNeCaBeUbnSiNeOSiUqn)21(NaArUuuClOUupUun)24(FeUupUqnUupUubPH)13)9SiS((CAlUUqnKOS)4AlNKUupNaC)12((BeBeCSUtnUtnUbnPArUqn)4(UbnUtnUMgUbnOCa)20(MgUqnAlFeBe)21(FUubUuuNClOHeUbnK)18Utn(UubArOHLi)24)13)5(((PClNaNeUuoUun)16(CCMgHeArMg)22Ubn(OHeMgHeUtnUupAl)5FeUunNeBe(UtnOUqnCSUunOCaUuuF)18Li)23BeFB(NeS(UupNNeUNa)20N(SAlArCArUqnArUtn)13(UqnCaUunUtnSCaNeHeUuo)6Ne)19((BeFNHeBe)4B(KHeUtnClUunMgUbnHe)8BULiCl(UubKSiFAlBBUbnBeUub)23P)4(O(BUtnOUunUupUuoUqnOMg)25S(ClUubUqnSUqn)25Be(ClLiUubMgBLi)17Mg)24((BNaUtnHeLiUunUuuBeNa)10(ULiCaUubBeMgUqn)23(UbnUuoAlUubUbnLiFe)24Ca(BNNaCNaNaCaUuoUtnLi)20)16)9Uun')) . PHP_EOL;
