<?php
	
   
		print_r($_POST);

		echo "<br/>"."First Name: ".$_POST['firstname'];
		echo "<br/>"."Gender: ".$_POST['gender'];
		echo "<br/>"."Car: ".$_POST['cartype'];
		echo "<br/>"."Text: ".$_POST['sometext'];
		$vehicles = $_POST['vehicle'];
		foreach ($vehicles as $value)
			echo "<br/>Vehicle: ".$value;
		
	 
?>