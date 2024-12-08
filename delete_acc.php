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


<p>
<form method="post">
    Podaj hasło <br>
    <input type="password" name="password" value="Podaj hasło"><br>
    Czy jesteś świadomy tego co robisz?<br>
    <input type="checkbox" name="confirm" value="Tak"><br>
    <input type="submit" name="delete_acc" value="Skasuj konto">
</form>
</p>












</body>
</html>






<?php
session_start();

$db_name = "localhost";
$db_user = "root";
$db_pass = "";
$db_name_db = "prim_msgr";
$conn = new mysqli($db_name, $db_user, $db_pass, $db_name_db);
$login_del = $_SESSION['login'];
$pass_del = $_POST["password"];
$checkbox= $_POST["confirm"];
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
if (isset($_POST['delete_acc']) && $checkbox == "Tak") {
//tutaj skonczylem -> nie dziala query
    $query_check = "SELECT * FROM Users WHERE Login = '$login_del' AND Haslo = '$pass_del'";
    $result_check = mysqli_query($conn, $query_check);

    if ($result_check && mysqli_num_rows($result_check) > 0) {
//        $_SESSION['login'] = $login_username;
        $query_delete = "DELETE * FROM Users WHERE Login = '$login_del'";
        $result_delete = mysqli_query($conn, $query_delete);

        header("Location: login.php");
        exit();
    }
}
else {
    echo "Podano nieprawidłowe dane";
}
?>