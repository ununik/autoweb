<?php
class Udalost
{
    public function saveNewUdalost($title, $date1, $date2, $place, $description)
    {
        $db = Connection::connect();
        $result = $db->prepare(
                '
				INSERT INTO `event_autoweb`( `title`, `date1`, `date2`, `place`, `description`)
				VALUES (:title, :date1, :date2, :place, :description);
				'
                );
        $result->execute(array(
                ':title' => $title,
                ':date1' => $date1,
                ':date2' => $date2,
                ':place' => $place,
                ':description' => $description
        ));
        
        return $db->lastInsertId();
    }
    
    public function getAllFromNow($today)
    {
        $result = Connection::connect()->prepare(
                '
				SELECT * FROM `event_autoweb` WHERE `date1`>=:time AND `deleted`=0 ORDER BY `date1` ASC;
				'
                );
        $result->execute(array(
                ':time' => $today
        ));
        
        return $result->fetchAll();
    }
    
    public function getAllUntilNow($today)
    {
        $result = Connection::connect()->prepare(
                '
				SELECT * FROM `event_autoweb` WHERE `date1`<:time AND `deleted`=0 ORDER BY `date1` DESC;
				'
                );
        $result->execute(array(
                ':time' => $today
        ));
    
        return $result->fetchAll();
    }
    
    public function getEventForTime($time1, $time2) {
        
        $where = 'date1<:time2 AND ((date2=0 AND date1>=:time1) OR date2>:time1)';
        
        $result = Connection::connect()->prepare(
                '
				SELECT * FROM `event_autoweb` WHERE ('.$where.') AND `deleted`=0 ORDER BY `date1` ASC;
				'
                );
        $result->execute(array(
                ':time1' => $time1,
                ':time2' => $time2,
        ));
        
        return $result->fetchAll();
    }
    
    public function getAllPlacesFromEvents()
    {
        $result = Connection::connect()->prepare(
                '
				SELECT DISTINCT `place` FROM `event_autoweb` ORDER BY `place` ASC;
				'
                );
        $result->execute();
        
        return $result->fetchAll();
    }
}