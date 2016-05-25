<?php
class Header
{
	public function getHeaderPartsForId($id = 1)
	{
		$result = Connection::connect()->prepare(
				'SELECT `header_mainTitle`, `header_subTitle`, `header_text` FROM `header_autoweb` WHERE `id`=:id'
		);
		$result->execute(array(
				':id' => $id
		));
		
		return $result->fetch();
	}
}