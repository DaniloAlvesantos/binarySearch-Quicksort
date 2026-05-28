<?php

namespace App\Controllers;

use App\Models\User;
use App\Repositories\UserRepositoy;

class UserController
{
    private UserRepositoy $repository;

    public function __construct()
    {
        $this->repository = new UserRepositoy();
    }

    public function login()
    {
        $message = "";

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $user = $_POST['email'] ?? '';
            $pass = $_POST['pass'] ?? '';

            $result = $this->repository->login($user, $pass);

            if (!isset($result) || !$result) {
                $message = "Usuário ou senha incorretos";
            } else {
                $_SESSION['user'] = $result;
                
                header("Location: " . BASE_URL . "/index.php?action=cards");
                exit();
            }
        }

        $_REQUEST['message'] = $message;

        ob_start();
        require_once __DIR__ . "/../views/login/login.php";
        $content = ob_get_clean();
        require_once __DIR__ . "/../views/layout.php";
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $user = new User(
                $_POST['name'],
                $_POST['email'],
                $_POST['pass']
            );

            $result = $this->repository->createUser($user);

            if ($result === false) {
                echo "VISH";
                return;
            }

            header("Location: " . BASE_URL . "/index.php?action=login&message=Usuário criado com sucesso!");
            exit();
        }

        ob_start();
        require_once __DIR__ . "/../views/login/create.php";
        
        $content = ob_get_clean();
        
        require_once __DIR__ . "/../views/layout.php";
    }
}
