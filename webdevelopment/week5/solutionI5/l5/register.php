<?php
//
// This is a very small sample register page. The user will fill out their information
// on the form. When they click the submit button, the data will be inserted into the database.
if($_POST){
    $username = $_POST['username'];
    $password = $_POST['password'];
	$email = $_POST['email'];
    
    try {
        $host = '127.0.0.1';
        $dbname = 'wdtest';
        $user = 'root';
        $pass = '';
        # MySQL with PDO_MYSQL
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
   

    $sql = "INSERT INTO Users (username, password, email) VALUES (?, ?, ?);";
    $sth = $DBH->prepare($sql);
	
	$sth->bindParam(1, $username);
	$sth->bindParam(2, $password);
	$sth->bindParam(3, $email);
	
	$sth->execute();
    
    echo 'You are now registered!';
     } catch(PDOException $e) {echo 'Error' . $e;} 

     
}
?>
<!DOCTYPE>
<html>
<head>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<h2> Registration Form</h2>
<form class='form-style' action="register.php" method="post">
Username <input type="text" name="username"/>
email <input type="text" name="email"/>
Password <input type="password" name="password"/>
<input type="submit" class='button' name='submit' value= 'Register'/>
</form>
</body>
</html>