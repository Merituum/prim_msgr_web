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
<p name="action_choice">
<form method="post">
    <input type="submit" value="Zmiana hasła" name = "password_change">
    <input type="submit" value="Zmiana adresu E-Mail" name="mail_change">
    <input  type="submit" value="Zmiana pytania pomocniczego" name="question_change">
    <input  type="submit" value="Usuń konto" name="delete_acc">



</form>
</p>


<?php
session_start();

$db_name = "localhost";
$db_user = "root";
$db_pass = "";
$db_name_db = "prim_msgr";
$conn = new mysqli($db_name, $db_user, $db_pass, $db_name_db);

if ($conn->connect_error) {
    die("Nie można połączyć się z bazą danych: " . $conn->connect_error);
}

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
} else {
    // echo "Zalogowano jako: " . $_SESSION['login'];
    // $querry_id="SELECT ID FROM users WHERE Login='".$_SESSION['login']."'";
    // $result_id=mysqli_query($conn,$querry_id);
    // $row_id=mysqli_fetch_assoc($result_id);
    // print($row_id." ".$result_id);
}
if (isset($_POST["dodaj_znajomego"])) {
    header("Location: index.php");
    exit();
}
if (isset($_POST["wyloguj"])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
</body>
</html>
