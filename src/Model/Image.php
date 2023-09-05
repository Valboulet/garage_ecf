<?php
namespace App\Model;

class Image {

  private $id;
  private $image_file_name;
  private $vehicle_id;

  public function getId (): int
  {
    return $this->id;
  }
  public function getImageFileName (): string
  {
    return $this->image_file_name;
  }
  public function getVehicleId (): int
  {
    return $this->vehicle_id;
  }
}