<?php

require_once __DIR__ . '/../Auth/Auth.php';
require_once __DIR__ . '/../DAO/UserDAO.php';

class Controller
{
  public function home($params)
  {
    $isAuthenticated = Auth::check();
    $this->render('home', $params, $isAuthenticated);
  }

  public function editUser($params)
  {
    Auth::requireAuth();
    $isAuthenticated = Auth::check();
    $userId = $params['id'] ?? null;
    $currentUserId = $_SESSION['user_id'];
    $currentUserAccessLevel = $_SESSION['user_access_level'];

    if ($userId) {
      if ($userId != $currentUserId && $currentUserAccessLevel !== 'A') {
        echo 'Acesso negado. Você não tem permissão para acessar o cadastro de outros usuários.';
        return;
      }

      $userDAO = new UserDAO();
      $user = $userDAO->findById($userId);
      if ($user) {
        $this->render('edit_user', ['user' => $user], $isAuthenticated);
      } else {
        echo 'Usuário não encontrado.';
      }
    } else {
      echo 'ID do usuário não fornecido.';
    }
  }

  public function updateUser($params)
  {
    Auth::requireAuth();
    $isAuthenticated = Auth::check();
    $userId = $_POST['id'] ?? null; // Certifique-se de que estamos pegando o ID do POST
    $currentUserId = $_SESSION['user_id'];
    $currentUserAccessLevel = $_SESSION['user_access_level'];

    if ($userId) {
      if ($userId != $currentUserId && $currentUserAccessLevel !== 'A') {
        $message = 'Acesso negado. Você não tem permissão para atualizar o cadastro de outros usuários.';
        header("Location: /edit_user?id=$userId&message=" . urlencode($message));
        exit();
      }

      $userDAO = new UserDAO();
      $accessLevel = $_POST['access_level'] ?? 'U'; // Definir um valor padrão para access_level
      $user = new User(
        $_POST['name'],
        '', // Email não será atualizado aqui
        '', // Senha não será atualizada aqui
        $_POST['zip_code'],
        $_POST['address'],
        $_POST['neighborhood'],
        $_POST['city'],
        $_POST['state'],
        $accessLevel
      );
      $user->id = $userId;

      if ($userDAO->updateUser($user)) {
        $message = 'Usuário atualizado com sucesso.';
      } else {
        $message = 'Erro ao atualizar usuário.';
      }

      header("Location: /edit_user?id=$userId&message=" . urlencode($message));
      exit();
    } else {
      $message = 'ID do usuário não fornecido.';
      header("Location: /edit_user?message=" . urlencode($message));
      exit();
    }
  }

  public function listUsers($params)
  {
    Auth::requireAuth();
    $isAuthenticated = Auth::check();
    $currentUserAccessLevel = $_SESSION['user_access_level'];

    if ($currentUserAccessLevel !== 'A') {
      echo 'Acesso negado. Você não tem permissão para acessar esta página.';
      return;
    }

    $userDAO = new UserDAO();
    $users = $userDAO->findAllNonAdminUsers();
    $this->render('list_users', ['users' => $users], $isAuthenticated);
  }

  public function welcome($params)
  {
    $isAuthenticated = Auth::check();
    $this->render('welcome', $params, $isAuthenticated);
  }

  public function render($page, $params, $isAuthenticated)
  {
    $title = ucfirst($page);
    ob_start();

    switch ($page) {
      case 'home':
        include __DIR__ . '/../views/home_content.php';
        break;
      case 'edit_user':
        include __DIR__ . '/../views/edit_user_content.php';
        break;
      case 'welcome':
        include __DIR__ . '/../views/welcome_content.php';
        break;
      case 'list_users':
        include __DIR__ . '/../views/list_users_content.php';
        break;
      default:
        include __DIR__ . '/../views/404.php';
        break;
    }

    $content = ob_get_clean();
    include __DIR__ . '/../views/template.php';
  }
}
