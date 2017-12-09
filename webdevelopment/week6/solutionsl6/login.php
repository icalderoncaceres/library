
<?php
//
session_start();
//
$usernameErr = "";
$username = "";
$passwordErr = "";
$password = "";
if($_POST){
    $username = $_POST['username'];
    $password = $_POST['password'];
	if (empty($username) || strlen($username) < 4 ) 
               $usernameErr = "Username is required, at least 4 chars";
	if (strlen($password) < 8 ) {
			$passwordErr = 'password 8 or more chars';  
	}
		   
	if (empty($usernameErr) && empty($passwordErr)) {		   
    
      try {
        $host = '127.0.0.1';
        $dbname = 'wdtest';
        $user = 'root';
        $pass = '';
		$port=3306;
        # MySQL with PDO_MYSQL
        $DBH = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $user, $pass);
		$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$q = $DBH->prepare("select * from users where username = :username and password = :password LIMIT 1");
		$q->bindValue(':username', $username);
		$q->bindValue(':password', $password);
		$q->execute();
		
		$row = $q->fetch(PDO::FETCH_ASSOC);
		 
		//returns table row(s) as an associative array
		//of values column names to data values
		//Array ( [id] => 1 [username] => seaanc 
		//        [email] => 12345 [password] => 12345 [date] => 2017-10-05 14:06:07 )
		$message = '';
		if (!empty($row)){ //is the array empty
			$username = $row['username'];
			$email = $row['email'];
			$_SESSION["username"] = $username;
			$_SESSION["email"] = $email;
			header('Location:  confirm.php');
		exit();
		} else {
		    $message= 'Sorry your log in details are not correct';
		}
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
<h2>Login</h2><br></br>   
<form class='form-style' action="login.php" method="post">  
Username <input type="text" name="username" value="<?php echo $username; ?>"/>
         <span class = "error"><?php echo $usernameErr;?></span>
Password <input type="password" name="password" value="<?php echo $password; ?>"/>
       	 <span class = "error"><?php echo $passwordErr;?></span>	

<input type="submit" name="submit" value="Login" class='button'/>
<?php
if(!empty($message)){  echo '<br>';
echo $message;
}
?>
</form>
</body>
</html>