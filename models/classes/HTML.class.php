<?php
class HTML
{
	private $_content = '';
	private $_cssFile = '';
	
	/**
	 * Adds a content to body in html.
	 * 
	 * @param text $new
	 */
	public function addToContent($new)
	{
		$this->_content .= $new;
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
		$html .= $this->_cssFile;
		$html .= '</head>';
		$html .= '<body>';
		$html .= $this->_content;
		$html .= '</body>';
		$html .= '</html>';
		
		return $html;
	}
}