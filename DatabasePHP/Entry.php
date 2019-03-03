<!DOCTYPE html>
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
      
      $nfc_id = $_GET['nfcid'];
      echo $nfc_id;
      echo "<br>";
      $student_id = $_GET['studid'];
      echo $student_id;
      echo "<br>";
      
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
      
      
      
      # check if the nfccode is in the database  
      # check if the student has a lesson in the room and at the time
      # add 1 fo the attendance section (present, late, absent)
      # 
    ?>
  </body>
</html>
