<?php

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbName = "realworldproject";

  // Make the connection
  $conn = new mysqli($servername, $username, $password, $dbName);

  // Check the connection
  if (!$conn)
  {
    die("Connection fail.". mysqli_connect_error());
  }

  $sql = "SELECT first_name, last_name, ssid, course, class_id, Username FROM users";
  $result = mysqli_query($conn, $sql);

 ?>


<!DOCTYPE html>
<html>
<head></head>
<body>
  <?php if(mysqli_num_rows($result) > 0)
  {
    // Show data for each row
    while($row = mysqli_fetch_assoc($result))
    {
      echo "|First name:".$row['first_name']."|Last Name:".$row['last_name']."|SSID:".$row['ssid']."|Course:".$row['course']."|Class_ID:".$row['class_id']."|Username:".$row['Username'].";";
    }
  } ?>
</body>
</html>
