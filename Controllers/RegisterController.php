<?php

namespace Controllers;
use \Models\User;

class RegisterController {
    private $userModel;

    public function __construct($db)
    {
        $this->userModel = new User($db);
    }

    public function register($login,$password,$confirmPassword,$question,$answer) {
        if ($password !==$confirmPassword) {
            return "Hasła się nie zgadzają!";
        }
        $existingUser = $this->userModel->getUser_by_login($login); 
            if ($existingUser->num_rows>0) {
                return "Taki uzytkownik juz istnieje";
            }
            $this->userModel->registerUser($login,$password,$question,$answer);
            $_SESSION['Login'] = $login;
            header("Location: index.php");
            exit();
        }
    }
