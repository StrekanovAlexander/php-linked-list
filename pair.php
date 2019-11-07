<?php

function cons($x, $y) {
  return function($fn) use ($x, $y) {
    return $fn($x, $y);
  };
}

function car(callable $pair) {
  $fn = function($x, $y) {
    return $x;
  };
  return $pair($fn);
}

function cdr(callable $pair) {
  $fn = function($x, $y) {
    return $y;
  };
  return $pair($fn);
}

function makeList() {
  $arr = func_get_args();
  if (!$arr) {
    return null;
  }
  
  $list = null;

  while ($arr) {
    $elem = array_pop($arr);
    $list = cons($elem, $list);
  }

  return $list;
}

function toString($list) {
  if ($list === null) {
    return '()';
  }

  $iter = function ($list, $acc) use (&$iter) {
    return $list === null ? substr($acc, 0, -1) : $iter(cdr($list), $acc . car($list) . ',');
  };

  return $iter($list, '');
}