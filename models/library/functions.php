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

function getDaysOfWeek($number)
{
    $day = array('Po', 'Út', 'St', 'Čt', 'Pá', 'So', 'Ne');
    return $day[$number];
}

function getMonthInYear($number)
{
    $month = array('prosinec', 'leden', 'únor', 'březen', 'duben', 'květen', 'červen', 'červenec', 'srpen', 'září', 'říjen', 'listopad', 'prosinec', 'leden');
    
    return $month[$number];
}

function getMonthInYearGenitiv($number)
{
    $month = array('prosinece', 'ledna', 'února', 'březena', 'dubna', 'května', 'června', 'července', 'srpena', 'září', 'října', 'listopadu', 'prosinece', 'ledna');
    
    return $month[$number];
}

function getDaysInMonth($time)
{
    $year = date('Y', $time);
    $number = date('n', $time);
    
    if ($year % 4 != 0) {
        $unor = 28;
    } else {
        if ($year % 100 == 0 && $year % 400 != 0) {
            $unor = 28;
        } else {
            $unor = 29;
        }
    }
    $month = array(31, 31, $unor, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31, 31);

    return $month[$number];
}