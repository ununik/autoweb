<?php
$container = '<ul id="navigation">';
$container .= '
<li>Web
	<ul>
		<li><a href="?page=admin&action=web&part=css">CSS</a></li>
	</ul>
</li>';
$container .= '<li><a href="?page=admin&action=hlavicka">Hlavička</a></li>';
$container .= '<li><a href="?page=admin&action=menu">Menu</a></li>';
$container .= '<li><a href="?page=admin&action=stranky">Stránky</a></li>';
$container .= '<li><a href="?page=admin&action=paticka">Patička</a></li>';
$container .= '<li><a href="?page=admin&action=akualizace">Aktualizace</a></li>';
$container .= '<li><a href="?page=admin&action=unlog">Odhlásit se</a></li>';
$container .= '</ul>';

return $container;