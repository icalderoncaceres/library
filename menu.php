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
MAIN MENU
<hr>
<?php
if($_SESSION['type']=='student'):?>
	
	<a href="#">1. Search the library for book using title, including wildcard search.</a><br><br>
	<a href="#">2. Checkout a book from the library if it is available.</a><br><br>
	<a href="#">3. View their checked out books, displaying due date.</a><br><br>
	<form class='form-style' action="menu.php" method="post">
	<input type="submit" name="submit" value="4. Logout of the system, invalidating the current session." class='button'/>
	</form>


<?php
else:?>
	<a href="#">5. View Checked out books</a><br><br>
	<a href="#">6. Check a book back in</a><br><br>
	<a href="#">7. View books past their due date with student id displayed.</a><br><br>
	<a href="#">8. Add a new book to the system</a><br><br>
	<a href="#">9. Logout of the system, invalidating the current session.</a><br><br>
<?php
endif;
?>
</body>
</html>