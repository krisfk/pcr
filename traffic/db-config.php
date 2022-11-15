<?php

$servername = "localhost";
$username = "pcr_db_user";
$password = "eLg5}g@%cNg?8[-v";
$dbname = "pcr_traffic";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM traffic_record";

$result = mysqli_query($conn, $query);


    while($row = mysqli_fetch_assoc($result))
    {
        echo 1;
        // $cat_id = $row['cat_id'];
        // $cat_title = $row['cat_title'];

        // echo $cat_id . " " . $cat_title  ."<br>";
    }



//$conn = db_connect();

// $result = $conn->mysqli_query("SELECT * FROM traffic_record");

// $row = $result->fetch_assoc();


// while(($row = mysql_fetch_assoc($query)) != NULL) {

//     echo 1;
//     // echo "<p>User {$row['username']} just registered {$minutes} min ago</p><br />";

// }

// $sql = "SELECT * FROM traffic_record";

// if ($result = $conn -> query($sql)) {
//   while ($row = $conn -> fetch_row()) {

// }
//   $result -> free_result();
// }

// $mysqli -> close();


?>