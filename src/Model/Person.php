<?php
namespace App\Model;

class Person {

  protected $id;
  protected $first_name;
  protected $last_name;
  protected $email;

  public function getId (): int
  {
    return $this->id;
  }
  public function getFirstName (): string
  {
    return e($this->first_name);
  }
  public function getLastName (): string
  {
    return e($this->last_name);
  }
  public function getEmail ():string
  {
    return e($this->email);
  }
}