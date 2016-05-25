<?php
class HTML
{
	private $_content = '';
	private $_cssFile = '';
	private $_header = '';
	private $_footer = '';
	private $_scripts = '';
	
	/**
	 * Adds a content to body in html.
	 * 
	 * @param text $new
	 */
	public function addToContent($new)
	{
		$this->_content .= $new;
	}
	
	public function addToScripts($new)
	{
		$this->_scripts .= $new;
	}
	
	public function addCssFile($path)
	{
		$this->_cssFile .= '<link rel="stylesheet" href="' . $path . '" type="text/css">';
	}
	
	/**
	 * Returns basic html structur with content, headers ...
	 * It's ready to be printed
	 */
	public function getHTML()
	{
		$html = '<html>';
		$html .= '<head>';
		$html .= '<meta charset="UTF-8">';
		$html .= '<meta http-equiv="Content-language" content="cs">';
		$html .= $this->_scripts;
		$html .= $this->_cssFile;
		$html .= '</head>';
		$html .= '<body>';
		$html .= $this->_header;
		$html .= '<div id="content">' . $this->_content . '</div>';
		$html .= $this->_footer;
		$html .= '</body>';
		$html .= '</html>';
		
		return $html;
	}
	
	public function generateFEHeader($id)
	{
		$header = new Header();
		$headerResluts = $header->getHeaderPartsForId($id);
		$result = '<div id="header">';
		if (isset($headerResluts['header_mainTitle']) && $headerResluts['header_mainTitle']!='') {
			$result .= '<h1 id="header_mainTitle">' . $headerResluts['header_mainTitle'] . '</h1>';
		}
		if (isset($headerResluts['header_subTitle']) && $headerResluts['header_subTitle']!='') {
			$result .= '<h2 id="header_subTitle">' . $headerResluts['header_subTitle'] . '</h2>';
		}
		if (isset($headerResluts['header_text']) && $headerResluts['header_text']!='') {
			$result .= '<div id="header_text">' . $headerResluts['header_text'] . '</div>';
		}
		$result .= '</div>';
		
		$this->_header = $result;
	}
	
	public function generateFEFooter()
	{
		$footer = new Footer();
		$footerResults = $footer->getAllBlocksForFooter();
		$result = '<div id="footer">';
		foreach ($footerResults as $fr) {
			if ($fr['footer_class'] != '') {
				$result .= '<div class="' . $fr['footer_class'] . '">' . $fr['footer_text'] . '</div>';
				continue;
			}
			$result .= '<div>' . $fr['footer_text'] . '</div>';
		}
		$result .= '</div>';
		
		$this->_footer = $result;
	}
}