<?php
require 'pair.php';

$list = makeList(1, 2, 3, 4, 5);
$list2 = makeList(6, 7, 8);

// echo toString($list);
// echo '<br>';
// echo length($list2);
// echo '<br>';
// echo append($list, $list2);

$fn = function($x, $acc){return $x + $acc;};
echo $reduce($fn, $list, 0); 