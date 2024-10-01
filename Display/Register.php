<?php
session_start();
require_once '../Models/Database.php';
require_once '../Controllers/LoginController.php';
require_once '../Models/User.php';
use Models\Database;
use Controllers\RegisterController;

// require '../Models/Database.php';
// require '../Controllers/RegisterController.php';

$db = (new Database())->getConnection();
$registerController = new RegisterController($db);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $question = $_POST['question'];
    $answer = $_POST['answer'];

    $result = $registerController->register($login, $password, $confirmPassword, $question, $answer);
    if ($result === true) {
        header('Location: login.php');
    } else {
        echo $result;
    }
    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    <form method="post">
        <label for="login_form">Login:</label>
        <input type="text" name="login" required>
        <label for="password_form">Hasło:</label>
        <input type="password" name="password" required>
        <label for="password_conf_form">Potwierdź hasło:</label>
        <input type="password" name="passwordConf" required>
        <label for="question_form">Pytanie pomocnicze:</label>
        <input type="text" name="question" required>
        <label for="answer_form">Odpowiedź na pytanie:</label>
        <input type="text" name="answer" required>
        <input type="submit" name="register" value="Zarejestruj się">
    </form>
</body>
</html>