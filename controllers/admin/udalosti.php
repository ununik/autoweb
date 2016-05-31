<?php
$udalost = new Udalost();

$today = strtotime('today');

$err = array();
$dateFrom = date('j. n. Y');
$timeFrom = '';
$dateTo = '';
$timeTo = '';
$title = '';
$place = '';
$description = '';

if (isset($_POST['udalostForm'])) {
    $dateFrom = Library\fce\safeText($_POST['from']);
    $timeFrom = Library\fce\safeText($_POST['timeFrom']);
    $dateTo = Library\fce\safeText($_POST['to']);
    $timeTo = Library\fce\safeText($_POST['timeTo']);
    $title = Library\fce\safeText($_POST['title']);
    $place = Library\fce\safeText($_POST['place']);
    $description = Library\fce\safeText($_POST['description']);
    
    if (strlen($title) == 0) {
        $err[] = 'Není vyplněný název události.';
    }
    if (strlen($title) > 255) {
        $err[] = 'Název je příliš dlouhý.';
    }
    
    if (strlen($title) > 255) {
        $err[] = 'Místo je příliš dlouhé.';
    }
    
    $date1 = \Library\fce\getTimestampFromDateAndTime($dateFrom, $timeFrom);
    $date2 = \Library\fce\getTimestampFromDateAndTime($dateTo, $timeTo);
    
    if ($date1 == 0 && $date2 == 0) {
        $err[] = 'Špatný formát data.';
    }
    
    if ($date1 > $date2 && $date2 != 0) {
        $save = $date1;
        $date1 = $date2;
        $date2 = $save;
    }
    
    if (count($err) == 0) {
        $lastEvent = $udalost->saveNewUdalost($title, $date1, $date2, $place, $description);
        header('Location: http://' . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
    }
}

$placesList = '<datalist id="places">';
foreach($udalost->getAllPlacesFromEvents() as $placeListResult) {
    $placesList .= '<option value="'.$placeListResult['place'].'">';
}
$placesList .= '</datalist>';

$html->addToContent(include HOME_PATH . '/views/admin/backend/udalosti/home.php');