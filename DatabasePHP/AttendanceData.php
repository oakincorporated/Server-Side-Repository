<?php

$username = ""
$attended = 0
$late = 0
$absent = 0
$total_classes = 0

$conn = new sqli($username, $attended, $late, $absent, $total_classes); //Creates the connection

if (!$conn)
{
	die("Connection fail.".mysqli_connect_error()); //Assess the connection
}

$sql = "SELECT username, attended, late, absent, total classes FROM attendancedata";
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
