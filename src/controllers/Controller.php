<?php

require_once __DIR__ . '/../Auth/Auth.php';

class Controller {
    public function home() {
        $isAuthenticated = Auth::check();
        $this->render('home', $_GET, $isAuthenticated);
    }

    public function editUser() {
        Auth::requireAuth();
        $isAuthenticated = Auth::check();
        $this->render('edit_user', $_GET, $isAuthenticated);
    }

    public function render($page, $params, $isAuthenticated) {
        $title = ucfirst($page);
        ob_start();

        switch ($page) {
            case 'home':
                include __DIR__ . '/../views/home_content.php';
                break;
            case 'edit_user':
                include __DIR__ . '/../views/edit_user_content.php';
                break;
            // Adicione mais casos conforme necessário
            default:
                include __DIR__ . '/../views/404.php';
                break;
        }

        $content = ob_get_clean();
        include __DIR__ . '/../views/template.php';
    }
}
?>