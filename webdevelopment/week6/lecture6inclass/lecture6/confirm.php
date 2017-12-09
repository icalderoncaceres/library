<?php
session_start();

?>
<!DOCTYPE html>
<html>
<body>

<?php
	// get session variables
	if (isset($_SESSION["username"]))  {
		echo "<br/>Logged in as: ".$_SESSION["username"];
		echo "<br/>email: ".$_SESSION["email"];
	 }
?>	

</body>
</html>					 