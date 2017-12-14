<?php
	//
	session_start();
	if(isset($_SESSION['username'])){
		header('Location:  menu.php');
		exit();
	}
	//
	$usernameErr = "";
	$username = "";
	$passwordErr = "";
	$password = "";
	$messages="";
	if($_POST){
		$username = $_POST['username'];
		$password = $_POST['password'];
		if (empty($username) || strlen($username) < 4 ){
			$messages=$messages . "Username is required, at least 4 chars <br><br>";
		}
		
		if (strlen($password) < 6 )
			$messages=$messages . "password 6 or more chars <br><br>";
			   
		if ($messages=="") {
		  try {
			$host = '127.0.0.1';
			$dbname = 'library';
			$user = 'root';
			$pass = '';
			# MySQL with PDO_MYSQL
			$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

			$q = $DBH->prepare("select * from users where username = :username LIMIT 1");
			$q->bindValue(':username', $username);
			$q->execute();
			
			$row = $q->fetch(PDO::FETCH_ASSOC);
			 
			if ($q->rowCount() > 0) {
				$phash = $row['password'];
				if (password_verify($password,$phash)) {
					$_SESSION["users_id"] = $row['users_id'];
					$_SESSION["username"] = $username;
					$_SESSION["type"]=$row['type'];
					header('Location:  menu.php');
					exit();
				}
				else 
					$messages= 'Invalid password.';
				
			} else {
				$messages= 'Sorry your log in details are not correct';
			}
		} catch(PDOException $e) {echo $e->getMessage();}
		}
	}
?>
<!DOCTYPE>
<html>
<head>
</head>
<body>
<h1>Welcome to Vilmarys's library, LOGIN</h1> <a href="index.php">Home</a>
<hr>
<?php echo $messages;?>
<form action="login.php" method="post">
Username <input type="text" name="username" value="<?php echo $username;?>" />   <br>
Password <input type="password" name="password" maxlength="10" />   <br>
<input type="submit" value="Accept" />
</form>
</body>
</html>