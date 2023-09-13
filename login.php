<?php
    session_start();
    if(isset($_SESSION['user_id'])){
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Item Manager</title>
		<link rel="stylesheet" href="css/fonts.css">
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>

		<div id="container" class="container_login">

				<form class="login" action="./php/login.php">
					<h1>Login</h1>
					<label>
					Username:
					<input name="username" id="username" type="text" placeholder="Username">
					</label>
					<label>
					Password:
					<input name="password" id="password" type="password" placeholder="Password">
					</label>
					<div class="error"></div>
					<input id="login" type="submit" value="LogIn">

				</form>

		</div>

		<script src="jscript/login.js"></script>
	</body>
</html>
