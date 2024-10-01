<?php

session_start();

require_once '../Models/Database.php';
require_once '../Controllers/LoginController.php';
require_once '../Models/User.php';


// require '../Models/Database.php';
// require '../Controllers/LoginController.php';
use Models\Database;
use Controllers\LoginController;

$db = (new Database())->getConnection();
$loginController = new LoginController($db);

if (isset($_POST['login']) && isset($_POST['password'])) {
    if ($loginController->login($_POST['login'], $_POST['password'])) {
        header('Location: main.php');
    } else {
        echo "Niepoprawne dane logowania";
    }
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <form method="post">
        <label for="login_form">Login:</label>
        <input type="text" name="login" required>
        <label for="password_form">Hasło:</label>
        <input type="password" name="password" required>
        <input type="submit" value="Zaloguj się">
    </form>
</body>
</html>
