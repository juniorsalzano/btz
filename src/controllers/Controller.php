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
    $userId = $_POST['id'] ?? null;
    $currentUserId = $_SESSION['user_id'];
    $currentUserAccessLevel = $_SESSION['user_access_level'];

    if ($userId) {
      if ($userId != $currentUserId && $currentUserAccessLevel !== 'A') {
        echo 'Acesso negado. Você não tem permissão para atualizar o cadastro de outros usuários.';
        return;
      }

      $userDAO = new UserDAO();
      $user = new User(
        $_POST['name'],
        '', // Email não será atualizado aqui
        '', // Senha não será atualizada aqui
        $_POST['zip_code'],
        $_POST['address'],
        $_POST['neighborhood'],
        $_POST['city'],
        $_POST['state'],
        $_POST['access_level']
      );
      $user->id = $userId;

      if ($userDAO->updateUser($user)) {
        echo 'Usuário atualizado com sucesso.';
      } else {
        echo 'Erro ao atualizar usuário.';
      }
    } else {
      echo 'ID do usuário não fornecido.';
    }
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
      default:
        include __DIR__ . '/../views/404.php';
        break;
    }

    $content = ob_get_clean();
    include __DIR__ . '/../views/template.php';
  }
}
