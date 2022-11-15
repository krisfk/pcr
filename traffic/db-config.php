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

$sql = "SELECT * FROM traffic_record";

if ($result = $mysqli -> query($sql)) {
  while ($row = $result -> fetch_row()) {
    echo 1;
    // printf ("%s (%s)\n", $row[0], $row[1]);
  }
  $result -> free_result();
}

$mysqli -> close();


?>