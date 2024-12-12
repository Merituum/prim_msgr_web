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
        <input type="password" name="pass1" placeholder="Podaj aktualne hasło">
        <input type="password" name="pass2" placeholder="Podaj nowe hasło">
        <input type="password" name="pass3" placeholder="Wprowadź ponownie nowe hasło">
        <input type="submit" name="change_pass_button" value="Zmień haśło">
    </form>
</div>



<?php
session_start();

$db_name = "localhost";
$db_user = "root";
$db_pass = "";
$db_name_db = "prim_msgr";
$conn = new mysqli($db_name, $db_user, $db_pass, $db_name_db);

$ans = $_POST["answer_quest"];
$pass1 = $_POST["pass1"];
$pass2 = $_POST["pass2"];
$pass3 = $_POST["pass3"];
$change_pass_button=$_POST["change_pass_button"];


if ($conn->connect_error) {
    die("Nie można połączyć się z bazą danych: " . $conn->connect_error);
}

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}
//} else {
//    // echo "Zalogowano jako: " . $_SESSION['login'];
//    // $querry_id="SELECT ID FROM users WHERE Login='".$_SESSION['login']."'";
//    // $result_id=mysqli_query($conn,$querry_id);
//    // $row_id=mysqli_fetch_assoc($result_id);
//    // print($row_id." ".$result_id);
//}
if (isset($_POST["dodaj_znajomego"])) {
    header("Location: index.php");
    exit();
}
else if (isset($_POST["wyloguj"])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
else if (isset($_POST["delete_acc"])) {
    header("Location: delete_acc.php");
    exit();
}
else if (isset($_POST["question_change"])) {
    header("Location: question_change.php");
    exit();
}
else if (isset($_POST["mail_change"])) {
    header("Location: mail_change.php");
    exit();
}
else if (isset($_POST["password_change"])) {
    header("Location: password_change.php");
    exit();
}

if (isset($_POST["change_pass_button"])) {
    $query_check = "SELECT Haslo,OdpowiedzNaPytanie  FROM users WHERE login = '" . $_SESSION['login'] . "'";
    $result_check = $conn->query($query_check);
    $row = $result_check->fetch_assoc();
    if($row['Haslo'] == ($pass1) &&$row['OdpowiedzNaPytanie']=($ans)) {
            if($pass2 == $pass3) {
                $query_change_pass = "UPDATE users SET Haslo = '" . $pass2 . "' WHERE login = '" . $_SESSION['login'] . "'";
                $result_change_pass = $conn->query($query_change_pass);
                echo "Pomyślnie zmieniono hasło!";
            }
    }
    else {
        "User podal zle haslo lub odpowiedz na pytanie";
    }
}


?>
</body>
</html>
