<?php

require_once __DIR__ . '/../Auth/Auth.php';

class AuthController
{
  public static function login()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      Auth::login();
      header('Location: /');
      exit;
    }

    require_once __DIR__ . '/../../src/views/login.php';
  }

  public static function logout()
  {
    Auth::logout();
    header('Location: /login');
    exit;
  }
}