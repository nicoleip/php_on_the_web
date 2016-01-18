<?php

function getValue($array, $key, $default = null) {
	return isset($array[$key]) ? $array[$key] : $default;
}

function validateString($value) {
	return is_string($value);
}

function validateRequired($value) {
	return !empty($value) || $value==0;
}

function validateRequiredForm($value) {
	return !empty($value) ;
}

function validateLongerOrEqualString($value, $length) {
	return mb_strlen($value, 'UTF-8') >= $length;
}

function validateNonAlphanumeric($value) {
	return (bool) preg_match('/[^a-z0-9\s]/i', $value);
}

function validateEqualPasswords ($value1, $value2){
	return (bool)($value1 === $value2);
}

function validateNumeric($value){
	return is_numeric($value);
}

function isZero($value){
	return (bool)($value == 0);
}

function formErrors($errors) {
	$html = '';
	
	foreach ($errors as $error) {
		$html .= sprintf('<p>%s</p>', $error);
	}
	
	return $html;
}

function getFieldErrorClass($errors, $filedName, $className = 'error') {
	return !empty($errors[$filedName]) ? $className : '';
}

function getFieldResultClass ($errors, $fieldname1, $fieldname2, $className = 'result'){
	return (!empty($errors[$filedname1])&& !empty ($errors[$fieldname2])) ? $className : '';
}

function getFieldTemperatureClass ($errors, $fieldname,$className = 'result'){
	return (!empty($errors[$filedname])) ? $className : '';
}

function Hello($errors, $username,$password1,$password2, $className = 'hello'){
	return (!empty($errors[$filedname]) && !empty($errors[$password1]) && !empty($password2)) ? $className : '';
}


