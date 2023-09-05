<?php
namespace App\Model;

class Equipment {

  private $id;
  private $specification;

  public function getId (): int
  {
    return $this->id;
  }
  public function getSpecification (): string
  {
    return e($this->specification);
  }
}