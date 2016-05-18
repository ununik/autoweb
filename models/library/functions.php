<?php
namespace Library\fce;

function safeText($text)
{
	return htmlspecialchars(addslashes($text));
}

function passwordHash($password)
{
	return md5($password.PASSWORD_SALT);
}

function validateEMAIL($EMAIL)
{
	$v = "/[a-zA-Z0-9-_.+]+@[a-zA-Z0-9-]+.[a-zA-Z]+/";

	return (bool)preg_match($v, $EMAIL);
}