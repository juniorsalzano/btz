<?php

session_start();

class Auth
{
  /**
   * Verifica se o usuário está autenticado.
   * 
   * @return bool Retorna true se o usuário estiver autenticado, caso contrário, false.
   */
  public static function check()
  {
    return isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true;
  }

  /**
   * Autentica o usuário.
   */
  public static function login()
  {
    $_SESSION['authenticated'] = true;
  }

  /**
   * Desautentica o usuário.
   */
  public static function logout()
  { 
    unset($_SESSION['authenticated']);
  }

  /**
   * Redireciona para a página de login se o usuário não estiver autenticado.
   */
  public static function requireAuth()
  {
    if (!self::check()) {
      header('Location: /login');
      exit;
    }
  }
}