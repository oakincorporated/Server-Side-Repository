<html>
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
      
			$currentday = date("N");
	
			#$currentday = 1;   # demo timestamps
	
			$sql = 'SELECT Student_ID FROM student_t'; 	# SQL queries for NFC_ID
			$result = mysqli_query($conn, $sql);
      
			while($row = mysqli_fetch_assoc($result)){
				$studentID = $row['Student_ID'];
				echo($studentID . '<br>');
		
			}
			echo'<br>';
	
			$sql = "SELECT Student_ID FROM class_t WHERE Attended = 0 AND Day = '$currentday'";
			$result = mysqli_query($conn, $sql);
      
			while($row = mysqli_fetch_assoc($result)){
				$Absences = $row['Student_ID'];
				echo($Absences . " has missed a lacture <br>");
				$sqlquery = "UPDATE attendance_t SET Absent = Absent + 1 WHERE Student_ID = '$Absences'";
				mysqli_query($conn, $sqlquery);
				echo('Attendance updated for ' . $Absences);
			}
		?>
	</body>
</html>
