<?php
function sum_strings($a, $b) {
  echo $a . PHP_EOL . $b . PHP_EOL . '--------------' . PHP_EOL;
  $carry = 0;
  $r = '';
  $a = strrev($a);
  $b = strrev($b);
  
  for ($i = 0; $i <= max(strlen($a), strlen($b)); $i++) {
    $s = $a[$i] + $b[$i] + $carry;
    $r = ($s % 10) . $r;
    $carry = floor($s/10);
  }
  
  if ($carry) $r = $carry . $r;

  return ltrim($r, '0');
}

echo sum_strings("123", "456");