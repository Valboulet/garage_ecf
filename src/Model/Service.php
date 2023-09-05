<?php
namespace App\Model;

class Service {

  private $id;
  private $image_file_name;
  private $service_type;
  private $administrator_id;
  
  public function getId (): int
  {
    return $this->id;
  }
  public function getImageFileName ():string
  {
    return e($this->image_file_name);
  }  
  public function getServiceType ():string
  {
    return e($this->service_type);
  }
  public function getAdministratorId (): int
  {
    return $this->administrator_id;
  }
}