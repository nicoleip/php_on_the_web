<?php
require_once 'functions.php';

$result = '';
$conversions = [
		1 => 'F to C',
		2 => 'C to F',
		
];

$validationErrors = [];
$operationFromPost = getValue($_POST, 'conversion');
$temperature = getValue($_POST, 'temperature');

function validateForm(&$errors) {
	global $temperature, $conversion;


	if (!validateRequired($temperature)) {
		$errors['temperature'][] = 'Please enter the temperature.';
	} else if (!validateNumeric($temperature)) {
		$errors['temperature'][] = 'This must be a number!';
	}
	
	return empty($errors);
}
if ($_POST) {
	validateForm($validationErrors);
}

	switch($operationFromPost){
		case 1:
			$result = (5/9)*($temperature-32) . " C";
			break;
		case 2:
			$result = ((9/5)*$temperature) + 32 . " F";
			break;
	}
	



?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Temperature Converter</title>
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
	<div id="main">
	<form action="" method="post">
	
		<div class="<?= getFieldErrorClass($validationErrors, 'temperature')?>">
				<label for="temperature">Enter the temperature:</label>
				<input type="text" id="temperature" name="temperature" value="<?= $temperature ?>"/>
				<?= formErrors(getValue($validationErrors, 'temperature', [])) ?>
			</div>
		<br>
		<br>		
		<div>
		<label>Please choose the conversion type:</label>
		<select name="conversion">
					<?php foreach ($conversions as $key => $value) :?>
					<option value="<?= $key?>"><?=$value?></option>
					<?php endforeach;?>
				</select>
		<br>
		<br>
		<input type="submit" />
		</div>
		<div class="<?= getFieldTemperatureClass($validationErrors, 'temperature')?>">
		<label for="result">The result is:</label>
		<br>
		<?= $result ?>
		</div>
	</form>
	</div>
</body>
</html>
