<?php
class Calendar
{
    private $_time = '';
    private $_id = '';
    
    public function __construct($time, $idOfCalendar)
    {
        $this->_time = $time; 
        $this->_id = $idOfCalendar;
    }
    
    public function getDateWithMonthWords($time)
    {
        return date('j.', $time) . ' ' . \Library\fce\getMonthInYearGenitiv(date('n', $time)) . ' ' . date('Y', $time);
    }
    
    public function generateLinkToCalendar($date)
    {
        return Page::generateLinkHref(PID) . '&time='.$date;
    }
    
    public function createMothCalendar()
    {
        $firstDayOfMonth = strtotime(date('Y-m-1', $this->_time));
        $lastDayOfMonth = strtotime(date('Y-m-'. \Library\fce\getDaysInMonth(date('n', $this->_time)), $this->_time));
        
        $calendar = '<div class="calendar_dnesJe">Dnes je '.$this->getDateWithMonthWords(time()).'</div>';
        
        //PREVIOUS MONTH
        $calendar .= '<a class="calendar_previousMonth" href="'.$this->generateLinkToCalendar($firstDayOfMonth-1).'">&#60;</a>';
        
        //THIS MONTH
        $calendar .= \Library\fce\getMonthInYear(date('n', $this->_time)) . ' ' . date('Y', $this->_time);
        
        //NEXT MONTH
        $calendar .= '<a class="calendar_nextMonth" href="'.$this->generateLinkToCalendar($lastDayOfMonth+86400).'">&#62;</a>';
        
        $calendar .= '<table border="1px" calss="monthCalendar">';
        
        //DNY V TYDNU zacatek
        $calendar .= '<tr class="calendar_namesOfDays">';
        for ($i=0; $i < 7; $i++) {
            $calendar .= '<td class="calendar_headlineDay'.$i.'">';
            $calendar .= \Library\fce\getDaysOfWeek($i);
            $calendar .= '</td>';
        }
        $calendar .= '</tr>';
        //DNY V TYDNU konec
        
        $calendar .= '<tr>';
        //ZACATEK Z PREDCHOZIHO MESICE
        $cisloPrvnihoDneVMesici = date('N', $firstDayOfMonth)-1;
        for ($n=0; $n<$cisloPrvnihoDneVMesici; $n++) {
            $dayNumber = \Library\fce\getDaysInMonth($firstDayOfMonth - 1) - $cisloPrvnihoDneVMesici + $n + 1;
            $calendar .= '<td class="calendar_previousMonthNumbers">';
            $calendar .= $dayNumber;
            $calendar .= '</td>';
        }
        //KONEC PREDCHOZIHO MESICE
        
        //ZAKLADNI KALENDAR zacatek
        for ($i = 1; $i<=\Library\fce\getDaysInMonth($this->_time); $i++) {
            $todayTimestamp = strtotime(date('Y-m-'.$i, $this->_time));
            if ($n == 7) {
                $n = 0;
                $calendar .= '<tr><tr>';
            }
            
            $calendar .= '<td class="calendar_dayInWeek'.$n;
            if (strtotime('today') == $todayTimestamp) {
                $calendar .= ' calendar_today';
            }
            $calendar .= '">';
            $calendar .= $i;
            $calendar .= '</td>';
            $n++;
        }
        //ZAKLADNI KALENDAR konec
        
        //dobehnuti kalendare zacatek
        $i = 1;
        for ($n; $n<7; $n++) {
            $calendar .= '<td class="calendar_nextMonthNumbers">';
            $calendar .= $i;
            $calendar .= '</td>';
            $i++;
        }
        //dobehnuti kalendare konec
        $calendar .= '</tr>';
        
        $calendar .= '</table>';
        return $calendar;
    }
}