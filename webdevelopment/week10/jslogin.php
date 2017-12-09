<?php
 if ($_POST) {
	 echo $_POST['username'];
	 echo $_POST['email'];
 }	 
?>
<html>
<head>
</head>
<body>
<form id='form1' action='jslogin.php' method='post' onsubmit='return validate()'>
username: <input type='text' id='username' name='username' ><br/>
email: <input type='email' name='email'  ><br/>
<input type='submit' value='submit'>
</form>
<script>
function validate(){

  var test= document.getElementById('username');
  if (test.value == "" || test.value.length < 4 ){
	  alert("Please Enter Username");
	  return false;
  }
  else 
	  return true;   
}
</script>
</html>