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

$sql = "SELECT StudentID, Present, Late, Absent FROM attendance_t";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head></head>
<body>
<?php if(mysqli_num_rows($result) > 0)
    {
		while($row = mysqli_fetch_assoc($result)) //Information for every row will be shown
		{
			echo "|StudentID:".$row["StudentID"]."|Present:".$row["present"]."|Late:".$row["Late"]."|Absent:".$row["absent"].";";
		}
	} ?>
</body>
</html>
