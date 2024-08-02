<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    
    <div>zalogowano!
</div>
    <div>
        <form method="POST" action="">
        <input type="text" id="wyszukaj" name="wyszukaj">
        <input type="submit" value="Wyszukaj" id="wyszukaj_butt">
</form>
</div>
<div id="wyniki">
    <!-- Wyniki wyszukiwania -->
     <!-- <table> 
        <tr>
            <th>Id</th>
            <th>Login</th>
            <th>Hasło</th>
        </tr> -->
        <!-- <?php
            // if ($result_search && mysqli_num_rows($result_search) > 0) {
            //     while($row = mysqli_fetch_assoc($result_search)) {
            //         echo "<tr>";
            //         echo "<td>".$row["Id"]."</td>";
            //         // echo "<td>".$row["Login"]."</td>";
            //         // echo "<td>".$row["Haslo"]."</td>";
            //         echo "<td> dodaj uzytkownika</td>";
            //         echo "</tr>";
            //     }
            // }
        ?>  -->

</div>
<?php
    session_start();
    // if(!isset($_SESSION['login'])){
    //     header("Location: login.php");
    // }
    // else{
    //     echo "Zalogowano jako: ".$_SESSION['login'];
    // }
    if (isset($_POST["wyszukaj"])) {
        search();
    }
    function search() {
    // if(isset($_POST["wyszukaj"])){
        $wyszukaj = $_POST["wyszukaj"];
        $db_name = "localhost";
        $db_user = "root";
        $db_pass = "";    
        $db_name_db = "prim_msgr";
        // print("logowanie");
        $conn = new mysqli($db_name, $db_user, $db_pass, $db_name_db);
        // print("polaczenie");
        if ($conn->connect_error) {
            die("Nie można połączyć się z bazą danych: " . $conn->connect_error);
        }
        // print("wyszukiwane");
        $wyszukaj = mysqli_real_escape_string($conn, $wyszukaj);
        $query_search = "SELECT * FROM Users WHERE Login = '$wyszukaj'";
        $result_search = mysqli_query($conn, $query_search);
        
        if ($result_search && mysqli_num_rows($result_search) > 0) {
            echo "Znaleziono użytkownika: ".$wyszukaj;
        } else {
            echo "Nie znaleziono użytkownika: ".$wyszukaj;
        }
        return $result_search;
        print("<br>");
    }
    $result_search = search();
    print($result_search);
    function display_search_results($result_search) {
        if ($result_search && mysqli_num_rows($result_search) > 0) {
            while($row = mysqli_fetch_assoc($result_search)) {
                echo "<tr>";
                echo "<td> Login </td>";
                echo "<td> Dodaj użytkownika</td>";
                echo "</tr>";  
                echo "<tr>";
                echo "<td>".$row["Id"]."</td>";
                echo "<td>".$row["Login"]."</td>";
                echo "<td>".$row["Haslo"]."</td>";
                echo "</tr>";
            }
        }
    }
    // }
?>
</body>
</html>