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
