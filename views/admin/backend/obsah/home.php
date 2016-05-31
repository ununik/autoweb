<?php
$container = '<h1>Obsah - '.$pageValues['headline'].'</h1>';

$i = 0;
$contents = $obsah->getAllContentForPID($pageValues['id']);
$container .= '<form action="" method="post">';

foreach ($contents as $content) {
	$container .= '<a href="?page=admin&action=obsah&part=new&id='.$_GET['id'].'&order='.$content['order'].'" class="button pridat">+</a>';
	$container .= '<div class="obsah_type_wrapper">';
	
	if ($i != 0) {
		$container .= '<button name="nahoru['. $content['id'] .']" class="button posunNahoru">Posunout nahoru</button>';
	}
	if ($i != count($contents)-1) {
		$container .= '<button name="dolu['. $content['id'] .']" class="button posunDolu">Posunout dolu</button>';
	}
	
	$container .= '<a href="?page=admin&action=obsah&part=upr&id='.$_GET['id'].'&contentId='.$content['id'].'" class="button upravit">Upravit</a>';
	$container .= '<button name="delete['. $content['id'] .']" class="button smazat">Smazat</button>';
	
	if ($content['title'] != '') {
		$container .= '<h2>'.$content['title'].'</h2>';
	}
	
	//WRAPPER
	if ($content['type'] == 'wrapper') {
		$child = $obsah->getAllContentForPID($pageValues['id'], $content['id']);	
		$n = 0;			
		foreach ($child as $contentChild) {
			$container .= '<a href="?page=admin&action=obsah&part=new&id='.$_GET['id'].'&parent='.$content['id'].'&order='.$contentChild['order'].'" class="button pridat">+</a>';
			
			$container .= '<div class="obsah_type_wrapper">';
			if ($n != 0) {
				$container .= '<button name="nahoru['. $contentChild['id'] .']" class="button posunNahoru">Posunout nahoru</button>';
			}
			if ($n != count($child)-1) {
				$container .= '<button name="dolu['. $contentChild['id'] .']" class="button posunDolu">Posunout dolu</button>';
			}
			$container .= '<a href="?page=admin&action=obsah&part=upr&id='.$_GET['id'].'&contentId='.$contentChild['id'].'" class="button upravit">Upravit</a>';
			$container .= '<button name="delete['. $contentChild['id'] .']" class="button smazat">Smazat</button>';
			
			
			//WRAPPER
			if ($contentChild['type'] == 'wrapper') {
				if ($contentChild['title'] != '') {
					$container .= '<h2>'.$contentChild['title'].'</h2>';
				}
				$container .= '</div>';
			}
			//TEXT
			if ($contentChild['type'] == 'text') {	
				if ($content['title'] != '') {
					$container .= '<h2>'.$contentChild['title'].'</h2>';
				}		
				if ($contentChild['text'] != '') {
					$container .= $contentChild['text'];
				}
			
				$container .= '</div>';
			}
			
			//KALENDAR
			if ($content['type'] == 'calendar') {
			    $container .= 'kalendar';
			    $container .= '<a href="?page=admin&action=udalosti">události</a>';
			
			    $container .= '</div>';
			}
			$n++;
		}
		$container .= '<a href="?page=admin&action=obsah&part=new&id='.$_GET['id'].'&parent='.$content['id'].'" class="button pridat">+</a>';
		$container .= '</div>';
	}
	//TEXT
	if ($content['type'] == 'text') {		
		if ($content['text'] != '') {
			$container .= $content['text'];
		}
		
		$container .= '</div>';
	}
	
	//KALENDAR
	if ($content['type'] == 'calendar') {
	        $container .= 'kalendar';
	        $container .= '<a href="?page=admin&action=udalosti">události</a>';
	
	    $container .= '</div>';
	}

	
	$i++;
}

$container .= '<a href="?page=admin&action=obsah&part=new&id='.$_GET['id'].'" class="button pridat">+</a>';
$container .= '</form>';

return $container;