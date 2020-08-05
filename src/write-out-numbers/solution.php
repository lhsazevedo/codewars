<?php

function number2words(int $n): string {
  $r = [];
  $units = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine',
            'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
  $tenths = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
  
  if (isset($units[$n])) return $units[$n];

  foreach (['thousand' => 1000, 'hundred' => 100] as $name => $value) {
    if ($n && $u = (int) ($n/$value)) {
      echo $u . PHP_EOL;
      $r[] = number2words($u) . " " . $name;
      $n -= $u * $value;
    }
  }

  if ($n >= 20) {
    $t = (int) ($n/10);
    $tr = $tenths[$t-2];
    if ($n % 10 > 0) {
      $tr .= "-" . $units[($n % 10)];
    }
    $r[] = $tr;
  } elseif ($n >= 1) {
    $r[] = $units[$n];
  }
  
  return join(' ', $r);
}

var_dump(number2words(3052));
