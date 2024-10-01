<?php

namespace Controllers;
use Models\User;

class LoginController {
    private $userModel;

    public function __construct($db)
    {
        $this->userModel = new User($db);
    }

    public function login ($login, $password) {
        $result = $this->userModel->getUser_by_login($login);
        if ($result && $result->nun_rows>0) {
            $user = $result->fetch_assoc();
            if ($user['Password'] === $password){
                $_SESSION['Login'] = $login;
                return true;
            }
        }
        return false;
    }
}