<?php


class CalendarControl
{
    /**
     * Constructor
     */
    public function __construct(array $occupiedDates, int $roomid){
        $this->naviHref = htmlentities($_SERVER['PHP_SELF']);

        $this->occupiedDates = $occupiedDates;
        $this->roomid = $roomid;
    }

    /********************* PROPERTY ********************/
    private $dayLabels = array("Pon","Wt","Śr","Czw","Pt","So","Ni");
    private $monthLabels = array("Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień");

    private $currentYear=0;

    private $currentMonth=0;

    private $currentDay=0;

    private $currentDate=null;

    private $daysInMonth=0;

    private $naviHref= null;

    private $occupiedDates;

    private $roomid;

    /********************* PUBLIC **********************/

    /**
     * print out the calendar
     */
    public function show() {
        $year  = null;

        $month = null;

        if(null==$year&&isset($_GET['year'])){

            $year = $_GET['year'];

        }else if(null==$year){

            $year = date("Y",time());

        }

        if(null==$month&&isset($_GET['month'])){

            $month = $_GET['month'];

        }else if(null==$month){

            $month = date("m",time());

        }

        $this->currentYear=$year;

        $this->currentMonth=$month;


        $this->daysInMonth=$this->_daysInMonth($month,$year);

        $content='<div id="calendar">'.
            '<div class="box">'.
            $this->_createNavi().
            '</div>'.
            '<div class="box-content">'.
            '<ul class="label">'.$this->_createLabels().'</ul>';
        $content.='<div class="clear"></div>';
        $content.='<ul class="dates">';

        $weeksInMonth = $this->_weeksInMonth($month,$year);
        // Create weeks in a month
        for( $i=0; $i<$weeksInMonth; $i++ ){

            //Create days in a week
            for($j=1;$j<=7;$j++){
                $content.=$this->_showDay($i*7+$j);
            }
        }

        $content.='</ul>';

        $content.='<div class="clear"></div>';

        $content.='</div>';

        $content.='</div>';
        return $content;
    }

    /********************* PRIVATE **********************/
    /**
     * create the li element for ul
     */
    private function _showDay($cellNumber){

        if($this->currentDay==0){

            $firstDayOfTheWeek = date('N',strtotime($this->currentYear.'-'.$this->currentMonth.'-01'));

            if(intval($cellNumber) == intval($firstDayOfTheWeek)){

                $this->currentDay=1;

            }
        }

        if( ($this->currentDay!=0)&&($this->currentDay<=$this->daysInMonth) ){

            $this->currentDate = date('Y-m-d',strtotime($this->currentYear.'-'.$this->currentMonth.'-'.($this->currentDay)));

            $cellContent = $this->currentDay;

            $this->currentDay++;

        }else{

            $this->currentDate =null;

            $cellContent=null;
        }

        $class = '';
        $link = "testreservation?date=$this->currentDate&roomid=$this->roomid";
        if ($cellContent == null) {
            $class = 'mask';
        } else if (array_key_exists($this->currentDate, $this->occupiedDates)) {
            $class = 'occupied';
            $resid = $this->occupiedDates[$this->currentDate];
            $link = "reservation?id=$resid";
        } else {
            $class = 'free';
        }
        
        $today = date('Y-m-d');
        if ($this->currentDate !== null && $this->currentDate < $today) {
            return '<li id="li-'.$this->currentDate.'" class="mask">
            '.$cellContent.'
            </li>';              
        } else {
            return '<li id="li-'.$this->currentDate.'" class="'.($class).'">
            <a href="'.$link.'">'.$cellContent.'</a>
            </li>';        
        }


    }

    /**
     * create navigation
     */
    private function _createNavi(){

        $nextMonth = $this->currentMonth==12?1:intval($this->currentMonth)+1;

        $nextYear = $this->currentMonth==12?intval($this->currentYear)+1:$this->currentYear;

        $preMonth = $this->currentMonth==1?12:intval($this->currentMonth)-1;

        $preYear = $this->currentMonth==1?intval($this->currentYear)-1:$this->currentYear;



        return
            '<div class="header">'.
            '<a class="prev" href="'.'/calendar'.'?month='.sprintf('%02d',$preMonth).'&year='.$preYear.'&room='.$this->roomid.'">Wstecz</a>'.
            '<span class="title">'.$this->currentYear.' '.$this->monthLabels[$this->currentMonth - 1].'</span>'.
                '<a class="next" href="'.'/calendar'.'?month='.sprintf("%02d", $nextMonth).'&year='.$nextYear.'&room='.$this->roomid.'">Dalej</a>'.
                '</div>';
    }

    /**
     * create calendar week labels
     */
    private function _createLabels(){

        $content='';

        foreach($this->dayLabels as $index=>$label){

            $content.='<li class="'.($label==6?'end title':'start title').' title">'.$label.'</li>';

        }

        return $content;
    }



    /**
     * calculate number of weeks in a particular month
     */
    private function _weeksInMonth($month=null,$year=null){

        if( null==($year) ) {
            $year =  date("Y",time());
        }

        if(null==($month)) {
            $month = date("m",time());
        }

        // find number of days in this month
        $daysInMonths = $this->_daysInMonth($month,$year);

        $numOfweeks = ($daysInMonths%7==0?0:1) + intval($daysInMonths/7);

        $monthEndingDay= date('N',strtotime($year.'-'.$month.'-'.$daysInMonths));

        $monthStartDay = date('N',strtotime($year.'-'.$month.'-01'));

        if($monthEndingDay<$monthStartDay){

            $numOfweeks++;

        }

        return $numOfweeks;
    }

    /**
     * calculate number of days in a particular month
     */
    private function _daysInMonth($month=null,$year=null){

        if(null==($year))
            $year =  date("Y",time());

        if(null==($month))
            $month = date("m",time());

        return date('t',strtotime($year.'-'.$month.'-01'));
    }
}