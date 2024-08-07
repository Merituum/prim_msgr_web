<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard_style.css">
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
                <!-- <th>Id</th> -->
                <th>Login</th>
                <!-- <th>Hasło</th> -->
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
                    // $querry_id="SELECT ID FROM users WHERE Login='".$_SESSION['login']."'";
                    // $result_id=mysqli_query($conn,$querry_id);
                    // $row_id=mysqli_fetch_assoc($result_id);
                    // print($row_id." ".$result_id);
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
                    $query_search = "SELECT ID, Login FROM Users WHERE Login LIKE '%$wyszukaj%'";
                    $result_search = mysqli_query($conn, $query_search);

                    if ($result_search && mysqli_num_rows($result_search) > 0) {
                        display_search_results($result_search,$conn);
                    } else {
                        echo "<tr><td colspan='3'>Nie znaleziono użytkownika: $wyszukaj</td></tr>";
                    }
                }

                function display_search_results($result_search,$conn) {
                  
                    while ($row = mysqli_fetch_assoc($result_search)) {
                        // echo "<table>";
                        echo "<tr>";
                        // echo "<td>" . $row["ID"] . "</td>";
                        echo "<td>" . $row["Login"] . "</td>";
                        // echo "<td>" . $row["Haslo"] . "</td>";
                        echo "<td>
                        <form method='POST' action=''>
                        <input type='hidden' name='friend_id' value='".$row['ID']."'>
                        <input type='submit' value='Dodaj' name='dodaj'></td>
                        </form>";
                        echo "</tr>";
                        // $user_ID="SELECT ID from users WHERE Login='".$_SESSION["Login"];
                        // print(mysqli_query($conn,$user_ID));
                        // $query_add_friend="INSERT INTO friendship (ID, Friend_ID) VALUES ('$user_ID','".$row['ID']."')";
                        // $id_number_querry="SELECT * FROM users WHERE Login='".$row['ID']."'";
                        //print($id_number_querry);
                        echo "</table>";
                        
                    }
                   
                    // $querry_friend_id="SELECT ID FROM users WHERE Login='".$row['Login']."'";
                    // print($querry_friend_id);
                    // add_friend($conn, $querry_friend_id);
                }


                        // $make_querry=mysqli_query($conn,$query_add_friend);
                        
                 if (isset($_POST["dodaj"])) {
                    //  PRINT("DZIALA");   
                      $friend_id=$_POST["friend_id"];
                        add_friend($conn,$friend_id);
                 }
                
                
                


                function wyloguj() {
                    session_destroy();
                    header("Location: login.php");
                    exit();
                }
                function add_friend($conn, $friend_id) {
                    // session_start();
                    if (!isset($_SESSION['login'])) {
                        header("Location: login.php");
                        exit();
                    }
                    
                    $user_login=$_SESSION['login'];
                    $user_login=mysqli_real_escape_string($conn,$user_login);
                    

                    $user_ID="SELECT ID from users WHERE Login='".$user_login."'";
                    $user_ID=mysqli_query($conn,$user_ID);
                    // $user_ID=mysqli_fetch_assoc($user_ID);
                    print($user_ID);
                    $user_login=mysqli_real_escape_string($conn,$user_login);
                    
                    $friend_login=mysqli_real_escape_string($conn,$friend_id);
                    
                    $query_add_friend="INSERT INTO friendship (ID, Friend_ID) VALUES ('$user_login','$friend_login')";
                    $make_querry=mysqli_query($conn,$query_add_friend);
                    if($make_querry){
                        echo "Dodano znajomego";
                    }
                    else{
                        echo "Nie dodano znajomego";
                    }
                }
            ?>
        </table>
    </div>
</body>
</html>
