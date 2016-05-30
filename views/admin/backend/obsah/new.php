<?php
$parent = 0;
$order = 0;
if (isset($_GET['parent'])) {
	$parent = $_GET['parent'];
}
if (isset($_GET['order'])) {
	$order = $_GET['order'];
}

$container = '<h1>Výběr typu obsahu pro '.$pageValues['headline'].'</h1>';

$container .= '<ul>';
$container .= '<li><a href="?page=admin&action=obsah&part=new_type&type=wrapper&id='.$_GET['id'].'&parent='.$parent.'&order='.$order.'">Wrapper</a></li>';
$container .= '<li><a href="?page=admin&action=obsah&part=new_type&type=text&id='.$_GET['id'].'&parent='.$parent.'&order='.$order.'">Text</a></li>';
$container .= '<li><a href="?page=admin&action=obsah&part=new_type&type=kalendar&id='.$_GET['id'].'&parent='.$parent.'&order='.$order.'">Kalendář</a></li>';
$container .= '</ul>';

return $container;