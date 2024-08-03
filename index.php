<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <!-- @TO DO, SESSION BREAK -->
    <div>Zalogowano!</div>
    <div>
        <form method="POST" action="">
            <input type="text" id="wyszukaj" name="wyszukaj" placeholder="Wyszukaj użytkownika">
            <input type="submit" value="Wyszukaj" id="wyszukaj_butt">
        </form>
        <form method="POST" action="">
            <input type="submit" value="Wyloguj" name="wyloguj" id="wyloguj">
        </form>
    </div>
    <div id="wyniki">
        <!-- Wyniki wyszukiwania -->
        <table>
            <tr>
                <th>Id</th>
                <th>Login</th>
                <th>Hasło</th>
            </tr>
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
                    echo "Zalogowano jako: " . $_SESSION['login'];
                }

                if (isset($_POST["wyszukaj"])) {
                    $wyszukaj = $_POST["wyszukaj"];
                    search($conn, $wyszukaj);
                }

                if (isset($_POST["wyloguj"])) {
                    wyloguj();
                }

                function search($conn, $wyszukaj) {
                    $wyszukaj = mysqli_real_escape_string($conn, $wyszukaj);
                    // $query_search = "SELECT * FROM Users WHERE Login = '$wyszukaj'";
                    $query_search = "SELECT * FROM Users WHERE Login LIKE '%$wyszukaj%'";
                    $result_search = mysqli_query($conn, $query_search);

                    if ($result_search && mysqli_num_rows($result_search) > 0) {
                        display_search_results($result_search);
                    } else {
                        echo "<tr><td colspan='3'>Nie znaleziono użytkownika: $wyszukaj</td></tr>";
                    }
                }

                function display_search_results($result_search) {
                    while ($row = mysqli_fetch_assoc($result_search)) {
                        echo "<tr>";
                        echo "<td>" . $row["Id"] . "</td>";
                        echo "<td>" . $row["Login"] . "</td>";
                        echo "<td>" . $row["Haslo"] . "</td>";
                        echo "</tr>";
                    }
                }

                function wyloguj() {
                    session_destroy();
                    header("Location: login.php");
                    exit();
                }
            ?>
        </table>
    </div>
</body>
</html>
