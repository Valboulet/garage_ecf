<?php
namespace App\Model;

class Administrator extends User {

  private $opening_hours;

  public function getOpeningHours (): string
  {
    return e($this->opening_hours);
  }
}