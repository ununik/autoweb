<?php
$container = '<h1>Obsah</h1>';

$container .= '<form action="" method="post">';
$container .= '<ul>';
//NOVA STRANKA

$parent = $page->getAllParentsForPageSelect();
for ($i = 0; $i < count($parent); $i++) {
	if ($parent[$i]['active'] == 1) {
		$button = '<button name="hide['. $parent[$i]['id'] .']" class="button skryt">Skrýt</button>';
		$class_li = 'odkryto';
	} else {
		$button = '<button name="unhide['. $parent[$i]['id'] .']" class="button odkryt">Odkrýt</button>';
		$class_li = 'skryto';
	}
	$position = $i+1;
	$container .= '<li class="addNewPage"><a href="?page=admin&action=stranky&part=new&parent=0&position='. $position .'"  class="button pridat">+</a></li>';
	$container .= '<li class="'.$class_li.'">';
	
	if ($i != 0) {
		$container .= '<button name="nahoru['. $parent[$i]['id'] .']" class="button posunNahoru">Posunout nahoru</button>';
	}
	
	if ($i != count($parent)-1) {
		$container .= '<button name="dolu['. $parent[$i]['id'] .']" class="button posunDolu">Posunout dolu</button>';
	}
	
	$container .= $parent[$i]['id'] . ' - ' .$parent[$i]['headline'];
	if ($i == 0) {
		$container .= ' (homepage)';
	}
	
	//tlacitka
	$container .= '<div class="button_wrapper">';
	$container .= '<a href="'.  $page->generateLinkHref($parent[$i]['id']) .'" class="button nahled" target="_blank">Náhled</a>';
	$container .= '<a href="?page=admin&action=stranky&part=upr&id='. $parent[$i]['id'] .'" class="button upravit">Upravit</a>';
	$container .= '<a href="?page=admin&action=obsah&id='. $parent[$i]['id'] .'" class="button upravitObsah">Upravit obsah</a>';
	$container .= $button;
	$container .= '<button name="delete['. $parent[$i]['id'] .']" class="button smazat">Smazat</button>';
	$container .= '</div>';
	//konec tlacitek
	
	$children1 = $page->getAllParentsForPageSelect($parent[$i]['id']);
		$container .= '<ul>';
		for ($ch1 = 0; $ch1 < count($children1); $ch1++) {
				if ($children1[$ch1]['active'] == 1) {
				$button = '<button name="hide['. $children1[$ch1]['id'] .']" class="button skryt">Skrýt</button>';
				$class_li = 'odkryto';
			} else {
				$button = '<button name="unhide['. $children1[$ch1]['id'] .']" class="button odkryt">Odkrýt</button>';
				$class_li = 'skryto';
			}
			$position = $ch1+1;
			$container .= '<li class="addNewPage"><a href="?page=admin&action=stranky&part=new&parent='.$parent[$i]['id'].'&position='. $position .'">+</a></li>';
			$container .= '<li class="'.$class_li.'">';
			if ($ch1 != 0) {
				$container .= '<button name="nahoru['. $children1[$ch1]['id'] .']" class="button posunNahoru">Posunout nahoru</button>';
			}
			if ($ch1 != count($children1)-1) {
				$container .= '<button name="dolu['. $children1[$ch1]['id'] .']" class="button posunDolu">Posunout dolu</button>';
			}
			$container .= $children1[$ch1]['id'] . ' - ' .$children1[$ch1]['headline'];
			//tlacitka
			$container .= '<div class="button_wrapper">';
			$container .= '<a href="'. $page->generateLinkHref($children1[$ch1]['id']) .'" class="button nahled" target="_blank">Náhled</a>';
			$container .= '<a href="?page=admin&action=stranky&part=upr&id='. $children1[$ch1]['id'] .'" class="button upravit">Upravit</a>';
			$container .= '<a href="?page=admin&action=obsah&id='. $children1[$ch1]['id'] .'" class="button upravitObsah">Upravit obsah</a>';
		    $container .= $button;
		    $container .= '<button name="delete['. $children1[$ch1]['id'] .']" class="button smazat">Smazat</button>';
		    $container .= '</div>';
		    //konec tlacitek
		    
			$container .= '</li>';
		}
		$container .= '<li class="addNewPage"><a href="?page=admin&action=stranky&part=new&parent='.$parent[$i]['id'].'"  class="button pridat">+</a></li>';
		$container .= '</ul>';
	$container .= '</li>';
}
$container .= '<li class="addNewPage"><a href="?page=admin&action=stranky&part=new" class="button pridat">+</a></li>';
$container .= '</ul>';
$container .= '</form>';

return $container;