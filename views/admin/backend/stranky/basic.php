<?php
$container = '<h1>Obsah</h1>';

$container .= '<form action="" method="post">';
$container .= '<ul>';
//NOVA STRANKA

$parent = $page->getAllParentsForPageSelect();
for ($i = 0; $i < count($parent); $i++) {
	if ($parent[$i]['active'] == 1) {
		$button = '<button name="hide['. $parent[$i]['id'] .']" class="button">Skrýt</button>';
	} else {
		$button = '<button name="unhide['. $parent[$i]['id'] .']" class="button">Odkrýt</button>';
	}
	$position = $i+1;
	$container .= '<li class="addNewPage"><a href="?page=admin&action=stranky&part=new&parent=0&position='. $position .'">+</a></li>';
	$container .= '<li>' . $parent[$i]['id'] . ' - ' .$parent[$i]['headline'];
	if ($i == 0) {
		$container .= ' (homepage)';
	}
	
	//tlacitka
	$container .= '<a href="?page=admin&action=stranky&part=upr&id='. $parent[$i]['id'] .'" class="button">Upravit</a>';
	$container .= '<a href="?page=admin&action=obsah&id='. $parent[$i]['id'] .'" class="button">Upravit obsah</a>';
	if ($i != 0) {
		$container .= '<button name="nahoru['. $parent[$i]['id'] .']" class="button">Posunout nahoru</button>';
	}
	
	if ($i != count($parent)-1) {
		$container .= '<button name="dolu['. $parent[$i]['id'] .']" class="button">Posunout dolu</button>';
	}
	$container .= $button;
	$container .= '<button name="delete['. $parent[$i]['id'] .']" class="button">Smazat</button>';
	//konec tlacitek
	
	$children1 = $page->getAllParentsForPageSelect($parent[$i]['id']);
		$container .= '<ul>';
		for ($ch1 = 0; $ch1 < count($children1); $ch1++) {
			if ($children1[$ch1]['active'] == 1) {
				$button = '<button name="hide['. $children1[$ch1]['id'] .']" class="button">Skrýt</button>';
			} else {
				$button = '<button name="unhide['. $children1[$ch1]['id'] .']" class="button">Odkrýt</button>';
			}
			$position = $ch1+1;
			$container .= '<li class="addNewPage"><a href="?page=admin&action=stranky&part=new&parent='.$parent[$i]['id'].'&position='. $position .'">+</a></li>';
			$container .= '<li>' . $children1[$ch1]['id'] . ' - ' .$children1[$ch1]['headline'];
			//tlacitka
			$container .= '<a href="?page=admin&action=stranky&part=upr&id='. $children1[$ch1]['id'] .'" class="button">Upravit</a>';
			$container .= '<a href="?page=admin&action=obsah&id='. $children1[$ch1]['id'] .'" class="button">Upravit obsah</a>';
			if ($ch1 != 0) {
				$container .= '<button name="nahoru['. $children1[$ch1]['id'] .']" class="button">Posunout nahoru</button>';
			}
			if ($ch1 != count($children1)-1) {
				$container .= '<button name="dolu['. $children1[$ch1]['id'] .']" class="button">Posunout dolu</button>';
			}
		    $container .= $button;
		    $container .= '<button name="delete['. $children1[$ch1]['id'] .']" class="button">Smazat</button>';
		    //konec tlacitek
		    
			$container .= '</li>';
		}
		$container .= '<li class="addNewPage"><a href="?page=admin&action=stranky&part=new&parent='.$parent[$i]['id'].'">+</a></li>';
		$container .= '</ul>';
	$container .= '</li>';
}
$container .= '<li class="addNewPage"><a href="?page=admin&action=stranky&part=new">+</a></li>';
$container .= '</ul>';
$container .= '</form>';

return $container;