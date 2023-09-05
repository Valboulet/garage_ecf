<?php
namespace App;

use \PDO;

class Connection {

  public static function getPDO(): PDO
  {
    return new PDO('mysql:dbname=garage;host=127.0.0.1', 'root', 'R00T_My5q!', [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
  }
}