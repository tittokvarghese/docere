<?php
/**
*@author  Xu Ding
*@email   thedilab@gmail.com
*@website http://www.StarTutorial.com
**/
class Calendar {  
     
    /**
     * Constructor
     */
    public function __construct($doctor_id){     
        $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
        $this->doctorId = $doctor_id;
    }
     
    /********************* PROPERTY ********************/  
    private $dayLabels 	= array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");
	private $days 		= array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
    private $currentYear=0;
    private $currentMonth=0;
    private $currentMonthFull=0;
    private $currentDay=0;
    private $currentDate=null;
    private $daysInMonth=0;
    private $naviHref= null;
    public  $doctorId= 0;
     
    /********************* PUBLIC **********************/  
        
    /**
    * print out the calendar
    */
    public function show($month,$monthFull) {
        
		$year = date("Y",time());  
                 
         
/*       
        $month 		= date("m",time());
        $monthFull 	= date("F",time());
*/			
                         
         
        $this->currentYear=$year;
        $this->currentMonth=$month;
        $this->currentMonthFull=$monthFull;
        $this->daysInMonth=$this->_daysInMonth($month,$year);  
         
		 
        $content='<br /><div id="calendar">'.
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
        $content.='</div>
		
<div style="margin-top:40px;margin-left:10px;display:inline-block;vertical-align:middle;text-align:left;">

<div style="padding:5px 0px 5px 0px;">
<div style="width:30px;height:20px;background-color:#6699FF;display:inline-block;vertical-align:middle;"></div>
<div style="display:inline-block;vertical-align:middle;color:#333333;font-size:18px;margin-left:5px;">Available</div>
</div>

<div style="padding:5px 0px 5px 0px;">
<div style="width:30px;height:20px;background-color:#FF0033;display:inline-block;vertical-align:middle;"></div>
<div style="display:inline-block;vertical-align:middle;color:#333333;font-size:18px;margin-left:5px;">Book Completed</div>
</div>

<div style="padding:5px 0px 5px 0px;">
<div style="width:30px;height:20px;background-color:#FFCC00;display:inline-block;vertical-align:middle;"></div>
<div style="display:inline-block;vertical-align:middle;color:#333333;font-size:18px;margin-left:5px;">Leave or Public Holiday  </div>
</div><br />
</div>


		<div  style="text-align:left;" id="Appointment'.$this->doctorId.'"></div>';
        return $content;   
    }
     
