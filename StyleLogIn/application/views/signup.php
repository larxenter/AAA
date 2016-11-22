<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Sign up Page</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('css/signup.css')?>">
</head>
<body>
<div id="vide"></div>

<div id="container">
	<div id="box1">
		<div id="switch"><a href="<?php echo base_url() . 'main/login_validation' ?>">login!</a></div>
		<h1>Sign Up</h1>
		
		<?php

		echo form_open('main/signup_validation');

		echo validation_errors();

		echo "<p>Email:";
		echo form_input('email', $this->input->post('email'));
		echo "</p>";

		echo "<p>Password:";
		echo form_password('password');
		echo "</p>";

		echo "<p>Confirm Password:";
		echo form_password('cpassword');
		echo "</p>";

		echo "<p>";
		echo form_submit('signup_submit', 'Sign up');
		echo "</p>";

		echo form_close();

		?>
	</div>
</div>
</body>
</html>