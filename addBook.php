<?php
session_start();
if(!isset($_SESSION['username'])){
	header('Location:  index.php');
	exit();
}

if($_POST){
	$_SESSION=array();
	session_destroy();
	header('Location:  index.php');
	exit();
}
?>
<!DOCTYPE>
<html>
<head>
</head>
<body>

<h1>Welcome to Vilmarys's library</h1>
<hr>
VIEW PAST BOOK

</body>
</html>
