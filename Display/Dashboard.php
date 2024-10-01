<?php


session_start();
require_once '../Models/Database.php';
require_once '../Controllers/LoginController.php';
require_once '../Models/User.php';
use Models\Database;
use Controllers\DashboardController;

// require '../Models/Database.php';
// require '../Controllers/DashboardController.php';

$db = (new Database())->getConnection();
$dashboardController = new DashboardController($db);

$friends = $dashboardController->displayDashboard($_SESSION['Login']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard_style.css">
</head>
<body>
    <table id="kafelki">
        <tr>
            <form method="post">
                <th><input type="submit" value="Strona główna" name="strona_glowna"></th>
                <th><input type="submit" value="Znajomi" name="dodaj_znajomego"></th>
                <th><input type="submit" value="Zmień dane logowania" name="zmien_dane"></th>
                <th><input type="submit" value="Wyloguj" name="wyloguj"></th>
            </form>
        </tr>
    </table>

    <div>
        <table>
            <tr>
                <th>Login</th>
                <th>Usuń znajomego</th>
            </tr>
            <?php while ($row = $friendsResult->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['Login']; ?></td>
                    <td><form method="post"><input type="submit" value="Usuń" name="usun_znajomego"></form></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>