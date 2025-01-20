<?php

class User
{
  public $id;
  public $name;
  public $email;
  public $password;
  public $zip_code;
  public $address;
  public $neighborhood;
  public $city;
  public $state;
  public $created_at;
  public $updated_at;

  public function __construct($name, $email, $password, $zip_code, $address, $neighborhood, $city, $state)
  {
    $this->name = $name;
    $this->email = $email;
    $this->password = password_hash($password, PASSWORD_BCRYPT);
    $this->zip_code = $zip_code;
    $this->address = $address;
    $this->neighborhood = $neighborhood;
    $this->city = $city;
    $this->state = $state;
  }
}