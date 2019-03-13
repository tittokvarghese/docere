<?php
/* 
 * Thank Jesus 
 * @Souce-code	TKV
 */

	if(isset($_POST['nload']))
	{
		Notifications::Show();
		exit;
	}











class Notifications{
public static function xxxxxxx(){
}




public static function Show(){



	$q	= "SELECT N.*,U.* FROM notifications N,users U  WHERE  N.not_tid='".$_SESSION['USER_ID']."'	 AND U.uid=N.not_fid   ORDER BY N.notid DESC	";

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
	
			dbTKV::SQLQUERY("UPDATE notifications SET not_seen='1' WHERE  not_tid='".$_SESSION['USER_ID']."' AND not_seen='0' ");	




echo '<div class="docBox" id="'.$row['uid'].'"  did="'.$row['notid'].'" ><div class="docImg"><img src="'.MainFunc::GetProfilePic($row['uid']).'" class="docW" alt="..." align="absmiddle"></div><div class="docDiv"><div class="docTitle"><span>'.MainFunc::GetName($row['uid'],3).'</span>';




if($row['not_type']==1)echo ' added a review';

echo '</div>';


if($row['not_type']==1)
{
echo '<div style="padding:10px 0px 0px 0px;font-size:14px;color:#006633;line-height:24px;">
posted <strong>'.$row['not_star'].'</strong> star and <i>'.$row['not_feedback'].'</i> <br />
'.MainFunc::timeS($row['not_time'],0).'
</div>';
}
else if($row['not_type']==2)
{
echo '<div style="padding:10px 0px 0px 0px;font-size:14px;color:#006633;line-height:24px;">
<i>Canceled your Appointments</i> <br />
'.MainFunc::timeS($row['not_time'],0).'
</div>';
}
else if($row['not_type']==3)
{
echo '<div style="padding:10px 0px 0px 0px;font-size:14px;color:#006633;line-height:24px;">
<i>Canceled your appointments, because doctor will not available...</i> <br />
'.MainFunc::timeS($row['not_time'],0).'
</div>';
}




echo '</div></div>';	
	}	
		
}
 else
	echo  '<div align="center" style="padding:40px;background-color:#FFFFFF;"><b>No Notifications!</b></div>';


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