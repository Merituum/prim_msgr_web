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
                    <th><input type="submit" value="Znajomi" name="dodaj_znajomego"></th>
                    <th><input type="submit" value="Zmien dane logowania" name="zmien_dane"></th>
                    <th><input type="submit" value="Wyloguj" name="wyloguj"></th>
                </form>

            </tr>
        </table>
    </div>
 
    <?php
    session_start();

    $db_name = "localhost";
    $db_user = "root";
    $db_pass = "";    
    $db_name_db = "prim_msgr";
    $conn = new mysqli($db_name, $db_user, $db_pass, $db_name_db);
    dashboard_display_friends($conn);
    if ($conn->connect_error) {
        die("Nie można połączyć się z bazą danych: " . $conn->connect_error);
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
    function dashboard_display_friends($conn) {
        $user_login=$_SESSION['login'];
        $querry_id="SELECT id FROM users WHERE login='$user_login'";
        $result_id = $conn->query($querry_id);
        $row = $result_id->fetch_assoc();
        $user_id=$row['id'];

        $querry_friends="SELECT ID_user_friends FROM friendship WHERE ID_user='$user_id'";
        $result_friends_IDs=$conn->query($querry_friends);

       
    if ($result_friends_IDs->num_rows > 0) {
        echo "<div>";
        echo "<table id='kafelki' class='user-table'>";
        echo "<tr>";
        // echo "<th>Imie</th>";
        // echo "<th>Nazwisko</th>";
        echo "<th>Login</th>";
        echo "<th>Usuń znajomego</th>";
        echo "</tr>";

        while ($row_friends_IDs = $result_friends_IDs->fetch_assoc()) {
            $friend_id = $row_friends_IDs['ID_user_friends'];
            $querry_friend = "SELECT * FROM users WHERE id='$friend_id'";
            $result_friend = $conn->query($querry_friend);
            $row_friend = $result_friend->fetch_assoc();

            echo "<tr>";
            // echo "<td>".$row_friend['name']."</td>";
            // echo "<td>".$row_friend['surname']."</td>";
            echo "<td>".$row_friend['Login']."</td>";
            echo "<td><form method='post' action=''><input type='submit' value='Usuń' name='usun_znajomego'></form></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Brak znajomych do wyświetlenia.";
    }
    echo "</div>";
    if (isset($_POST["usun_znajomego"])) {
        
        $user_id=$_SESSION['id'];
        $querry_delete_friend="DELETE FROM friendship WHERE ID_user='$user_id' AND ID_user_friends='$friend_id'";
        $conn->query($querry_delete_friend);
        header("Location: main.php");
        
    }#test awdawdawd

    }
    
?>
</body>
</html>