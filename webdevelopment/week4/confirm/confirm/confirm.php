<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
	// get session variables
	print_r($_SESSION); 
	echo "<br/>".$_SESSION["name"];
?>					
</body>
</html>					 