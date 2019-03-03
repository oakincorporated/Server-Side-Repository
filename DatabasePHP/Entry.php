<!DOCTYPE html>
<html>
  <head>
  </head>
  <body>
    <?php

      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "realworldproject";
  
      $conn = new mysqli($servername, $username, $password, $dbname);
      if (!$conn)
      {
        die("Connection fail.". mysqli_connect_error());
      }
    
      
    if isset($_GET['nfcid'])
    {
       $nfc_id = $_GET['nfcid'];
    }else{
        die();
      }
    
    if isset($_GET['studid'])
    {
      $student_id = $_GET['studid'];
    }else{
        die();
      }    
      
      
      $sql = 'SELECT NFCID FROM studentdata'; 
      $result = mysqli_query($conn, $sql);
      
      while($row = mysqli_fetch_assoc($result)){
        $currentNFCFound = $row['NFCID'];
        if($currentNFCFound == $nfc_id){
          //echo 'yes';
          $nfcWasFound = true;
          break;
        }else{
          //echo 'no';
          $nfcWasFound = false;
        }
      
      }
      
      if($nfcWasFound){
        echo 'You are in the database';
      }
      else
      {
      echo 'You are not in the database';
      }
    ?>
  </body>
</html>
