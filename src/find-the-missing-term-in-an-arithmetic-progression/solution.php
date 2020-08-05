<?php

function findMissing($list) {
  $first = $list[0];
  $last = end($list);
  
  if ($first === $last) {
    return $first;
  }
  
  $step = (end($list) - $list[0]) / count($list);
  
  $found = false;
  $l = 0;
  $r = count($list) - 1;
  $mid = floor($r/2);
  while (!$found) {
    $expected = (int) ($first + $mid * $step);
    if ($list[$mid] !== $expected) {
      if ($list[$mid - 1] === $expected) {
        $r = $mid-1;
        $mid = $l + floor(($r - $l)/2);
      } else {
        return $expected;
      }
    } else {
      $l = $mid+1;
      $mid = $l + floor(($r - $l)/2);     
    }
  }
}

var_dump(findMissing([1, 2, 3, 4, 5]));
var_dump(findMissing([1, 3, 4]));
var_dump(findMissing([1, 3, 5, 9, 11]));
var_dump(findMissing([100, 200, 300, 500]));