<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main_style.css">
    <title>Mainpage</title>
</head>
<body>
<div>
    dashboard

    <table id="kafelki">
        <tr>

            <form method="post" action="">
                <th><input type="submit" value="Strona główna" name="strona_glowna"></th>
                <th><input type="submit" value="Znajomi" name="dodaj_znajomego"></th>
                <th><input type="submit" value="Zmien dane logowania" name="zmien_dane"></th>
                <th><input type="submit" value="Wyloguj" name="wyloguj"></th>
            </form>

        </tr>
    </table>
</div>
<div>
    <form method="post">
        <input type="text" name="answer_quest" placeholder="Podaj odpowiedz na pytanie pomocnicze">
        <input type="password" name="question_new" placeholder="Podaj nowe pytanie pomocniczne">
        <input type="password" name="question_ans_1" placeholder="Podaj nową odpowiedź na pytanie pomocnicze">
        <input type="password" name="question_ans_2" placeholder="Podaj ponownie odpowiedź na pytanie pomocnicze">
        <input type="submit" name="change_question_butt" value="Zmień dane do odzyskiwania konta">
    </form>
</div>

<?php
session_start();
$answer_old = $_POST["answer_quest"];
$question_new = $_POST["question_new"];
$question_ans_1 = $_POST["question_ans_1"];
$question_ans_2 = $_POST["question_ans_2"];
$button = $_POST['change_question_butt'];
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "prim_msgr";
if (isset($_POST["wyloguj"])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Nie można połączyć się z bazą danych: " . $conn->connect_error);
}
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}


if (isset($button)) {
    $query_chestion_check = "SELECT OdpowiedzNaPytanie WHERE Login={$_SESSION['login']}";
    $result_chestion_check = $conn->query($query_chestion_check);
    $row_chestion_check = $result_chestion_check->fetch_assoc();
    if ($row_chestion_check==$answer_old) {
        if ($question_ans_1 == $answer_old) {
            echo "Użytkownik nie może zmienić odpowiedzi na taką samą.";
        }
        else if ($question_ans_2 == $question_ans_1) {
            $query_update = "UPDATE users SET PytaniePomocnicze={$question_new}, OdpowiedzNaPytanie={$question_ans_2} WHERE Login={$_SESSION['login']} ";
            $result_update = $conn->query($query_update);
            echo "Pomyslnie zmieniono dane do odzyskiwania konta!";
        }
    }
}


?>
</body>
</html>
