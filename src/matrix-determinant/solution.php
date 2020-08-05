<?php

function determinant(array $matrix): int {
  if (count($matrix) === 1) {
    return $matrix[0][0];
  }
  
  if (count($matrix) === 2) {
    return $matrix[0][0] * $matrix[1][1] - $matrix[0][1] * $matrix[1][0];
  }
  
  $d = 0;
  foreach ($matrix as $i => $row) {
    if ($i%2) {
      $d -= $matrix[0][$i] * determinant(minor($matrix, $i));
    } else {
      $d += $matrix[0][$i] * determinant(minor($matrix, $i));
    }
  }

  return $d;
}

function minor($array, $c) {
  return array_map(
    function ($i) use ($c) {
      return [...array_slice($i, 0, $c), ...array_slice($i, $c+1)];
    },
    array_slice($array, 1)
  );
//   $r = [];
//   foreach($array as $i => $row) {
//     if ($i !== 0) {
//         $r[] = ;
//     }
//   }

//   return $r;
}

determinant([[2, 5, 3],
[1, -2, -1],
[1, 3, 4]]);