    /********************* PRIVATE **********************/ 
    /**
    * create the li element for ul
    */
	
	
	
private function Leaves($cellContent,$cellMonth,$cellYear,$Week){
	
	$get_leaves = dbTKV::SQLQUERY("SELECT * FROM leaves WHERE 
	(lea_did='".$this->doctorId."' OR  lea_did='1')
	AND  lea_day='".$cellContent."' 
	AND  lea_month='".$cellMonth."' 
	AND  lea_year='".$cellYear."'  
	AND  lea_week='".$Week."' 
			");

	if(dbTKV::SQLNUM_ROWS($get_leaves))
	{
		return ' Leaves ';
	}
}	
private function Selected($cellContent,$cellMonth,$cellYear,$Week){
	
	$get_sel_app = dbTKV::SQLQUERY("SELECT * FROM appointments WHERE 
	
	
	apts_did='".$this->doctorId."'
	AND  apts_pid='".$_SESSION['USER_ID']."' 
	AND  apts_day='".$cellContent."' 
	AND  apts_month='".$cellMonth."' 
	AND  apts_year='".$cellYear."'  
	AND  apts_week='".$Week."' 
			");

	if(dbTKV::SQLNUM_ROWS($get_sel_app))
	{
		return ' Selected ';
	}
}		
	
	
private function AppointmentLimit($cellContent,$cellMonth,$cellYear,$Week){
	
	$get_limit  = dbTKV::SQLQUERY("SELECT * FROM timetable WHERE tmt_uid='".$this->doctorId."' AND    tmt_week LIKE '%".$Week."%'	");
	$row_limit	= dbTKV::SQL_FETCH($get_limit);
	
	$tmt_limit=$row_limit['tmt_limit'];
	if(dbTKV::SQLNUM_ROWS($get_limit)>=2)
	{
		while($row_time_addd  = dbTKV::SQL_FETCH($get_limit))
		{
			$tmt_limit +=$row_time_addd['tmt_limit'];
		}
	}

	
	$get_appointments = dbTKV::SQLQUERY("SELECT * FROM appointments WHERE 
	apts_did='".$this->doctorId."' 
	AND  apts_day='".$cellContent."' 
	AND  apts_month='".$cellMonth."' 
	AND  apts_year='".$cellYear."'  
	AND  apts_week='".$Week."'	
		");//AND apts_seen='0'

	if(dbTKV::SQLNUM_ROWS($get_appointments))
	{
		if(dbTKV::SQLNUM_ROWS($get_appointments)>=$tmt_limit)
		return ' Limited';
		
	}
	
	return 'AppointmentActive';
}
	
	
private function Appointment($cellNumber,$cellContent,$cellMonth,$cellYear){

	$cell	=	($cellNumber%7);
	if($cell==0)
		$Week	=	$this->days[6];	
	else
		$Week	=	$this->days[abs($cell-1)];	
	
if(self::Leaves($cellContent,$cellMonth,$cellYear,$Week)) return ' Leaves';
if(self::Selected($cellContent,$cellMonth,$cellYear,$Week)) return ' Selected';




if(date('d')>$cellContent && date('F')==$cellMonth && date('Y')==$cellYear)return false;



	$get_doc_time = dbTKV::SQLQUERY("SELECT * FROM timetable WHERE tmt_uid='".$this->doctorId."' ORDER BY tmtid DESC ");
	
	$array='';
	while($time_row  = dbTKV::SQL_FETCH($get_doc_time))
	{
		$array.=  $time_row['tmt_week'].',';
	}

	$AppointmentActive='';
	foreach(explode(",",$array) as $weekArray)
	{
		if($Week==$weekArray && $cellContent!=NULL)
		{
			
			
				$AppointmentActive=' '.self::AppointmentLimit($cellContent,$cellMonth,$cellYear,$Week);
		}
	}




return $AppointmentActive;
}	
	
	
	
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
             
         
	$cell	=	($cellNumber%7);
	if($cell==0)
		$Week	=	$this->days[6];	
	else
		$Week	=	$this->days[abs($cell-1)];	

		 
		 
		 
		 
        return '<li title="'.$Week.'" did="'.$this->doctorId.'" date="'.$cellContent.','.$this->currentMonthFull.','.$this->currentYear.','.$Week.'" class="AppointmentAdd '.$this->Appointment($cellNumber,$cellContent,$this->currentMonthFull,$this->currentYear).'">'.($cellContent).'</li>';
				
				
				
				
/*        return '<li id="li-'.$this->currentDate.'" class="'.($cellNumber%7==1?' start ':($cellNumber%7==0?' end ':' ')).
                ($cellContent==null?'mask':'').'">'.$cellContent.'</li>';
*/				
				
				
    }
     
    /**
    * create navigation
    */
    private function _createNavi(){
         
        $nextMonth = $this->currentMonth==12?1:intval($this->currentMonth)+1;
        $nextYear = $this->currentMonth==12?intval($this->currentYear)+1:$this->currentYear;
        $preMonth = $this->currentMonth==1?12:intval($this->currentMonth)-1;
        $preYear = $this->currentMonth==1?intval($this->currentYear)-1:$this->currentYear;
         
        return '<div class="header"><span class="title">'.date('Y M',strtotime($this->currentYear.'-'.$this->currentMonth.'-1')).'</span></div>';
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
         
        if(null==($year)) {
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


?>