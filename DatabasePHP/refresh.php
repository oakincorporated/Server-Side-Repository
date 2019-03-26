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
			
			
			$sql = "Update class_t SET Attended = 0";
			mysqli_query($conn, $sql);
			
		?>
	</body>
</html>
