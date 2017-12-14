<?php
session_start();
if(!isset($_SESSION['username'])){
	header('Location:  index.php');
	exit();
}


	try {
		$host = '127.0.0.1';
		$dbname = 'library';
		$user = 'root';
		$pass = '';
		# MySQL with PDO_MYSQL
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$listBooks = $DBH->prepare("select * from out_books where users_id=?");
		$listBooks->bindParam(1, $_SESSION["users_id"]);
		$listBooks->execute();

	} catch(PDOException $e){
		echo $e->getMessage();
	}

?>
<!DOCTYPE>
<html>
<head>
</head>
<body>

<h1>Welcome to Vilmarys's library</h1>
<hr>
YOUR CHECKOUT BOOKS <br /><a href="menu.php">Go back</a>
<br /><br /> 
<form action="checkout.php" method="post">
	<input type="text" name="filter" />
	<input type="submit" value="Search" />
</form>
<br><br>

<table>
	<thead>
		<tr>
			<th width="5%">ID</th>
			<th width="30%">Title</th>
			<th width="10%">Start</th>
			<th width="10%">Due</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($listBooks as $book):?>
			<tr>
				<td><?php echo $book['books_id'];?></td>				
				<td><?php echo $book['books_title'];?></td>
				<td><?php echo $book['startdate'];?></td>
				<td><?php echo $book['duedate'];?></td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>

</body>
</html>