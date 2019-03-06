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
      
	  date_default_timezone_set('Europe/London');	#TIME STAMPS
      $scanTime = date("H:i:s");
	  echo($scanTime . "<br>");
      $scanDate = date("D jS F Y");
	  
	  $currentday = date("N");
	  # echo($currentday . "<br>");
      echo($scanDate . "<br>");
	  
	  
      $nfc_id = $_GET['nfcid'];		# Parameters
      echo $nfc_id;
      echo "<br>";
      $student_id = $_GET['studid'];
      echo $student_id;
      echo "<br>";
      
	  
	  
      $sql = 'SELECT NFC_ID FROM student_t'; 	# SQL queries for NFC_ID
      $result = mysqli_query($conn, $sql);
      
      while($row = mysqli_fetch_assoc($result)){
        $currentNFCFound = $row['NFC_ID'];
		
        if($currentNFCFound == $nfc_id){
          $nfcWasFound = true;
          break;
        }else{
          $nfcWasFound = false;
        }
      
      }
      
      if($nfcWasFound){
        echo 'you are in the database <br>';
		
		
		
		$sql = 'SELECT Student_ID FROM student_t'; # check for the student id
		$result = mysqli_query($conn, $sql);
		
		while($row = mysqli_fetch_assoc($result)){
			$studentID = $row['Student_ID'];
			if($student_id == $studentID){
				$isCorrect = true;
				break;
			}
			else{
				$isCorrect = false;
			}
			}
		}
		
		if ($isCorrect){
			echo"you student ID is correct <br>";
			$sql = 'SELECT Day FROM class_t'; # check if the student has a lesson on this day
			$result = mysqli_query($conn, $sql);
			
			while($row = mysqli_fetch_assoc($result)){
				$classDay = $row['Day'];
			
				if ($classDay == $currentday){
					$todayclass = true;
					break;
			}
				else{
					$todayclass = false; 
				}
			}
			}
			if($todayclass){
				echo'you have a class today <br>';
				$sql = 'UPDATE attendance_t SET Present = Present + 1';
				mysqli_query($conn, $sql);
				echo'you attendance has been updated';
				
			}
			else{
				echo'you dont have a class today';
			}
	  
	  
	  
      # add 1 fo the attendance section (present, late, absent)
      # 
    ?>
  </body>
</html>
