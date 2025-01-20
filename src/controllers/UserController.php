<?php

require_once __DIR__ . '/../DAO/UserDAO.php';
require_once __DIR__ . '/../Models/User.php';

class UserController
{
  public function register()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $zip_code = $_POST['zip_code'];
      $address = $_POST['address'];
      $neighborhood = $_POST['neighborhood'];
      $city = $_POST['city'];
      $state = $_POST['state'];

      $user = new User($name, $email, $password, $zip_code, $address, $neighborhood, $city, $state);
      
      $userDAO = new UserDAO();
      
      if ($userDAO->create($user)) {
        header('Location: /login');
        exit;
      } else {
        echo 'Erro ao registrar usuário.';
      }
    }

    require_once __DIR__ . '/../../src/views/register.php';
  }
}