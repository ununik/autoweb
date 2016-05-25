<?php
$container = '<h1>Nastavení patičky</h1>';
$container .= '<a href="?page=admin&action=paticka&part=new">Přidat blok</a>';

$container .= '<form action="" method="post">';
$order = 1;
$allBlocks = $footer->getAllBlocks();
foreach ($allBlocks as $block) {
	$container .= '<div class="footerBlock">';
	if ($order != 1) {
		$container .= '<button name="nahoru['. $block['id'] .']" class="button">Posunout nahoru</button>';
	}
	
	if ($order != count($allBlocks)) {
		$container .= '<button name="dolu['. $block['id'] .']" class="button">Posunout dolu</button>';
	}
	
	if ($block['active'] == 1) {
		$container .= '<button name="hide['. $block['id'] .']" class="button">Skrýt</button>';
	} else {
		$container .= '<button name="unhide['. $block['id'] .']" class="button">Odkrýt</button>';
	}
	
	$container .= '<a href="?page=admin&action=paticka&part=update&id='. $block['id'] .'" class="button">Upravit</a>';
	$container .= '<button name="delete['. $block['id'] .']" class="button">Smazat</button>';
	
	$container .= '<div>';
	$container .= substr(\Library\fce\safeText($block['footer_text']), 0, 255);
	$container .= '</div></div>';
	$order++;
}
$container .= '</form>';

return $container;