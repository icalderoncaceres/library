
<?php
//
if($_POST){
    $username = $_POST['username'];
    $password = $_POST['password'];
	
    
    try {
        $host = '127.0.0.1';
        $dbname = 'wdtest';
        $user = 'root';
        $pass = '';
        # MySQL with PDO_MYSQL
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
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
			$message = 'Logged in as: '.$username;
		} else {
		    $message= 'Sorry your log in details are not correct';
		}
	} catch(PDOException $e) {echo 'Error';}
}
?>
<!DOCTYPE>
<html>
<head>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Login</h2><br></br>   
<form class='form-style' action="login.php" method="post">  
Username <input type="text" name="username"/>  
Password <input type="password" name="password"/>
<input type="submit" name="submit" value="Login" class='button'/>
<?php
if(!empty($message)){  echo '<br>';
echo $message;
}
?>
</form>
</body>
</html>