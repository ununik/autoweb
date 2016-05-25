<?php
class Footer
{
	public function getCountOfFooterBlocks()
	{
		$result = Connection::connect()->prepare(
				'SELECT 1 FROM `footer_autoweb` WHERE `deleted`=0;'
		);
		$result->execute();
		
		return count($result->fetchAll());
	}
	
	public function saveNewToDb($class,$text)
	{
		$result = Connection::connect()->prepare(
				'
				INSERT INTO `footer_autoweb`( `footer_class`, `footer_order`, `footer_text`, `active`) 
				VALUES (:class, :order, :text, 0);
				'
		);
		$result->execute(array(
				':class' => $class,
				':order' => $this->getCountOfFooterBlocks() + 1,
				':text' => $text
		));
		
	}
	
	public function getAllBlocksForFooter()
	{
		$result = Connection::connect()->prepare(
				'SELECT `footer_class`, `footer_text` FROM `footer_autoweb` 
				WHERE `active`=1 AND `deleted`=0 ORDER BY `footer_order` ASC;'
		);
		$result->execute();
		
		return $result->fetchAll();
	}
	
	public function getAllBlocks()
	{
		$result = Connection::connect()->prepare(
				'SELECT * FROM `footer_autoweb`
				WHERE `deleted`=0 ORDER BY `footer_order` ASC;'
		);
		$result->execute();
	
		return $result->fetchAll();
	}
	
	public function getOneBlock($id)
	{
		$result = Connection::connect()->prepare(
				'SELECT * FROM `footer_autoweb` 
				WHERE `id`=:id AND `deleted`=0;'
		);
		$result->execute(array(':id'=>$id));
		
		return $result->fetch();
	}
	
	public function moveUp($id)
	{
		$block = $this->getOneBlock($id);
		$newOrder = $block['footer_order'] - 1;
		if ($newOrder < 1) {
			$newOrder = 1;
		}
		
		$result = Connection::connect()->prepare(
				'
				UPDATE `footer_autoweb` SET `footer_order`=:oldOrder
				WHERE `footer_order`=:order AND `deleted`=0;
				
				UPDATE `footer_autoweb` SET `footer_order`=:order
				WHERE `id`=:id AND `deleted`=0;'
		);
		$result->execute(array(':id'=>$id, ':order'=>$newOrder, ':oldOrder' => $newOrder+1));
	}
	public function moveDown($id)
	{
		$block = $this->getOneBlock($id);
		$newOrder = $block['footer_order'] + 1;
		$maxCount = $this->getCountOfFooterBlocks();
		if ($newOrder > $maxCount) {
			$newOrder = $maxCount;
		}
	
		$result = Connection::connect()->prepare(
				'
				UPDATE `footer_autoweb` SET `footer_order`=:oldOrder
				WHERE `footer_order`=:order AND `deleted`=0;
	
				UPDATE `footer_autoweb` SET `footer_order`=:order
				WHERE `id`=:id AND `deleted`=0;'
		);
		$result->execute(array(':id'=>$id, ':order'=>$newOrder, ':oldOrder' => $newOrder-1));
	}
	
	public function hide($id)
	{
		$result = Connection::connect()->prepare(
				'UPDATE `footer_autoweb` SET `active`=0
				WHERE `id`=:id AND `deleted`=0;'
		);
		$result->execute(array(':id'=>$id));
	}
	
	public function unhide($id)
	{
		$result = Connection::connect()->prepare(
				'UPDATE `footer_autoweb` SET `active`=1
				WHERE `id`=:id AND `deleted`=0;'
		);
		$result->execute(array(':id'=>$id));
	}
	public function delete($id)
	{
		$result = Connection::connect()->prepare(
				'UPDATE `footer_autoweb` SET `active`=0, `deleted`=1, `footer_order`=0
				WHERE `id`=:id;'
		);
		$result->execute(array(':id'=>$id));
	}
	public function saveUpdateToDb($class,$text, $id)
	{
		$result = Connection::connect()->prepare(
				'
				UPDATE `footer_autoweb` SET `footer_class`=:class, `footer_text`=:text
				WHERE `id`=:id;
				'
		);
		$result->execute(array(
				':class' => $class,
				':id' => $id,
				':text' => $text
		));
		
	}
}