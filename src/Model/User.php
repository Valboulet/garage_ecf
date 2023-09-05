<?php
namespace App\Model;

class User extends Person {

  protected $password;

  public function getPassword (): string
  {
    return $this->password;
  }
}