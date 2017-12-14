<?php
	session_start();
	if(isset($_SESSION['username'])){
		header('Location:  menu.php');
		exit();
	}
	$messages="";
	$username="";
	$password="";
	$password_confirm="";
	$type='student';
	if($_POST){
		$username=$_POST['username'];
		$password=$_POST['password'];
		$password_confirm=$_POST['password_confirm'];
		if(empty($username) || strlen($username) < 4){
			$messages=$messages . "Username is required, at least 4 chars <br><br>";
		}
		if(empty($password) || strlen($password) < 6){
			$messages=$messages . "'password 6 or characters <br><br>";
		}
		
		if(empty($password_confirm) || strlen($password_confirm) < 6){
			$messages=$messages . "'password 6 or characters <br><br>";
		}

		if($_POST['password']!=$_POST['password_confirm']){
			$messages=$messages . "password not match <br><br>";
		}
		if($messages==""){
			try {
				$host = '127.0.0.1';
				$dbname = 'library';
				$user = 'root';
				$pass = '';
				# MySQL with PDO_MYSQL
				$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
				
				$checkUserStmt = $DBH->prepare("select * from users where username = ?" );
				$checkUserStmt->bindParam(1, $username);
				$checkUserStmt->execute();
				
				if ($checkUserStmt->rowCount() == 0) { //no user with this $name exists
				
					$phash = password_hash($password, PASSWORD_BCRYPT);
			 
					$sql = "INSERT INTO Users (username, password, type) VALUES (?, ?, ?);";
					$sth = $DBH->prepare($sql);
					
					$sth->bindParam(1, $username);
					$sth->bindParam(2, $phash);
					$sth->bindParam(3, $type);
					
					$sth->execute();
					$_SESSION["username"] = $username;
					$_SESSION["users_id"] = $DBH->lastInsertId();
					$_SESSION["type"]=$type;
					header('Location:  confirm.php');
					exit();
				}
				else
					echo 'Username already taken!';
			} catch(PDOException $e) {echo $e->getMessage();
			} 

		}
	}
?>
<!DOCTYPE>
<html>
<head>
</head>
<body>
<h2> Registration Form</h2> <a href="index.php">Home</a>
<hr>
<?php echo $messages;?>
<form action="register.php" method="post">
Username <input type="text" name="username" maxlength="50" value="<?php echo $username;?>" />   <br>
Password <input type="password" name="password" maxlength="10" value="<?php echo $password;?>" />   <br>
Confirm <input type="password" name="password_confirm" maxlength="10" value="<?php echo $password_confirm;?>" />   <br>
<input type="submit" value="Save"/>
</form>
</body>
</html>