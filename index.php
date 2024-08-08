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
    <!-- <div>Zalogowano!</div> -->
     <div>
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
    <div id="wyswietlanie_friends">
    <!-- tutaj jest miejsce ze znajomymi -->
     <?php echo $wyswietlanie_znajomych;?>

    </div>

    <div>
        <form method="POST" action="">
            <input type="text" id="wyszukaj" name="wyszukaj" placeholder="Wyszukaj użytkownika">
            <input type="submit" value="Wyszukaj" id="wyszukaj_butt">
        </form>
        <!-- <form method="POST" action="">
            <input type="submit" value="Wyloguj" name="wyloguj" id="wyloguj">
            <input type="submit" value="Powrót do strony głównej" name="powrot" id="powrot">
        </form> -->
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
                    // echo "Zalogowano jako: " . $_SESSION['login'];
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
                if (isset($_POST["powrot"])) {
                    header("Location: main.php");
                    exit();
                }
                if (isset($_POST["strona_glowna"])) {
                    header("Location: main.php");
                    exit();
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
                
                
                function display_friends($conn, $user_ID) {
                    $query_friends = "SELECT ID_user_friends FROM friendship WHERE ID_user = '$user_ID'";
                    $result_friends = mysqli_query($conn, $query_friends);

                    if ($result_friends && mysqli_num_rows($result_friends) > 0) {
                        while ($row = mysqli_fetch_assoc($result_friends)) {
                            $friend_id = $row["ID_user_friends"];
                            $query_friend = "SELECT Login FROM Users WHERE ID = '$friend_id'";
                            $result_friend = mysqli_query($conn, $query_friend);
                            if ($result_friend && mysqli_num_rows($result_friend) > 0) {
                                $row_friend = mysqli_fetch_assoc($result_friend);
                                echo "<tr><td>" . $row_friend["Login"] . "</td></tr>";
                            }
                        }
                    } else {
                        echo "<tr><td>Brak znajomych</td></tr>";
                    }
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
                    $user_ID_result=mysqli_query($conn,$user_ID);
                    // $user_ID=mysqli_fetch_assoc($user_ID);
                    
                    if ($user_ID_result) {
                        $user_ID_row=mysqli_fetch_assoc($user_ID_result);
                        $user_ID=$user_ID_row['ID'];
                    }
                    else {
                        echo "Nie udało się pobrać ID użytkownika";
                    }


                    $friend_login=mysqli_real_escape_string($conn,$friend_id);

                    $check_friendship_querry = "SELECT * FROM friendship WHERE ID_user='$user_ID' AND ID_user_friends='$friend_login'";
                    $check_friendship = mysqli_query($conn, $check_friendship_querry);

                    if (mysqli_num_rows($check_friendship) > 0) {
                        echo "Już jesteście znajomymi";
                        return;
                    }

                    $queery_add_friend="INSERT INTO friendship (ID_user, ID_user_friends) VALUES ('$user_ID','$friend_login')";
                    $make_query_add_friends=mysqli_query($conn,$queery_add_friend);
                    if ($make_query_add_friends) {
                        echo "Dodano znajomego";
                        $query_add_reverse_friend = "INSERT INTO friendship (ID_user, ID_user_friends) VALUES ('$friend_login','$user_ID')";
                        $make_query_add_reverse_friend=mysqli_query($conn,$query_add_reverse_friend);
                        if ($make_query_add_reverse_friend) {
                            echo "Dodano znajomego - odwrotnie";
                        }
                        else {
                            echo "Nie dodano znajomego";
                        }
                    }
                    else {
                        echo "Nie dodano znajomego";
                    }
                    

                   
                }
            ?>
        </table>
    </div>
</body>
</html>
