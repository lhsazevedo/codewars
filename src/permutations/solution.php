<?php

function permutations(string $s): array {
    if (strlen($s) == 1) return [$s];
    $r = [];
    foreach (str_split($s) as $i => $ca) {
      foreach (str_split($s) as $i => $cb) {
        if ($ca === $cb or in_array($ca . $cb, $r)) continue;
        $r[] = $ca . $cb;
      }
    }
    
    return $r;
  }

print_r (permutations('a'));