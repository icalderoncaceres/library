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

	<a href="search.php">1. Search the library for book using title, including wildcard search.</a><br><br>
	<a href="checkout.php">2. Checkout a book from the library if it is available.</a><br><br>
	<a href="viewCheckout.php">3. View their checked out books, displaying due date.</a><br><br>
	<form class='form-style' action="menu.php" method="post">
	<input type="submit" name="submit" value="4. Logout of the system, invalidating the current session." class='button'/>
	</form>


<?php
else:?>
	<a href="viewCheckout.php">5. View Checked out books</a><br><br>
	<a href="checkBack.php">6. Check a book back in</a><br><br>
	<a href="viewPast.php">7. View books past their due date with student id displayed.</a><br><br>
	<a href="addBook.php">8. Add a new book to the system</a><br><br>
	<form class='form-style' action="menu.php" method="post">
	<input type="submit" name="submit" value="4. Logout of the system, invalidating the current session." class='button'/>
	</form>
<?php
endif;
?>
</body>
</html>
