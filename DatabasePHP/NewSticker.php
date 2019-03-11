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
  
  $currID = $mysqli->prepare("SELECT NFCID FROM studentdata WHERE username = ?"); //grabs the current NFC ID
  $currID -> bind_param("s", $_POST[username]);


  $currSID = $mysqli->prepare("SELECT StudentID FROM studentdata WHERE username = ?"); //grabs the current Student ID
  $currSID -> bind_param("s", $_POST[username]);

  
  //TODO: test this function for every option
  
  $newNFC = $mysqli->prepare("SELECT NFCID FROM nfc_empty_tags WHERE postition LIKE '%?"); //grabs a new NFC ID from the table; takes the one whose 'position' is the same as the last digit of the Student ID, in order not to create confusion
  $newNFC -> bind_param("s", $_POST[currSID]);
  
  
  $updateSql = ("UPDATE studentdata SET NFCID = %s WHERE StudentID = %s");
  $updateSql -> bind_param("ii", $_POST[newNFC], $_POST[currSID]);
  $currSID -> execute();
  $currSID -> close();
  
  $currID -> execute();
  $currID -> close();
  
  $currSID -> execute();
  $currSID -> close();
  
  $newNFC -> execute();
  $newNFC -> close();
  
  $fetchupdatesql = "SELECT Username, NFCID FROM studentdata";
  $fetchupdatesql = mysqli_query($conn, $sql);
  
 ?>


 
 
 
 <!DOCTYPE html>
 <html>
 <head>Replacing the NFC tag.</head>
 <body>
   <?php if(mysqli_num_rows($result) > 0)
   {
     // Show data for each row
     while($row = mysqli_fetch_assoc($result))
     {
       echo "|The student whose NFCID needs replacement: ".$row['Username']."|The NFCID to be replaced:".$row['NFCID']."; \n";
     }
 
	 while($row = mysqli_fetch_assoc($fetchupdatesql))
     {
       echo "|There was a new NFC ID update to the student with the SID: ".$row['Username']."|The new NFC tag code assigned :".$row['NFCID']."; \n";
     }
   } ?>
 </body>
 </html>
