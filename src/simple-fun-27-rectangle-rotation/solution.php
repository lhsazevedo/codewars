<?php 

function rectangle_rotation($a, $b): int {
  $points = [[-$a/2, $b/2], [$a/2, $b/2], [$a/2, -$b/2], [-$a/2,-$b/2]];

  // var_dump($points);
  
  print_r(array_map(function ($p) { return [ 
    $p[0] * cos(0.7853982) - $p[1] * sin(0.7853982),
    $p[0] * sin(0.7853982) + $p[1] * cos(0.7853982) ];
    }, $points));

  return 1;
}

var_dump(rectangle_rotation(6, 4));