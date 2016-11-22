<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('css/login.css')?>">
</head>
<body>
<div id="vide"></div>
<div id="container">
	<div id="switch"><a href="<?php echo base_url() . 'main/signup' ?>">Sign Up!</a></div>
	<h1>Login</h1>
	
	<?php

	echo form_open('main/login_validation');

	echo validation_errors();

	echo "<p>Email:";
	echo form_input('email', $this->input->post('email'));
	echo "</p>";

	echo "<p>Password:";
	echo form_password('password');
	echo "</p>";

	echo "<p>";
	echo form_submit('login_submit', 'login');
	echo "</p>";

	echo form_close();

	?>
	
</div>

</body>
</html>