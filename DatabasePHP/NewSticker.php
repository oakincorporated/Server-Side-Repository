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
  $sql = "SELECT Username, NFCID FROM studentdata";
  $result = mysqli_query($conn, $sql);
 ?>

 $currID = $mysqli->prepare("SELECT NFCID FROM studentdata WHERE username = ?");
 $currID -> bind_param("s", $_POST[username]);
 $currID -> execute(); 	
 
 
 $currSID = mysqli->prepare("SELECT StudentID FROM studentdata WHERE username = ?");
 $currSID -> bind_param("s", $_POST[username]);
 $currSID -> execute();
 
 $newID = newNFCID()
 
 $updateSql = ("UPDATE studentdata SET NFCID = %s WHERE StudentID = %s", $newID, $currSID);
 $updateSql -> bind_param("ii", $_POST[newID], $_POST[currSId]);
 $currSID -> execute();

 
---

 
 
 
 <!DOCTYPE html>
 <html>
 <head></head>
 <body>
   <?php if(mysqli_num_rows($result) > 0)
   {
     // Show data for each row
     while($row = mysqli_fetch_assoc($result))
     {
       echo "|The student whose NFCID needs replacement: ".$row['Username']."|The NFCID to be replaced:".$row['NFCID'].";";
     }
   } ?>
 </body>
 </html>