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

function length($list) {
  if ($list === null) {
    return 0;
  } 
  $iter = function ($l, $acc) use (&$iter) {
    return $l === null ? $acc : $iter(cdr($l), $acc + 1);
  };
  return $iter($list, 0);
}

function append($list1, $list2) {
  if ($list2 === null) {
    return $list1;
  }
  if ($list1 === null) {
    return null;
  }
  return append(cdr($list1), cons(car($list1), $list2));  
}

function sum($list) {
  $iter = function ($l, $acc) use (&$iter) {
    if ($l === null) {
      return $acc;
    }
    return $iter(cdr($l), $acc + car($l));
  };

  return $iter($list, 0);
}

$map = function ($fn, $list) use (&$map) {
  if ($list === null) {
    return null;
  }
  $rest = $map($fn, cdr($list));
  return cons($fn(car($list)), $rest);
};

$filter = function ($fn, $list) use (&$filter) {
  if ($list === null) {
    return null;
  }
  $rest = $filter($fn, cdr($list));
  return $fn(car($list)) ? cons(car($list), $rest) : $rest;
};

$reduce = function ($fn, $list, $acc) use (&$reduce) {
  return $list === null ? $acc : $reduce($fn, cdr($list), $fn(car($list), $acc));
};