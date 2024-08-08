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
        <!-- <form method="post">
            <input type="submit" value="Wyloguj" name="wyloguj">
            <input type="submit" value="Dodaj znajomego" name="dodaj_znajomego">
        </form> -->
        <table id="kafelki">
            <tr>
                <!-- <th><a href="main.php">Strona główna</a></th>
                <th><a href="index.php">Dodaj użytkownika</a></th>
                <th>Zmien dane logowania</th>
                <th>Wyloguj</th> -->
                <form method="post" action=""> 
                    <th><input type="submit" value="Strona główna" name="strona_glowna"></th>
                    <th><input type="submit" value="Dodaj użytkownika" name="dodaj_znajomego"></th>
                    <th><input type="submit" value="Zmien dane logowania" name="zmien_dane"></th>
                    <th><input type="submit" value="Wyloguj" name="wyloguj"></th>
                </form>

            </tr>
        </table>
    </div>
    <?php
    session_start();
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