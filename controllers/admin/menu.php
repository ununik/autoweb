<?php
if (isset($_GET['part']) && $_GET['part'] == 'new') {
    $err = array();
    $html->addToContent(include HOME_PATH . '/views/admin/backend/menu/form.php');
    return;
}
$html->addToContent(include HOME_PATH . '/views/admin/backend/menu/home.php');