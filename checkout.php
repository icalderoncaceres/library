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
		$listBooks = $DBH->prepare("select * from books");
//		$listBooks->bindParam(1, $username);
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
CHECKOUT BOOK <br /><a href="menu.php">Go back</a>
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
			<th width="15%">ISBN</th>
			<th width="40%">Title</th>
			<th width="30%">Author</th>
			<th width="10%">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($listBooks as $book):?>
			<tr>
				<td><?php echo $book['books_id'];?></td>
				<td><?php echo $book['isbn'];?></td>
				<td><?php echo $book['title'];?></td>
				<td><?php echo $book['author'];?></td>
				<td>
					<form action="checkout.php" method="post">
						<input type="hidden" value="<?php echo $book["books_id"];?>">
						<input type="submit" value="Checkout" />
					</form>
				</td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>

</body>
</html>
