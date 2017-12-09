<?php
//
session_start();
//
$usernameErr = "";
$username = "";
$emailErr = "";
$email = "";
$passwordErr = "";
$password = "";
if($_POST){
    $username = $_POST['username'];
    $password = $_POST['password'];
	$email = $_POST['email'];
	
	if (empty($username) || strlen($username) < 4 ) 
               $usernameErr = "Username is required, at least 4 chars";
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$emailErr = 'Sorry you did not enter a correct email! ';
	}
	if (strlen($password) < 8 ) {
			$passwordErr = 'password 8 or characters';  
	}
	
	if (empty($usernameErr) && empty($emailErr) && empty($passwordErr)) {		   
    
	  try {
        $host = '127.0.0.1';
        $dbname = 'wdtest';
        $user = 'root';
        $pass = '';
        # MySQL with PDO_MYSQL
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		
		$checkUserStmt = $DBH->prepare("select * from users where username = ?" );
		$checkUserStmt->bindParam(1, $username);
		$checkUserStmt->execute();
		
		if ($checkUserStmt->rowCount() == 0) { //no user with this $name exists
		
			$phash = password_hash($password, PASSWORD_BCRYPT);
	 
			$sql = "INSERT INTO Users (username, password, email) VALUES (?, ?, ?);";
			$sth = $DBH->prepare($sql);
			
			$sth->bindParam(1, $username);
			$sth->bindParam(2, $phash);
			$sth->bindParam(3, $email);
			
			$sth->execute();
			$_SESSION["username"] = $username;
			$_SESSION["email"] = $email;
			$_SESSION["user_id"] = $DBH->lastInsertId(); 
			header('Location:  confirm.php');
			exit();
		}
		else
			echo 'Username already taken!';
		 } catch(PDOException $e) {echo $e->getMessage();} 
	}	 
}
?>
<!DOCTYPE>
<html>
<head>
  <link rel="stylesheet" href="style.css">
    <style>
	.error {display: block;color: #FF0000; }
	</style>
</head>
<body>
<h2> Registration Form</h2>
<form class='form-style' action="register.php" method="post">
Username <input type="text" name="username" value="<?php echo $username; ?>"/>
         <span class = "error"><?php echo $usernameErr;?></span>
email <input type="text" name="email" value="<?php echo $email; ?>"/>
		 <span class = "error"><?php echo $emailErr;?></span>	
Password <input type="password" name="password" value="<?php echo $password; ?>"/>
       	 <span class = "error"><?php echo $passwordErr;?></span>	
<input type="submit" class='button' name='submit' value= 'Register'/>
</form>
</body>
</html>