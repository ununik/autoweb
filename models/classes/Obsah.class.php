<?php
class Obsah
{
	public function getContent($id)
	{
		$result = Connection::connect()->prepare(
				'SELECT * FROM `content_autoweb` WHERE `id`=:id AND `deleted`=0;'
		);
		$result->execute(array(':id' => $id));
		
		return $result->fetch();
	}
	public function getAllContentForPID($pid, $parent = 0)
	{
		$result = Connection::connect()->prepare(
				'SELECT * FROM `content_autoweb` WHERE `pid`=:pid AND `deleted`=0 AND `parent`=:parent ORDER BY `order`;'
		);
		$result->execute(array(':pid' => $pid, ':parent' => $parent));
		
		return $result->fetchAll();
	}
	
	public function saveNewContent($pid, $type, $parent = 0, $order = 0, $title = '', $text = '', $class = '')
	{
		if ($order == 0) {
			$order = count($this->getAllContentForPID($pid, $parent)) + 1;
		}
		
		$db = Connection::connect();
		
		$result = $db->prepare(
		        'UPDATE `content_autoweb` SET `order` = `order` + 1 WHERE `order` > :orderOld;
				'
		        );
		$result->execute(array(
				':orderOld' => $order-1
			));
		
		$result = $db->prepare(
				'INSERT INTO `content_autoweb`(`pid`, `type`, `title`, `parent`, `order`, `text`, `active`, `class`, `timestamp_lastChange`, `timestamp_created`) 
				 VALUES (:pid, :type, :title, :parent, :order, :text, 0, :class, :time, :time);
				'
		);
		$result->execute(array(
				':order' => $order,
				':orderOld' => $order-1,
				':pid' => $pid,
				':parent' => $parent,
				':type' => $type,
				':title' => $title,
				':text' => $text,
				':class' => $class,
				':time' => time()
			));
		
		return $db->lastInsertId();
	}
	
	public function uprContent($id, $title = '', $text = '', $class = '')
	{
	
		$result = Connection::connect()->prepare(
				'UPDATE `content_autoweb` SET `title`=:title, `text`=:text, `class`=:class, `timestamp_lastChange`=:time WHERE `id`=:id;
				'
		);
		$result->execute(array(
				':id' => $id,
				':title' => $title,
				':text' => $text,
				':class' => $class,
				':time' => time()
		));
	}
	
	public function createContent($contentArray)
	{
		if ($contentArray['class'] == '') {
			$content = '<div>';
		} else {
			$content = '<div class="'.$contentArray['class'].'">';
		}
		
		switch ($contentArray['type']) {
			case 'wrapper':				
				foreach ($this->getAllContentForPID($contentArray['pid'], $contentArray['id']) as $parent) {
					$content .= $this->createContent($parent, $contentArray['id']);
				}
				
				$content .= '</div>';
				return $content;
				break;
			case 'text':
				$content .= $contentArray['text'];
				$content .= '</div>';
				return $content;
				break;
			case 'calendar':
			    $result = Connection::connect()->prepare(
			            'SELECT * FROM `calendar_autoweb` WHERE `content_id`=:id;'
			            );
			    $result->execute(array(':id' => $contentArray['id']));
			    
			    $calendar = $result->fetch();
			    
			    if (!isset($_GET['time'])) {
			        $calendarClass = new Calendar(time(), $calendar['id']);
			    } else {
			        $calendarClass = new Calendar($_GET['time'], $calendar['id']);
			    }
			    
			    switch($calendar['type']) {
			        case 'month':
			            $content .= $calendarClass->createMothCalendar();
			            break;
			    }
			    $content .= '</div>';
			    return $content;
			    break;
		}
		return '';
	}
	
	public function moveUp($id)
	{
		$block = $this->getContent($id);
		$newOrder = $block['order'] - 1;
		if ($newOrder < 1) {
			$newOrder = 1;
		}
	
		$result = Connection::connect()->prepare(
				'
				UPDATE `content_autoweb` SET `order`=:oldOrder
				WHERE `order`=:order AND `deleted`=0 AND `parent`=:parent;
	
				UPDATE `content_autoweb` SET `order`=:order
				WHERE `id`=:id AND `deleted`=0 AND `parent`=:parent;'
		);
		$result->execute(array(':id'=>$id, ':order'=>$newOrder, ':parent'=>$block['parent'], ':oldOrder' => $newOrder+1));
	}
	
	public function moveDown($id)
	{
		$block = $this->getContent($id);
		$newOrder = $block['order'] + 1;
	
		$result = Connection::connect()->prepare(
				'
				UPDATE `content_autoweb` SET `order`=:oldOrder
				WHERE `order`=:order AND `deleted`=0 AND `parent`=:parent;
	
				UPDATE `content_autoweb` SET `order`=:order
				WHERE `id`=:id AND `deleted`=0 AND `parent`=:parent;'
		);
		$result->execute(array(':id'=>$id, ':order'=>$newOrder, ':parent'=>$block['parent'], ':oldOrder' => $newOrder-1));
	}
	
	public function delete($id)
	{
		$block = $this->getContent($id);
		$result = Connection::connect()->prepare(
				'UPDATE `content_autoweb` SET `active`=0, `deleted`=1, `order`=0
				WHERE `id`=:id;
				UPDATE `content_autoweb` SET `active`=0, `deleted`=1, `order`=0
				WHERE `parent`=:id;
	
				UPDATE `content_autoweb` SET `order`=`order` - 1	WHERE `parent`=:parent AND `order` > :orderOld;
				'
		);
		$result->execute(array(':id'=>$id, ':parent'=>$block['parent'], ':orderOld'=>$block['order']));
	}
	
	public function setCalendarType($id, $type, $specification)
	{
	    $result = Connection::connect()->prepare(
	            'INSERT INTO `calendar_autoweb`(`content_id`, `type`, `specification`) VALUES (:id, :type, :specification);
				'
	            );
	    $result->execute(array(
	            ':id' => $id,
	            ':type' => $type,
	            ':specification' => $specification
	    ));
	}
	
	public function getCalendarType($id)
	{
	    $result = Connection::connect()->prepare(
	            'SELECT * FROM `calendar_autoweb` WHERE `content_id`=:id;'
	            );
	    $result->execute(array(':id' => $id));
	     
	    return $result->fetch();
	}
	public function updateCalendarType($id, $type, $specification)
	{
	    $result = Connection::connect()->prepare(
	            'UPDATE `calendar_autoweb` SET `type`=:type, `specification`=:spec  WHERE `content_id`=:id;'
	            );
	    $result->execute(array(':id' => $id, ':type'=>$type, ':spec'=>$specification));
	}
}