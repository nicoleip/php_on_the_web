<?php
require_once 'functions.php';

$result = '';
$operations = [
		1 => '+',
		2 => '-',
		3 => '*',
		4 => '/',
];
$validationErrors = [];
$operationFromPost = getValue($_POST, 'operation');
$firstNumber = getValue($_POST, 'firstNumber');
$secondNumber = getValue($_POST, 'secondNumber');


function validateForm(&$errors) {
	global $firstNumber, $secondNumber, $operation;


	if (!validateRequired($firstNumber)) {
		$errors['firstNumber'][] = 'Please enter a number.';
	} else if (!validateNumeric($firstNumber)) {
		$errors['firstNumber'][] = 'This must be a number!';
	}

	if (!validateRequired($secondNumber)) {
		$errors['secondNumber'][] = 'Please enter a number.';
	} else {
		if (!validateNumeric($secondNumber)) {
			$errors['secondNumber'][] = 'This must be a number!';
		}
		
		

		
	}
return empty($errors);
}
if ($_POST) {
	validateForm($validationErrors);
}

	switch($operationFromPost){
		case 1:
			$result = $firstNumber+$secondNumber;
			break;
		case 2:
			$result = $firstNumber-$secondNumber;
			break;
		case 3:
			$result = $firstNumber*$secondNumber;
			break;
		case 4:
			if(isZero($secondNumber)){
				$result = "Error: division by zero is not allowed!";
			}else{
			$result = $firstNumber/$secondNumber;
			}
			break;
	}
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Basic Calculator</title>
<link rel="stylesheet" type="text/css" href="reset.css"/>
<style type="text/css">

	body{
	font-family: Helvetica;
	font-size: 16px;
	}
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
	<div id="main">
	<form action="" method="post">
	
		<div class="<?= getFieldErrorClass($validationErrors, 'firstNumber')?>">
				<label for="firstNumber">Enter the first number:</label>
				<input type="text" id="firstNumber" name="firstNumber" value="<?= $firstNumber ?>"/>
				<?= formErrors(getValue($validationErrors, 'firstNumber', [])) ?>
			</div>
		<br>
		<br>
		<div class="<?= getFieldErrorClass($validationErrors, 'secondNumber')?>">
				<label for="secondNumber">Enter the second number:</label>
				<input type="text" id="secondNumber" name="secondNumber" value="<?= $secondNumber ?>"/>
				<?= formErrors(getValue($validationErrors, 'secondNumber', [])) ?>
			</div>
		<br>
		<br>		
		<div>
		<label>Please choose the operation:</label>
		<select name="operation">
					<?php foreach ($operations as $key => $value) :?>
					<option value="<?= $key?>"><?=$value?></option>
					<?php endforeach;?>
				</select>
				</div>
		<br>
		<br>
		<input type="submit" />
		<div class="<?= getFieldResultClass($validationErrors, 'firstNumber', 'secondNumber')?>">
		<label for="result">The result is:</label>
		<br>
		<?= $result ?>
		</div>
		
	</form>
	</div>
</body>
</html>