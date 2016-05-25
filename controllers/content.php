<?php
//pid - $actualPageSettings['id'];
$obsah = new Obsah();
foreach ($obsah->getAllContentForPID($actualPageSettings['id']) as $parent) {
	$html->addToContent($obsah->createContent($parent));
}