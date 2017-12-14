<?php
session_start();
if(!isset($_SESSION['username'])){
	header('Location:  index.php');
	exit();
}

$message="";
try {
	$host = '127.0.0.1';
	$dbname = 'library';
	$user = 'root';
	$pass = '';
	# MySQL with PDO_MYSQL
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$listBooks = $DBH->prepare("select * from books");
	$listBooks->execute();
	if($_POST){
		var_dump($_POST['books_id']);
		var_dump($_POST['books_title']);
		var_dump($_SESSION['users_id']);
		var_dump($_SESSION['username']);
		var_dump(date("Y-m-d H:i:s",time()));
		try {
			$sql = "INSERT INTO out_books (books_id, books_title, users_id, studentname, startdate,duedate) VALUES (?, ?, ?, ?, ?, ?);";
			$sth = $DBH->prepare($sql);					
			$sth->bindParam(1, $_POST['books_id']);
			$sth->bindParam(2, $_POST['books_title']);
			$sth->bindParam(3, $_SESSION['users_id']);
			$sth->bindParam(4, $_SESSION['username']);
			$sth->bindParam(5, date("Y-m-d H:i:s",time()));
			$sth->bindParam(6, date("Y-m-d H:i:s",time()));
			$sth->execute();
			$message="<div>Success</div><hr>";
		} catch(PDOException $e){
			echo $e->getMessage();
		}

	}
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
<?php echo $message;?>
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
						<input type="hidden" name="books_id" value="<?php echo $book["books_id"];?>">
						<input type="hidden" name="books_title" value="<?php echo $book["title"];?>">
						<input type="submit" value="Checkout" />
					</form>
				</td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>

</body>
</html>
