<?php

function parse_molecule(string $formula): array {
  $pos = 0;
  $mode = 'none';
  $mol = '';
  $cur = [];
  $r = [];
  $level = 0;
  while(true) {
    # If we hit the end
    if ($pos === strlen($formula)) {
      if ($mol) {
        $cur[$mol] = 1;
        break;
      }
    }

    $char = $formula[$pos];
    switch ($mode) {
      case 'none':
        $mol = $char;
        $mode = 'mol';
        break;
      
      case 'mol':
        if (ctype_alpha($char)) {
          if (ctype_lower($char)) {
            $mol .= $char;
          } else {
            $cur[] = $mol;
            $mol = $char;
          }
        } else {
          if (is_numeric($char)) {
            $cur[$mol] = (int) $char;
            $mol = '';
            $mode = '';
          } elseif (in_array($char, ['[', '{', '('])) {
            $level++;
          } elseif(in_array($char, [']', '}', ')'])) {
            $level--;
          }
        }
        break;
    }
    $pos++;
  }

  return $r;
}

parse_molecule('H2O');