<?php
$container = '<h1>Obsah - '.$pageValues['headline'].'</h1>';

$i = 0;
$contents = $obsah->getAllContentForPID($pageValues['id']);
$container .= '<form action="" method="post">';

foreach ($contents as $content) {
	$container .= '<a href="?page=admin&action=obsah&part=new&id='.$_GET['id'].'&order='.$content['order'].'">+</a>';
	$container .= '<div class="obsah_type_wrapper">';
	
	if ($i != 0) {
		$container .= '<button name="nahoru['. $content['id'] .']" class="button">Posunout nahoru</button>';
	}
	if ($i != count($contents)-1) {
		$container .= '<button name="dolu['. $content['id'] .']" class="button">Posunout dolu</button>';
	}
	
	$container .= '<a href="?page=admin&action=obsah&part=upr&id='.$_GET['id'].'&contentId='.$content['id'].'" class="button">Upravit</a>';
	$container .= '<button name="delete['. $content['id'] .']" class="button">Smazat</button>';
	
	if ($content['title'] != '') {
		$container .= '<h2>'.$content['title'].'</h2>';
	}
	
	//WRAPPER
	if ($content['type'] == 'wrapper') {				
		foreach ($obsah->getAllContentForPID($pageValues['id'], $content['id']) as $contentChild) {
			$container .= '<a href="?page=admin&action=obsah&part=new&id='.$_GET['id'].'&parent='.$content['id'].'&order='.$contentChild['order'].'">+</a>';

			//WRAPPER
			if ($contentChild['type'] == 'wrapper') {
				$container .= '<div class="obsah_type_wrapper">';
				if ($contentChild['title'] != '') {
					$container .= '<h2>'.$contentChild['title'].'</h2>';
				}
				$container .= '</div>';
			}
			//TEXT
			if ($contentChild['type'] == 'text') {	
				$container .= '<div class="obsah_type_wrapper">';
				if ($content['title'] != '') {
					$container .= '<h2>'.$contentChild['title'].'</h2>';
				}		
				if ($contentChild['text'] != '') {
					$container .= $contentChild['text'];
				}
			
				$container .= '</div>';
			}
		}
		$container .= '<a href="?page=admin&action=obsah&part=new&id='.$_GET['id'].'&parent='.$content['id'].'">+</a>';
		$container .= '</div>';
	}
	//TEXT
	if ($content['type'] == 'text') {		
		if ($content['text'] != '') {
			$container .= $content['text'];
		}
		
		$container .= '</div>';
	}

	
	$i++;
}

$container .= '<a href="?page=admin&action=obsah&part=new&id='.$_GET['id'].'">+</a>';
$container .= '</form>';

return $container;