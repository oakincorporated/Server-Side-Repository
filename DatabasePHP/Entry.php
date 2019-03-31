<!DOCTYPE html>
  <body>
    <?php

      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "realworldproject";
	  
      $conn = new mysqli($servername, $username, $password, $dbname);
      if (!$conn){
        die("Connection fail.". mysqli_connect_error());
      }
	  else{
		  echo'Connected to Database<br>';
		  echo'<br>';
	  }
      
	  date_default_timezone_set('Europe/London');	#TIME STAMPS
      $scanTime = date("H:i:s");
	  echo('Current Time:  ' . $scanTime . "<br>");
      $scanDate = date("D jS F Y");
	  echo('Date:  ' . $scanDate . "<br>");
	  echo'<br>';
	  
	  #$currentTime = date('His'); # real timestamp
	  #$currentday = date("N");
	  
	  $currentTime = 100000;		# demo timestamps
	  
	  $currentday = 1;
	  
	  $timestamp = strtotime($currentTime);
	  
	  $RoomID = 'ECG-10';			# would be. room scanner input
	 
      $nfc_id = mysqli_real_escape_string($conn, $_GET['nfcid']);		# Parameters
      echo 'NFC ID:  ' . $nfc_id . '<br>';
      $student_id = mysqli_real_escape_string($conn, $_GET['studid']);
	  
      echo 'Student ID:  ' . $student_id . '<br>';
	  echo '<br>';
	  
      $sql = 'SELECT NFC_ID FROM student_t'; 	# SQL queries for NFC_ID
      $result = mysqli_query($conn, $sql);
      
      while($row = mysqli_fetch_assoc($result)){
        $currentNFCFound = $row['NFC_ID'];
		
        if($currentNFCFound == $nfc_id){
          $nfcWasFound = true;
          break;
        }
		else{
			$nfcWasFound = false;
        }
      
      }
      
      if($nfcWasFound){
        echo 'You are in the Database <br>';
		$sql = 'SELECT Student_ID FROM student_t'; # check for the student id
		$result = mysqli_query($conn, $sql);
		
		while($row = mysqli_fetch_assoc($result)){
			$studentrow = $row['Student_ID'];
			if($studentrow == $student_id){
				$isCorrect = true;
				break;
			}
			else{
				$isCorrect = false;
			}
			}
		}
		
		if ($isCorrect){
			echo"Your Student ID is correct <br>";
			$sql = "SELECT Day FROM class_t WHERE Student_ID = '$student_id' AND Day = '$currentday'"; 	# check if the student has a lesson on this day
			$result = mysqli_query($conn, $sql);
			
			while($row = mysqli_fetch_assoc($result)){
				$classday = $row['Day'];
			
				if ($classday == $currentday){
					$todayclass = true;
					break;
			}
				else{
					$todayclass = false; 
				}
			}
		}
		if($todayclass){
			echo'You have a class today <br>';
			$sql = "SELECT Start_Time FROM class_t WHERE Student_ID = '$student_id' AND Day = '$currentday' AND Start_Time >= '$timestamp' + 001500 AND End_Time <= '$timestamp'"; # check for when the class is on the day
			$result = mysqli_query($conn, $sql);		
							
			while($row = mysqli_fetch_assoc($result)){
				$classTime = $row['Start_Time'];
				$startTime = strtotime($classTime);
				
			$sql = "SELECT Attended FROM class_t WHERE Student_ID = '$student_id' AND Day = '$currentday' AND Start_Time >= '$timestamp' + 001500 AND End_Time <= '$timestamp'";
			$result = mysqli_query($conn, $sql);
				
			while($row = mysqli_fetch_assoc($result)){
				$attended = $row['Attended'];
				
			if($attended == 1){ 		# checks if a user has already signed in on the lecture
				exit('You have already signed in on this lecture');
					} 
				}

				if ($timestamp <= ($startTime) && $timestamp >= ($startTime - 900)){	# check if they are on time
					
					$onTime = true;
				}
					
				else{
					$onTime = false;
				}
			}
		}
		else{
			exit('No classes today');
			
		}	
			if ($onTime){	# if on time add 1 to present on sql database
				echo'You are on time <br>';
				$sql = "SELECT Class_ID FROM class_t WHERE Student_ID = '$student_id' AND Day = '$currentday' AND Start_Time >= '$timestamp' + 001500 AND End_Time <= '$timestamp'"; #check sthe lecture a student has
				$result = mysqli_query($conn, $sql);
					
				while($row = mysqli_fetch_assoc($result)){
					$classID = $row['Class_ID'];	
				}

				$sql = "SELECT Room FROM class_t WHERE Student_ID = '$student_id' AND Day = '$currentday' AND Start_Time >= '$timestamp' + 001500 AND End_Time <= '$timestamp'"; #check sthe lecture a student has
				$result = mysqli_query($conn, $sql);
				
				while($row = mysqli_fetch_assoc($result)){
					$LectureRoom = $row['Room'];
				}
				if($LectureRoom != $RoomID){
					exit('wronge room');
				}
		
				$sql = "UPDATE attendance_t SET Present = Present + 1 WHERE Student_ID = '$student_id'";
			 	mysqli_query($conn, $sql);
				
				
				$sql = "UPDATE class_t SET Attended = 1 WHERE Class_ID = '$classID'";
				mysqli_query($conn, $sql);
				exit('You attendance has been updated');
			}	
				
			else{		# if not on time check if they are late
				$sql = "SELECT End_Time FROM class_t WHERE Student_ID = '$student_id' AND Day = '$currentday'";
				$result = mysqli_query($conn, $sql);
				
				while($row = mysqli_fetch_assoc($result)){
					$time = $row['End_Time'];
					$endTime = strtotime($time);
					
						if($timestamp >= ($startTime + 900) & $timestamp <= $endTime){
							$isLate = true;
					}
						else{
							$isLate = false;
					}
				}
			}
			if($isLate){
				$sql = "SELECT Class_ID FROM class_t WHERE Student_ID = '$student_id' AND Day = '$currentday' AND Start_Time >= '$timestamp' + 001500 AND End_Time <= '$timestamp'"; #check sthe lecture a student has
				$result = mysqli_query($conn, $sql);
				
				while($row = mysqli_fetch_assoc($result)){
					$classID = $row['Class_ID'];
					
				echo'You are late <br>';
				$sql = "UPDATE attendance_t SET Late = Late + 1 WHERE Student_ID = '$student_id'";
				mysqli_query($conn, $sql);
				
				$sql = "UPDATE class_t SET Attended = 1 WHERE Class_ID = '$classID'";
				mysqli_query($conn, $sql);
				
				exit('Your attendance has been updated');				
				}
			}
			
      # PARAMETERS - ?nfcid=56:F9:P0:32:H6:T4:G7&studid=7649394
    ?>
  </body>
</html>
