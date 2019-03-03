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

$sql = "SELECT username, attended, late, absent, total_classes FROM attendancedata";
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
			echo "|username:".$row["username"]."|attended:".$row["attended"]."|late:".$row["late"]."|absent:".$row["absent"]."|total_classes".$row["total_classes].";";
		}
	} ?>
</body>
</html>	
