<?php

function e (string $string) {
  return htmlentities($string);
}

function titleVehicle (string $make, string $model, ?float $engineCapacity, int $power): string {
  if (isset($engineCapacity) === true) {
    return $make . ' ' . $model . ' ' . $engineCapacity . 'l ' . $power . 'cv';
  } else {
    return $make . ' ' . $model . ' ' . $power . 'cv';
  }
}

function cardElements (string $component, $value) {
  return '
    <div class="plan">
      <span class="elements">' . $component . '</span>
      <span class="features">'. $value . '</span>
    </div>';
}