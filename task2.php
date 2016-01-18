<?php
require_once 'functions.php';


$username = getValue($_POST, 'username');
$password1 = getValue($_POST, 'password1');
$password2 = getValue($_POST, 'password2');



$validationErrors = [];

function validateForm(&$errors) {
	global $username, $password1, $password2;
	
	
	if (!validateRequiredForm($username)) {
		$errors['username'][] = 'User Name is required.';
	} else if (!validateLongerOrEqualString($username, 4)) {
		$errors['username'][] = 'User Name must be at least 4 characters.';
	}
	
	if (!validateRequiredForm($password1)) {
		$errors['password1'][] = 'Password is required.';
	} else {
		if (!validateLongerOrEqualString($password1, 4)) {
			$errors['password1'][] = 'Password must be at least 4 characters.';
		}
		
		if (!validateNonAlphanumeric($password1)) {
			$errors['password1'][] = 'Password must contain one non-alphanumeric character.';
		}
	}
	
	if (!validateRequiredForm($password2)) {
		$errors['password2'][] = 'Please enter your password again.';
	} else {
		if (!validateLongerOrEqualString($password2, 4)) {
			$errors['password2'][] = 'Password must be at least 4 characters.';
		}
	
		if (!validateNonAlphanumeric($password2)) {
			$errors['password2'][] = 'Password must contain one non-alphanumeric character.';
		}
	
	
	if (!validateEqualPasswords($password1, $password2)){
		$errors['password2'][] = 'The second password does not match the first one!';
	}
}
	
	return empty($errors);
}

if ($_POST) {
	validateForm($validationErrors);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Form Validation</title>
<link rel="stylesheet" type="text/css" href="reset.css"/>
<style type="text/css">
	form > div {
		margin: 0 0 3px 0;
	}
	
	form > div > label {
		display: inline-block;
		width: 100px;
	}

	form div.error {
		color: red;
	}
	
	form div.error input, 
	form div.error select, 
	form div.error textarea {
		border-color: red;
	}
	
	
</style>
</head>
<body>
	<div>
	<form action="" method="post">
	
			<div class="<?= getFieldErrorClass($validationErrors, 'username')?>">
				<label for="username">Enter Username:</label>
				<input type="text" id="username" name="username" value="<?= $username ?>"/>
				<?= formErrors(getValue($validationErrors, 'username', [])) ?>
			</div>
			<div class="<?= getFieldErrorClass($validationErrors, 'password1')?>">
				<label for="password1">Enter Password:</label>
				<input type="password" id="password1" name="password1" />
				<?= formErrors(getValue($validationErrors, 'password1', [])) ?>
			</div>
			<div class="<?= getFieldErrorClass($validationErrors, 'password2')?>">
				<label for="password2">Retype Password:</label>
				<input type="password" id="password2" name="password2" />
				<?= formErrors(getValue($validationErrors, 'password2', [])) ?>
			</div>
			<div>
				<input type="submit" />
			<div class="<?= Hello($validationErrors, 'username', 'password1', 'password2')?>">
		<label for="hello">Hello, <?=$username?></label>
		
		 
		<br>
		
		</div>
			</div>
			
	
	
	</form>
	
	
	</div>
</body>
</html>