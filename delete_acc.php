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

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "prim_msgr";

// Połączenie z bazą danych
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Nie można połączyć się z bazą danych: " . $conn->connect_error);
}

// Sprawdzenie, czy użytkownik jest zalogowany
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

// Pobranie danych z sesji
$login_del = $_SESSION['login'];

// Sprawdzenie danych przesłanych w formularzu
$pass_del = $_POST["password"] ?? null;
$checkbox = $_POST["confirm"] ?? null;

// Obsługa różnych akcji
if (isset($_POST["dodaj_znajomego"])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST["wyloguj"])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Usuwanie konta
if (isset($_POST['delete_acc'])) {
    if ($checkbox === "Tak" && $pass_del) {
        // Zapytanie przygotowane do sprawdzenia loginu i hasła
        $stmt_check = $conn->prepare("SELECT * FROM Users WHERE Login = ? AND Haslo = ?");
        $stmt_check->bind_param("ss", $login_del, $pass_del);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            // Użytkownik istnieje, usuń konto
            $stmt_delete = $conn->prepare("DELETE FROM Users WHERE Login = ?");
            $stmt_delete->bind_param("s", $login_del);
            $stmt_delete->execute();

            // Wyloguj użytkownika po usunięciu konta
            session_destroy();
            header("Location: login.php");
            exit();
        } else {
            echo "Podano nieprawidłowe dane.";
        }

        $stmt_check->close();
    } else {
        echo "Wszystkie pola muszą być wypełnione i musisz potwierdzić usunięcie.";
    }
}

$conn->close();
?>
