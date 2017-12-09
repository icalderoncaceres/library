<?php
$usernameErr = "";
$username = "";
$emailErr = "";
$email = "";
$captchaErr = "";
if ($_POST) {
	// grab recaptcha library
	include "recaptchalib.php";
	
	$username = $_POST['username'];
    $email = $_POST['email'];
	
	if (empty($username) || strlen($username) < 4 ) 
        $usernameErr = "Username is required, at least 4 chars";
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$emailErr = 'Sorry you did not enter a correct email! ';
	}
	// your secret key
	$secret = "6LeyyDoUAAAAAI2sN9Ep-z6wtJsxOjclHGpbAAyK"; 
	// empty response
	$response = null;	 
	// check secret key
	$reCaptcha = new ReCaptcha($secret); 
	// if submitted check response
	if ($_POST["g-recaptcha-response"]) {
		$response = $reCaptcha->verifyResponse(
			$_SERVER["REMOTE_ADDR"],
			$_POST["g-recaptcha-response"]
		);
	}
	if ($response != null && $response->success) 
		$captchaErr="";  
	else
		$captchaErr="Bad Response from Captcha"; 

	if (empty($captchaErr)&& empty($usernameErr)&& empty($emailErr)) {
		echo "validation passed";
		//do database stuff and navigate to next php file
	}	
			
		
} 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <style>
	.error {display: block;color: #FF0000; }
	label,input  {
	 display:block;
	 margin-bottom: 5px; 
	 }
	</style>
    <title>How to Integrate Google “No CAPTCHA reCAPTCHA” on Your Website</title>
  </head>
 
  <body>
 
    <form action="register.php" method="post">
 
      <label for="username">Name:</label>
      <input name="username" type="text" value="<?php echo $username; ?>"><br />
	  <span class = "error"><?php echo $usernameErr;?></span>
 
      <label for="email">Email:</label>
      <input name="email" type="email" value="<?php echo $email; ?>"><br />
	  <span class = "error"><?php echo $emailErr;?></span>
 
      <div class="g-recaptcha" data-sitekey="6LeyyDoUAAAAAKFOdy67licu2jriJoSDH2YZ2os7"></div>
	  <span class = "error"><?php echo $captchaErr;?></span>	
      <input type="submit" value="Submit" />
 
    </form>
 
    <!--js-->
    <script src='https://www.google.com/recaptcha/api.js'></script>
 
  </body>
</html>