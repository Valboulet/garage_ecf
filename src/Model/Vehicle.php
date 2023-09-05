<?php
namespace App\Model;

use \DateTime;

class Vehicle {

  private $ad_number;
  private $make;
  private $model;
  private $body_type;
  private $fuel_type;
  private $engine_capacity;
  private $price;
  private $power;
  private $mileage;
  private $first_registration;
  private $warranty;

  public function getAdNumber (): int
  {
    return $this->ad_number;
  }  
  public function getMake (): string
  {
    return e($this->make);
  }
  public function getModel (): string
  {
    return e($this->model);
  }
  public function getBodyType (): string
  {
    return e($this->body_type);
  }  
  public function getFuelType (): string
  {
    return e($this->fuel_type);
  }
  public function getEngineCapacity (): ?float
  {
    return $this->engine_capacity;
  }
  public function getPrice (): int
  {
    return $this->price;
  }
  public function getPower (): int
  {
    return $this->power;
  }
  public function getMileage (): int
  {
    return $this->mileage;
  }
  public function getFirstRegistration (): DateTime
  {
    return new DateTime(e($this->first_registration));
  }
  public function getWarranty (): int
  {
    return $this->warranty;
  }
}