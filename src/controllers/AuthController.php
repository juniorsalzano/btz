<?php

require_once __DIR__ . '/../Auth/Auth.php';
require_once __DIR__ . '/../DAO/UserDAO.php';

class AuthController
{
  public static function login()
  {
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = $_POST['email'] ?? '';
      $password = $_POST['password'] ?? '';

      if (empty($email) || empty($password)) {
        $error = 'Por favor, informe o email e a senha.';
      } else {
        $userDAO = new UserDAO();
        $user = $userDAO->findByEmail($email);
        if ($user) {
          if (password_verify($password, $user['password'])) {
            Auth::login();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_access_level'] = $user['access_level']; // Definir o nível de acesso na sessão
            header('Location: /welcome');
            exit;
          } else {
            $error = 'Senha incorreta.';
          }
        } else {
          $error = 'Email não encontrado.';
        }
      }
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
