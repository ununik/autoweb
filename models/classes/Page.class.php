<?php
class Page
{
	public function getCountOfPagesAsParents($parent)
	{
		$result = Connection::connect()->prepare(
				'SELECT 1 FROM `pages_autoweb` WHERE `deleted`=0 AND `parent`=:parent;'
		);
		$result->execute(array(':parent' => $parent));
	
		return count($result->fetchAll());
	}
	
	public function saveNew($headline, $title, $metaDescription, $parent = 0, $position = '')
	{
		$lastPosition = $this->getCountOfPagesAsParents($parent);
		
		if ($position == '') {
			$position = (int) $lastPosition + 1;
		}
		
		$result = Connection::connect()->prepare(
				'UPDATE `pages_autoweb` SET `order`= 1 + `order` WHERE `deleted`=0 AND `parent`=:parent AND `order`>=:position;
				 INSERT INTO `pages_autoweb`(`headline`, `title`, `parent`, `order`, `meta_description`, `active`) 
				 VALUES (:headline, :title, :parent, :position, :metaDescription, 0);
				'
		);
		$result->execute(array(
				':parent' => $parent,
				':position' => $position,
				':headline' => $headline,
				':title' => $title,
				':metaDescription' => $metaDescription
		));
	}
	
	public function saveUpr($headline, $title, $metaDescription, $id)
	{
		$result = Connection::connect()->prepare(
				'UPDATE `pages_autoweb` SET `headline`=:headline, `title`=:title, `meta_description`=:metaDescription WHERE `id`=:id;
				'
		);
		$result->execute(array(
				':headline' => $headline,
				':title' => $title,
				':metaDescription' => $metaDescription,
				':id' => $id
		));
	}
	
	public function getAllParentsForPageSelect($parent = 0)
	{
		$result = Connection::connect()->prepare(
				'SELECT `id`, `headline`, `active` FROM `pages_autoweb` WHERE `deleted`=0 AND `parent`=:parent ORDER BY `order` ASC;'
		);
		$result->execute(array(':parent' => $parent));
		
		return $result->fetchAll();
	}
	
	public function getActualPage($id)
	{
		if ($id != '') {
			$result = Connection::connect()->prepare(
					'SELECT * FROM `pages_autoweb` WHERE `deleted`=0 AND `active`=1 AND `id`=:id;'
			);
			$result->execute(array(':id' => $id));
		} else {
			$result = Connection::connect()->prepare(
					'SELECT * FROM `pages_autoweb` WHERE `deleted`=0 AND `active`=1 AND `parent`=0  ORDER BY `order` LIMIT 1;'
			);
			$result->execute();
		}
		
		return $result->fetch();
	}
	
	public function getPage($id)
	{
		$result = Connection::connect()->prepare(
				'SELECT * FROM `pages_autoweb` WHERE `deleted`=0 AND `id`=:id;'
		);
		$result->execute(array(':id' => $id));
	
		return $result->fetch();
	}
	
	public function hide($id)
	{
		$result = Connection::connect()->prepare(
				'UPDATE `pages_autoweb` SET `active`=0
				WHERE `id`=:id AND `deleted`=0;'
		);
		$result->execute(array(':id'=>$id));
	}
	
	public function unhide($id)
	{
		$result = Connection::connect()->prepare(
				'UPDATE `pages_autoweb` SET `active`=1
				WHERE `id`=:id AND `deleted`=0;'
		);
		$result->execute(array(':id'=>$id));
	}
	public function delete($id)
	{
		$page = $this->getPage($id);
		$result = Connection::connect()->prepare(
				'UPDATE `pages_autoweb` SET `active`=0, `deleted`=1, `order`=0
				WHERE `id`=:id;
				UPDATE `pages_autoweb` SET `active`=0, `deleted`=1, `order`=0
				WHERE `parent`=:id;
				
				UPDATE `pages_autoweb` SET `order`=`order` - 1	WHERE `parent`=:parent AND `order` > :orderOld;
				'
		);
		$result->execute(array(':id'=>$id, ':parent'=>$page['parent'], ':orderOld'=>$page['order']));
	}
	
	public function getParentOfActualPage($id)
	{
		$result = Connection::connect()->prepare(
				'SELECT `parent` FROM `pages_autoweb` WHERE `id`=:id;'
		);
		$result->execute(array(':id' => $id));
		
		$parent = $result->fetch();
		
		return $parent['parent'];
	}
	
	public function moveUp($id)
	{
		$parent = $this->getParentOfActualPage($id);
		$block = $this->getPage($id);
		$newOrder = $block['order'] - 1;
		if ($newOrder < 1) {
			$newOrder = 1;
		}
	
		$result = Connection::connect()->prepare(
				'
				UPDATE `pages_autoweb` SET `order`=:oldOrder
				WHERE `order`=:order AND `deleted`=0 AND `parent`=:parent;
	
				UPDATE `pages_autoweb` SET `order`=:order
				WHERE `id`=:id AND `deleted`=0 AND `parent`=:parent;'
		);
		$result->execute(array(':id'=>$id, ':order'=>$newOrder, ':parent'=>$parent, ':oldOrder' => $newOrder+1));
	}
	
	public function moveUpAndIn($id)
	{
		$block = $this->getPage($id);
		$newOrder = $block['order'] - 1;
		
		$result = Connection::connect()->prepare(
				'SELECT `id`, `order` FROM `pages_autoweb` WHERE `deleted`=0 AND `order`=:newOrder AND `parent`=:parent;'
		);
		$result->execute(array(':newOrder' => $newOrder, ':parent'=>$block['parent']));
		
		$newParentPage = $result->fetch();
		 
		
		if (!isset($newParentPage['id'])) {
			return;
		}
		
		$result = Connection::connect()->prepare(
				'UPDATE `pages_autoweb` SET `order`=:oldOrder, `parent`=:parent
				WHERE `id`=:id;'
		);
		$result->execute(array(':newOrder' => $this->getCountOfPagesAsParents($newParentPage['id']), ':parent'=>$newParentPage['id'], ':id'=>$id));
		
	
		$result = Connection::connect()->prepare(
				'
				UPDATE `pages_autoweb` SET `order`= `order`-1
				WHERE `order`>:order AND `deleted`=0;
				'
		);
		$result->execute(array(':order'=>$newParentPage['order']));
	}
	
	public function moveDown($id)
	{
		$parent = $this->getParentOfActualPage($id);
		$block = $this->getPage($id);
		$newOrder = $block['order'] + 1;
	
		$result = Connection::connect()->prepare(
				'
				UPDATE `pages_autoweb` SET `order`=:oldOrder
				WHERE `order`=:order AND `deleted`=0 AND `parent`=:parent;
	
				UPDATE `pages_autoweb` SET `order`=:order
				WHERE `id`=:id AND `deleted`=0 AND `parent`=:parent;'
		);
		$result->execute(array(':id'=>$id, ':order'=>$newOrder, ':parent'=>$parent, ':oldOrder' => $newOrder-1));
	}
}