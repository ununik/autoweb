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
/**
 * 
 * @param string $date format dd. mm. YYYY
 * @param string $time format HH:MM:SS
 */
function getTimestampFromDateAndTime($date = '', $time = '')
{
    if ($date == '' && $time == '') {
        return 0;
    }
    $month = 0;
    $day = 0;
    $year = 0;
    
    $date = explode('.', str_replace(' ', '', $date));
    if (isset($date[1]) && is_numeric($date[1])) {
        $month = $date[1];
    }
    if (isset($date[0]) && is_numeric($date[0])) {
        $day = $date[0];
    }
    if (isset($date[2]) && is_numeric($date[2])) {
        $year = $date[2];
    }
    
    $hours = 0;
    $minutes = 0;
    $seconds = 0;
    
    $time = explode(':', str_replace(' ', '', $time));
    if (isset($time[1]) && is_numeric($time[1])) {
        $minutes = $time[1];
    }
    if (isset($time[0]) && is_numeric($time[0])) {
        $hours = $time[0];
    }
    if (isset($time[2]) && is_numeric($time[2])) {
        $seconds = $time[2];
    }
    
    return mktime($hours, $minutes, $seconds, $month, $day, $year);
}

function getNormalDateFromTwo($date1, $date2)
{
    if ($date1 > $date2 && $date2 != 0) {
        $save = $date1;
        $date1 = $date2;
        $date2 = $save;
    }
    
    if ($date1 == $date2 || $date2 == 0) {
        if (date('H:i:s', $date1) == '00:00:00') {
            return date('j. n. Y', $date1);
        } else {
            return date('j. n. Y - H:i:s', $date1);
        }
    }
    
    if (date('j. n. Y', $date1) == date('j. n. Y', $date2)) {
        return date('j. n. Y ', $date1).date('H:i:s - ', $date1).date('H:i:s', $date2);
    }
    
    if (date('n. Y', $date1) == date('n. Y', $date2)) {
        if (date('H:i:s', $date1) != '00:00:00' || date('H:i:s', $date2) != '00:00:00') {
            return date('j. n. Y H:i:s - ', $date1) . date('j. n. Y H:i:s', $date2);
        } else {
            return date('j. - ', $date1) . date('j. n. Y', $date2);
        }
    }
    
    if (date('Y', $date1) == date('Y', $date2)) {
        if (date('H:i:s', $date1) != '00:00:00' || date('H:i:s', $date2) != '00:00:00') {
            return date('j. n. Y H:i:s - ', $date1) . date('j. n. Y H:i:s', $date2);
        } else {
            return date('j. n. - ', $date1) . date('j. n. Y', $date2);
        }
    }
    
    if (date('H:i:s', $date1) != '00:00:00' || date('H:i:s', $date2) != '00:00:00') {
        return date('j. n. Y H:i:s - ', $date1) . date('j. n. Y H:i:s', $date2);
    } else {
        return date('j. n. Y - ', $date1) . date('j. n. Y', $date2);
    }
    
    return date('j. n. Y H:i:s - ', $date1) . date('j. n. Y H:i:s', $date2);
}