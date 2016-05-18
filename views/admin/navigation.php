<?php
$container = '<ul>';
$container .= '
<li>Web
	<ul>
		<li><a href="?page=admin&action=web&part=css">CSS</a></li>
	</ul>
</li>';
$container .= '<li>hlavicka</li>';
$container .= '<li><a href="?page=admin&action=obsah">obsah</a></li>';
$container .= '<li>paticka</li>';
$container .= '<li><a href="?page=admin&action=akualizace">Aktualizace</a></li>';
$container .= '<li><a href="?page=admin&action=unlog">Odhlásit se</a></li>';
$container .= '</ul>';

return $container;