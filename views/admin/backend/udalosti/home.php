<?php
$container = '<h1>Události</h1>';
$container .= '<h2>Nová událost</h2>';

$container .= '<div id="form_wrapper">';

if (count($err) > 0) {
    $container .= '<ul>';
    foreach ($err as $error) {
        $container .= '<li>' . $error . '</li>';
    }
    $container .= '</ul>';
}

$container .= '<form action="" method="post">';

$container .= '<div class="form_input">';
$container .= '<label for="title">Název události</label>';
$container .= '<p>Tento název se objevuje jako titulek události</p>';
$container .= '<input type="text" name="title"  id="title" value="' . $title . '">';
$container .= '</div>';

$container .= '<div class="form_input">';
$container .= '<label for="from">Datum od</label>';
$container .= '<input type="text" name="from"  id="from" value="' . $dateFrom .'">';
$container .= '<label for="timeFrom"><small>Čas od</small></label>';
$container .= '<input type="text" name="timeFrom"  id="timeFrom" value="' . $timeFrom . '">';
$container .= '</div>';

$container .= '<div class="form_input">';
$container .= '<label for="to">Datum do</label>';
$container .= '<input type="text" name="to"  id="to" value="' . $dateTo .'">';
$container .= '<label for="timeTo"><small>Čas do</small></label>';
$container .= '<input type="text" name="timeTo"  id="timeTo" value="' . $timeTo . '">';
$container .= '</div>';

$container .= $placesList;

$container .= '<div class="form_input">';
$container .= '<label for="place">Místo</label>';
$container .= '<p>Místo, kde proběhne danná událost</p>';
$container .= '<input type="text" name="place"  id="place" value="' . $place . '" list="places">';
$container .= '</div>';


$container .= '<div class="form_input">';
$container .= '<label for="description">Popis události</label>';
$container .= '<p>Popis události je rozsáhlejší text, umožňující lépe popsat událost.</p>';
$container .= '<textarea id="description" name="description">' . $description . '</textarea>';
$container .= '</div>';

$container .= '<input type="submit" value="Uložit" name="udalostForm">';

$container .= '</form>';
$container .= '</div>';



$container .= '<h2>Události</h2>';
$container .= '<table>';
$container .= '<tr><th>Nadcházející události</th><th>Proběhlé události</th></tr>';
$container .= '<td>';
foreach ($udalost->getAllFromNow($today) as $event) {
    $date = \Library\fce\getNormalDateFromTwo($event['date1'], $event['date2']);
    $container .= '<h3>'.$date.' '.$event['title'].'</h3>';
}
$container .= '</td><td>';
foreach ($udalost->getAllUntilNow($today) as $event) {
    $date = \Library\fce\getNormalDateFromTwo($event['date1'], $event['date2']);
    $container .= '<h3>'.$date.' '.$event['title'].'</h3>';
}
$container .= '</td>';
$container .= '</table>';

return $container;