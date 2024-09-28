<?php

namespace Controllers;

use \Models\Friendship;
use \Models\User;

class DashboardController{
    private $friendModel;
    private $userModel;

    public function __construct($db)
    {
        $this->friendModel = new Friendship($db);
        $this->userModel = new User($db);
    }
    public function displayDashboard($login){
        $userResult = $this->userModel->getUser_by_login($login);
        $user = $userResult->fetch_assoc();
        $userID = $user['id'];
    }
}