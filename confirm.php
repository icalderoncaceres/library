<?php
session_start();

?>
<!DOCTYPE html>
<html>
<body>

<?php
	// get session variables
	if (isset($_SESSION["username"]))  {
		echo "<br/>Logged in as: ".$_SESSION["username"] . "<br>";
		echo "<br/>id: ".$_SESSION["users_id"] . "<br>";
		echo "<a href='menu.php'></a>";
	 }
?>	

</body>
</html>					 