<?php
if(!isset($_SESSION))
	session_start();

if(isset($_SESSION['username'])){
	header('Location:  menu.php');
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
<a href="register.php"><button>Register</button></a>
<a href="login.php"><button>Login</button></a>
</body>
</html>