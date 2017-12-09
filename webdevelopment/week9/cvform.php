<?php
if ($_POST) {
	echo $_POST['username'];
	echo $_POST['age'];
	echo $_POST['tel'];
}
?>
<!DOCTYPE>
<html>
<head>
</head>
<body>
<form action="cvform.php" method="post">
Username <input type="text" name="username"/>   <br>
Age <input type="number" name="age" />    <br>
Telephone <input type="text" name="tel" />   <br>
<input type="submit"/>
</form>
</body>
</html>
