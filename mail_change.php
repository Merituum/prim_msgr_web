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
        <input type="text" placeholder="Podaj aktualny adres E-Mail" name="old_mail">
        <input type="text" placeholder="Podaj nowy E-Mail" name="new_mail1">
        <input type="text" placeholder="Powtórz nowy adres E-Mail" name="new_mail2">
        <input type="password" placeholder="Podaj hasło" name="pass_conf">
        <input type="submit" value="Zmień hasło" name="mail_change">
    </form>
</div>











</body>
</html>






<?php
session_start();
$old_mail = $_POST['old_mail'];
$new_mail = $_POST['new_mail1'];
$new_mail2 = $_POST['new_mail2'];
$pass_conf = $_POST['pass_conf'];
$mail_change = $_POST['mail_change'];

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
if (isset($mail_change)) {
    $query_passcheck = "SELECT Haslo from users where Login=$_SESSION[login]";
    $query_check = $conn->prepare($query_passcheck);
    $query_check->execute();
    $check_pass = $query_check->fetch();
    if ($check_pass==$pass_conf) {
        if ($new_mail == $new_mail2) {
            $query_change_mail = "UPDATE users SET Email=? WHERE Login=$_SESSION[login]";
            $execute_change_mail = $conn->prepare($query_change_mail);
            echo "Pomyślnie zmieniono adres E-Mail";
        }
        else {
            echo "Upewnij się, że wprowadziłeś odpowiedni adres E-Mail.";
        }
    }
    else {
        echo "Podałeś złe hasło";
    }
}


    ?>