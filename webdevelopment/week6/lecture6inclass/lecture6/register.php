<?php
//
session_start();
// This is a very small sample register page. The user will fill out their information
// on the form. When they click the submit button, the data will be inserted into the database.
$usernameErr = "";
$username = "";
$email = ""; //cree esta variable para email 
$emailErr= ""; //cree esta para error y abajo tambien modifique 
if($_POST){
    $username = $_POST['username'];
    $password = $_POST['password'];
	$email = $_POST['email'];
	
	if (empty($username) || strlen($username) < 4 ) 
               $usernameErr = "Username is required, at least 3 chars"; //get an error message
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    			$emailErr = 'Sorry you did not enter a correct email! ';
			   
	if (empty($usernameErr) &&  empty($emailErr)) {		   
    
	  try {
        $host = '127.0.0.1';
        $dbname = 'wdtest';
        $user = 'root';
        $pass = '';
        # MySQL with PDO_MYSQL
 		
        # MySQL with PDO_MYSQL
		
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
   

		$sql = "INSERT INTO Users (username, password, email) VALUES (?, ?, ?);";
		$sth = $DBH->prepare($sql);
		
		$sth->bindParam(1, $username);
		$sth->bindParam(2, $password);
		$sth->bindParam(3, $email);
		
		$sth->execute();
		$_SESSION["username"] = $username; //it sent it to my other page ..repetir este codigo. in confirm php acceso a  mis variablesusername and email
		$_SESSION["email"] = $email;
		header('Location:  confirm.php'); //aqui esta el path to confirm page 
		exit();
		
		echo 'You are now registered!';
		 } catch(PDOException $e) {echo 'Error' . $e;} 

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
email <input type="text" name="email"/>
<span class = "error"><?php echo $emailErr;?></span> 
Password <input type="password" name="password"/>
<input type="submit" class='button' name='submit' value= 'Register'/>
</form>
</body>
</html>