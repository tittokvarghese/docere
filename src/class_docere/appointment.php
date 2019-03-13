<?php
/* 
 * Thank Jesus 
 * @Souce-code	TKV
 */


	if(isset($_POST['addreview']))
	{
		$uid	 		= MainFunc::Encrypt(MainFunc::filter($_POST['addreview']));
		$addfeedback	= MainFunc::filter($_POST['addfeedback']);
		$addstar	 	= MainFunc::Encrypt(MainFunc::filter($_POST['addstar']));
		
			$apym 	= dbTKV::SQLQUERY("SELECT * FROM  notifications  WHERE  
				not_fid='".$_SESSION['USER_ID']."'	AND 	not_tid='".$uid."' AND 	not_star='".$addstar."' AND 	not_feedback='".$addfeedback."' 	"); 
			if(!dbTKV::SQLNUM_ROWS($apym))
				dbTKV::SQLQUERY("INSERT INTO notifications (not_tid,not_fid,not_time,not_star,not_feedback,not_type)
				VALUES('".$uid."','".$_SESSION['USER_ID']."','".time()."','".$addstar."','".$addfeedback."','1'	) ");


		exit;
	}	
	else if(isset($_POST['cancelappointments']))
	{
		$uid	 = MainFunc::Encrypt(MainFunc::filter($_POST['cancelappointments']));
		$did	 = MainFunc::Encrypt(MainFunc::filter($_POST['did']));
		
		
		
		if(MainFunc::CheckUserDoctor($_SESSION['USER_ID']))
		{
			$apym 	= dbTKV::SQLQUERY("SELECT * FROM  appointments  WHERE  
				apts_did='".$_SESSION['USER_ID']."'	AND 	apts_pid='".$uid."' AND 	aptsid='".$did."' 	"); 
			if(dbTKV::SQLNUM_ROWS($apym))
				dbTKV::SQLQUERY("DELETE FROM  appointments WHERE 
				apts_did='".$_SESSION['USER_ID']."'	AND 	apts_pid='".$uid."' AND 	aptsid='".$did."'	");
				
				
			dbTKV::SQLQUERY("INSERT INTO notifications (not_tid,not_fid,not_time,not_star,not_feedback,not_type)
				VALUES('".$uid."','".$_SESSION['USER_ID']."','".time()."','0','','2'	) ");
				
				
		exit;
		}
		
		
			$apym 	= dbTKV::SQLQUERY("SELECT * FROM  appointments  WHERE  
				apts_pid='".$_SESSION['USER_ID']."'	AND 	apts_did='".$uid."' AND 	aptsid='".$did."' 	"); 
			if(dbTKV::SQLNUM_ROWS($apym))
				dbTKV::SQLQUERY("DELETE FROM  appointments WHERE 
				apts_pid='".$_SESSION['USER_ID']."'	AND 	apts_did='".$uid."' AND 	aptsid='".$did."'	");
				
		exit;
	}
	else if(isset($_POST['showappointments']))
	{
		$type	 = MainFunc::Encrypt(MainFunc::filter($_POST['showappointments']));
		Appointments::ShowAppointments($type);
		exit;
	}
	else if(isset($_POST['calendar']))
	{
		Appointments::Calendar();
		exit;
	}
	else if(isset($_POST['appointments']))
	{
	$appointments 		= MainFunc::Encrypt(MainFunc::filter($_POST['appointments']));
	$doctor_uid			= MainFunc::Encrypt(MainFunc::filter($_POST['adid']));
	
	
	$arr=array();
	foreach(explode(",",$appointments) as $fetch)
	{
	$arr[]=$fetch;
	}
	//31 August 2018 Friday
	
	
	$check_appointments = dbTKV::SQLQUERY("SELECT * FROM appointments  WHERE  apts_pid='".$_SESSION['USER_ID']."' AND apts_did='".$doctor_uid."' AND apts_seen='0' "); 
	if(!dbTKV::SQLNUM_ROWS($check_appointments))
		dbTKV::SQLQUERY("INSERT INTO appointments (apts_pid,apts_did,apts_day,apts_month,apts_year,apts_week)
			VALUES('".$_SESSION['USER_ID']."','".$doctor_uid."','".$arr[0]."','".$arr[1]."','".$arr[2]."','".$arr[3]."') ");


	exit;
	}











class Appointments{
public static function xxxxxxx(){
}




public static function ShowAppointments($type){


if($type=="latest")
	$q	= "SELECT A.*,U.* FROM appointments A,users U  WHERE  A.apts_pid='".$_SESSION['USER_ID']."'	 AND U.uid=A.apts_did AND  A.apts_seen='0'	ORDER BY A.aptsid DESC	";
else if($type=="today")
	$q	= "SELECT A.*,U.* FROM appointments A,users U  WHERE  A.apts_did='".$_SESSION['USER_ID']."'	 AND U.uid=A.apts_pid AND  A.apts_seen='0' 
		AND  A.apts_day='".ltrim(date('d'),'0')."'	 AND NOT U.uid='".$_SESSION['USER_ID']."'	ORDER BY A.aptsid DESC	";
else if($type=="new")
	$q	= "SELECT A.*,U.* FROM appointments A,users U  WHERE  A.apts_did='".$_SESSION['USER_ID']."'	 AND U.uid=A.apts_pid AND  A.apts_seen='0'
		 AND NOT U.uid='".$_SESSION['USER_ID']."'	ORDER BY A.aptsid DESC	";
else if($type=="previous")
	$q	= "SELECT A.*,U.* FROM appointments A,users U  WHERE  A.apts_did='".$_SESSION['USER_ID']."'	 AND U.uid=A.apts_pid AND  A.apts_seen='1'
		 AND NOT U.uid='".$_SESSION['USER_ID']."'   GROUP BY A.apts_did	ORDER BY A.aptsid DESC	";
else
	$q	= "SELECT A.*,U.* FROM appointments A,users U  WHERE  A.apts_pid='".$_SESSION['USER_ID']."'	 AND U.uid=A.apts_did AND  A.apts_seen='1'  GROUP BY A.apts_did ORDER BY A.aptsid DESC	";

	if(dbTKV::SQLNUM_ROWS(dbTKV::SQLQUERY($q)))
	{
		/* SHOW MORE SCRIPT	*/
			$offset	=	'0';
			$limit	=	'20';
	
			if(isset($_POST['see_more']))
			$offset	=	($_POST['see_more'] + $limit); // Limit set
		/* END SHOW MORE SCRIPT	*/
			
	$query_word = dbTKV::SQLQUERY("$q LIMIT $offset,$limit ");
	while($row  = dbTKV::SQL_FETCH($query_word))
	{
	
	if(date('d')==$row['apts_day'] &&  date('F')==$row['apts_month'])
			dbTKV::SQLQUERY("UPDATE appointments SET apts_seen='1' WHERE  apts_pid='".$_SESSION['USER_ID']."' AND aptsid='".$row['aptsid']."' ");	




echo '<div class="docBox" id="'.$row['uid'].'"  did="'.$row['aptsid'].'" ><div class="docImg"><img src="'.MainFunc::GetProfilePic($row['uid']).'" class="docW" alt="..." align="absmiddle"></div><div class="docDiv"><div class="docTitle"><span>'.MainFunc::GetName($row['uid'],3).'</span></div>

<div style="padding:10px 0px 0px 0px;font-size:14px;color:#006633;">
'.$row['apts_day'].'-'.$row['apts_month'].'-'.$row['apts_year'].' <strong>'.$row['apts_week'].'</strong>
</div>';



if($row['apts_seen']==1	&& !MainFunc::CheckUserDoctor($_SESSION['USER_ID']))
echo '<br /><select style="width:400px;background-color:#666666;color:#FFFFFF;font-weight:bold;" name="AddStar" id="AddStar">
<option value="5">Add Star: 5</option>
<option value="4">Add Star: 4</option>
<option value="3">Add Star: 3</option>
<option value="2">Add Star: 2</option>
<option value="1">Add Star: 1</option>
</select><br>
<textarea id="AddFeedBack" style="width:400px;background-color:#999999;color:#FFFFFF; font-size:18px;margin-top:5px;" placeholder="FeedBack"></textarea>
<br>
<div class="docBut AddReview_ajax">Add Review</div>';
else
echo '<div class="docBut CancelAppointments_ajax">Cancel</div>';






echo '</div></div>';	
	}	
		
}
 else
	echo  '<div align="center" style="padding:40px;background-color:#FFFFFF;"><b>No Appointments!</b></div>';


}










public static function Calendar(){

	$cal_uid 	= MainFunc::Encrypt(MainFunc::filter($_POST['cal_uid']));
	$month 		= date("m",time());
	$monthFull 	= date("F",time());
	if(isset($_POST['cal1']))
	{
		$month 		= MainFunc::Encrypt(MainFunc::filter($_POST['cal1']));
		$monthFull 	= MainFunc::Encrypt(MainFunc::filter($_POST['cal2']));
	}

	echo '<select id="CalendarSelect_ajax" did="'.$cal_uid.'">';
	for($m=date('m'); $m<=12; $m++){$monthOpt = date('F', mktime(0,0,0,$m, 1, date('Y')));echo '<option '.($monthFull==$monthOpt? 'selected':'').' id="'.$m.'" class="'.$monthOpt.'" value="'.$monthOpt.'">'.$monthOpt.'</option>';}
	echo '</select>';
	 
	$calendar = new Calendar($cal_uid);
	echo $calendar->show($month,$monthFull);
}




}




	header("Location: ".SITE_URL."");
	exit;

?>