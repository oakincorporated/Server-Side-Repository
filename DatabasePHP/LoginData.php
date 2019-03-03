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

  $sql = "SELECT Username, Password FROM userlogindata";
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
       echo "|Username:".$row['Username']."|Password:".$row['Password'].";";
     }
   } ?>
 </body>
 </html>
