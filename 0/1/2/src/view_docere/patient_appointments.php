<?php
/* 
 * Thank Jesus 
 * @Souce-code	TKV
 */
 
 
 
if(!isset($_SESSION['USER_ID']))
{
header("Location: ".SITE_URL."");
exit;
}
 

	
	
if(!MainFunc::CheckUserDoctor($_SESSION['USER_ID']))
{
header("Location:  ".SITE_URL."");
exit;
}	

		

	
	
	
Header::$action			=	"enable";
Header::$title			=	array("action"=>"1", "content"=> "Appointments | ".SITE_NAME);
Header::$icon			=	array("action"=>"1");
Header::$author			=	array("action"=>"1", "content"=>SITE_NAME);
Header::$contentType	=	array("action"=>"1");
Header::$description	=	array("action"=>"1", "content"=>"");
Header::$keywords		=	array("action"=>"1", "content"=>SITE_NAME);
Header::$google			=	array("action"=>"1");
Header::$robots			=	array("action"=>"1", "content"=>"noindex");//robots.txt

Header::$add			=	array("action"=>"1", "content"=>"<style>


</style>".CSS_PATH.JQUERY_FILE."");


?>
<body>

<?php include 'header.php'; ?>

<div class="Content">
<div align="left" style="padding:70px;padding-top:50px;">
<div align="left" style="display:inline-block;vertical-align:top;background-color:#;width:750px;margin-left:20px;">

<?php
 
 

  
if(isset($_GET['tab']))
{
$type = $_GET['tab'];

$q	= "SELECT A.*,U.* FROM appointments A,users U  WHERE  A.apts_did='".$_SESSION['USER_ID']."'	 AND U.uid=A.apts_pid AND  A.apts_seen='0'  AND U.uact='1'
		AND  A.apts_day='".ltrim(date('d'),'0')."' 
		AND  A.apts_month='".ltrim(date('F'),'0')."'
		AND  A.apts_year='".ltrim(date('Y'),'0')."'
		AND NOT U.uid='".$_SESSION['USER_ID']."'	ORDER BY A.aptsid DESC	";

$qvisited	= "SELECT A.*,U.* FROM appointments A,users U  WHERE  A.apts_did='".$_SESSION['USER_ID']."'	 AND U.uid=A.apts_pid AND  A.apts_seen='1'  AND U.uact='1'
		AND  A.apts_day='".ltrim(date('d'),'0')."' 
		AND  A.apts_month='".ltrim(date('F'),'0')."'
		AND  A.apts_year='".ltrim(date('Y'),'0')."'
		AND NOT U.uid='".$_SESSION['USER_ID']."'	ORDER BY A.aptsid DESC	";



if($type=="todayVisited")
	$q	= $qvisited;
		 
else if($type=="new")
	$q	= "SELECT A.*,U.* FROM appointments A,users U  WHERE  A.apts_did='".$_SESSION['USER_ID']."'	 AND U.uid=A.apts_pid AND  A.apts_seen='0' AND U.uact='1'
		 AND NOT U.uid='".$_SESSION['USER_ID']."'	
		 AND NOT A.apts_day='".ltrim(date('d'),'0')."'
		 
		 AND NOT A.apts_seen='2'
		 ORDER BY A.aptsid DESC	";
		 
		 
else if($type=="missing")
	$q	= "SELECT A.*,U.* FROM appointments A,users U  WHERE  A.apts_did='".$_SESSION['USER_ID']."'	 AND U.uid=A.apts_pid AND  A.apts_seen='2' AND U.uact='1'
		 AND NOT U.uid='".$_SESSION['USER_ID']."'	
		 ORDER BY A.aptsid DESC	";
		 
		 
		 

else if($type=="previous")
	$q	= "SELECT A.*,U.* FROM appointments A,users U  WHERE  A.apts_did='".$_SESSION['USER_ID']."'	 AND U.uid=A.apts_pid AND  A.apts_seen='1' AND U.uact='1'
		 AND NOT U.uid='".$_SESSION['USER_ID']."'   	ORDER BY A.aptsid DESC	";
		 
		 
else if($type=="search")
{
	$key = MainFunc::Encrypt(MainFunc::filter($_GET['search_patient_appointments']));
	$q	= "SELECT A.*,U.* FROM appointments A,users U  WHERE   U.uid='".$key."'  AND U.uact='1' AND A.apts_pid=U.uid AND A.apts_did='".$_SESSION['USER_ID']."'
		 AND NOT U.uid='".$_SESSION['USER_ID']."'   	ORDER BY A.aptsid DESC	";
}

else if($type=="search_by_date")
{
	$day 	= MainFunc::Encrypt(MainFunc::filter($_GET['day']));
	$month 	= MainFunc::Encrypt(MainFunc::filter($_GET['month']));
	$year 	= MainFunc::Encrypt(MainFunc::filter($_GET['year']));
	$q	= "SELECT A.*,U.* FROM appointments A,users U  WHERE   A.apts_did='".$_SESSION['USER_ID']."'	 AND U.uid=A.apts_pid  AND U.uact='1'
		 AND NOT U.uid='".$_SESSION['USER_ID']."'   	
		 AND  A.apts_day='".$day."'
		 AND  A.apts_month='".$month."'
		 AND  A.apts_year='".$year."'
		 ORDER BY A.aptsid DESC	";
}
else if($type=="search_by_date_month")
{
	$day 	= MainFunc::Encrypt(MainFunc::filter($_GET['day']));
	$month 	= MainFunc::Encrypt(MainFunc::filter($_GET['month']));
	$q	= "SELECT A.*,U.* FROM appointments A,users U  WHERE   A.apts_did='".$_SESSION['USER_ID']."'	 AND U.uid=A.apts_pid  AND U.uact='1'
		 AND NOT U.uid='".$_SESSION['USER_ID']."'   	
		 AND  A.apts_day='".$day."'
		 AND  A.apts_month='".$month."'
		 ORDER BY A.aptsid DESC	";
}
else if($type=="search_by_month")
{
	$month 	= MainFunc::Encrypt(MainFunc::filter($_GET['month']));
	$q	= "SELECT A.*,U.* FROM appointments A,users U  WHERE   A.apts_did='".$_SESSION['USER_ID']."'	 AND U.uid=A.apts_pid  AND U.uact='1'
		 AND NOT U.uid='".$_SESSION['USER_ID']."'   	
		 AND  A.apts_month='".$month."'
		 ORDER BY A.aptsid DESC	";
}



}
?>

<div style="border:solid 1px #A2A2A2;">
<div style="font-weight:bold;font-size:16px;display:inline-block;vertical-align:top;padding:10px;">Patient Appointments</div>
<div align="right" style="display:inline-block;vertical-align:top;float:right;">
<a href="<?php echo SITE_URL;?>patient_appointments/?tab=today" style="font-weight:bold;font-size:16px;padding:10px;
<?php if(isset($_GET['tab']))if($_GET['tab']=="today") echo 'background-color:#A2A2A2;color:#FFFFFF;';else echo 'color:#000000;';?>
cursor:pointer;display:inline-block;vertical-align:top;">Today <?php if(dbTKV::SQLNUM_ROWS(dbTKV::SQLQUERY($q)) && $_GET['tab']=="today" ) echo '('.dbTKV::SQLNUM_ROWS(dbTKV::SQLQUERY($q)).')';?></a>


<?php if(dbTKV::SQLNUM_ROWS(dbTKV::SQLQUERY($qvisited))) {?>
<a href="<?php echo SITE_URL;?>patient_appointments/?tab=todayVisited" style="font-weight:bold;font-size:16px;padding:10px;
<?php if(isset($_GET['tab']))if($_GET['tab']=="todayVisited") echo 'background-color:#A2A2A2;color:#FFFFFF;';else echo 'color:#000000;';?>
cursor:pointer;display:inline-block;vertical-align:top;">Today Visited<?php if(dbTKV::SQLNUM_ROWS(dbTKV::SQLQUERY($qvisited))) echo '('.dbTKV::SQLNUM_ROWS(dbTKV::SQLQUERY($qvisited)).')';?></a>
<?php } ?>


<a href="<?php echo SITE_URL;?>patient_appointments/?tab=new" style="font-weight:bold;font-size:16px;padding:10px;
<?php if(isset($_GET['tab']))if($_GET['tab']=="new") echo 'background-color:#A2A2A2;color:#FFFFFF;';else echo 'color:#000000;';?>
cursor:pointer;display:inline-block;vertical-align:top;">Coming up</a>

<a href="<?php echo SITE_URL;?>patient_appointments/?tab=missing" style="font-weight:bold;font-size:16px;padding:10px;
<?php if(isset($_GET['tab']))if($_GET['tab']=="missing") echo 'background-color:#A2A2A2;color:#FFFFFF;';else echo 'color:#000000;';?>
cursor:pointer;display:inline-block;vertical-align:top;">Missing</a>




<a href="<?php echo SITE_URL;?>patient_appointments/?tab=previous" style="font-weight:bold;font-size:16px;padding:10px;
<?php if(isset($_GET['tab']))if($_GET['tab']=="previous") echo 'background-color:#A2A2A2;color:#FFFFFF;';else echo 'color:#000000;';?>
cursor:pointer;display:inline-block;vertical-align:top;">Previous</a>


</div>
</div>



<div style="border-top:solid 3px #A2A2A2;padding-top:15px;background-color:#FCFCFC;">



<?php 

	// Update appoinments table missing
	
	
	
	
	$compareDates = dbTKV::SQLQUERY(" SELECT * FROM appointments  WHERE  
	apts_did='".$_SESSION['USER_ID']."' AND  apts_month='".ltrim(date('F'),'0')."'
	AND apts_seen='0'");
	$date_row  = dbTKV::SQL_FETCH($compareDates);

	if(ltrim(date('d'),'0')>$date_row['apts_day'])
	{

		dbTKV::SQLQUERY("UPDATE appointments SET apts_seen='2' WHERE  
		apts_did='".$_SESSION['USER_ID']."'  AND  apts_month='".ltrim(date('F'),'0')."'
		AND apts_seen='0'
		");//AND  apts_day>'".ltrim(date('d'),'0')."'
	
	}
	
	
	
	
	
	
	
	

//echo MainFunc::get_month_name("August");

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
	
	

	
	
/*	//if($_GET['tab']=="new" && $row['apts_seen']=='1')
//	continue;
	echo ltrim(date('m'),'0');
	if($row['apts_month_num'] >= ltrim(date('m'),'0'))
	{
	echo '<br>'.$row['apts_day'];
		if($row['apts_day']<ltrim(date('d'),'0'))
		echo '<br>fsdf';
		else
	 		break;
	}
*/
	
	//if(date('d')==$row['apts_day'] &&  date('F')==$row['apts_month'])
	
	
	
	
	


if(MainFunc::CheckUserDoctor($_SESSION['USER_ID']))
$checkDoctorsId= $_SESSION['USER_ID'];
else
$checkDoctorsId= $row['uid'];



$myToken =  dbTKV::SQLNUM_ROWS(dbTKV::SQLQUERY("SELECT * FROM appointments   WHERE  apts_did='".$checkDoctorsId."'	
 AND apts_day='".$row['apts_day']."' 
 AND apts_month='".$row['apts_month']."'	
  AND apts_year='".$row['apts_year']."' 		"));
  
  
  	$q_times	= "SELECT V.*,U.* FROM visited_doctors V,users U WHERE  
	V.vd_to_id='".$row['uid']."' AND   V.vd_fr_id='".$_SESSION['USER_ID']."' 	 AND U.uid=V.vd_fr_id AND U.uact='1'   
	 ORDER BY V.vd_id DESC  ";
		$times = dbTKV::SQLNUM_ROWS(dbTKV::SQLQUERY($q_times));


  
  
echo '<div style="border-bottom:solid 1px #CCCCCC;padding:15px;">
<div style="display:inline-block;vertical-align:middle;"><img src="'.MainFunc::GetProfilePic($row['uid']).'" style="width:55px;height:55px;border-radius:100%;" alt="Image" align="absmiddle"></div>
<div style="display:inline-block;vertical-align:middle;margin-left:10px;width:300px;">
<div style="font-size:16px;font-weight:bold;">'.MainFunc::GetName($row['uid'],3).'</div>
<div style="font-size:11px;"><strong>Patient ID:</strong> '.$row['uid'].'</div>
<div style="font-size:11px;"><strong>Age:</strong> '.$row['uage'].'</div>
<div style="font-size:11px;"><strong>Date:</strong> '.$row['apts_day'].'-'.$row['apts_month'].'-'.$row['apts_year'].' <strong>'.$row['apts_week'].' - Token - '.$myToken.'</strong></div>
</div>
<div style="display:inline-block;vertical-align:middle;margin-left:10px;float:right;">


'.(date('d')==$row['apts_day'] &&  date('F')==$row['apts_month'] &&  date('Y')==$row['apts_year'] && $row['apts_seen']==0? '<a href="'.SITE_URL.'patient_appointments/?visited_profile&amp;ProfileId='.$row['uid'].'&amp;appointment_id='.$row['aptsid'].'" style="padding:8px 15px 8px 15px;background-color:#00CC33;color:#FFFFFF;display:inline-block;vertical-align:top;border-radius:100px;cursor:pointer;font-weight:bold;margin-left:0px;text-transform:uppercase;">Visited ('.$times.')</a>' : '<a href="'.SITE_URL.'patient/?id='.$row['uid'].'" style="padding:8px 15px 8px 15px;background-color:#00CC33;color:#FFFFFF;display:inline-block;vertical-align:top;border-radius:100px;cursor:pointer;font-weight:bold;margin-left:0px;text-transform:uppercase;">View Profile ('.$times.')</a>').'





'.(isset($_GET['tab']) ? ($_GET['tab']=="new" ? '<a onClick="if(confirm(\'Are you sure you want to remove?\')==false){return false;}"	
href="'.SITE_URL.'patient_appointments/?cancel_app&amp;ProfileId='.$row['uid'].'&amp;appointment_id='.$row['aptsid'].'" style="padding:8px 15px 8px 15px;border:solid 1px #666666;color:#000000;display:inline-block;vertical-align:top;border-radius:100px;cursor:pointer;font-weight:bold;margin-left:5px;">CANCEL</a>' : '') : '').'




</div>
</div>';  
  



	
	}	
		
}
 else
	echo  '<div style="padding:40px;text-align:center;font-size:15px;font-weight:bold;">No Appointments</div>';

?>




</div>
</div><div align="center" style="padding:;display:inline-block;vertical-align:top; width:300px;margin-left:50px;">



<div style="font-weight:bold;font-size:16px;">
<form method="get">
<div style="display:inline-block;vertical-align:top;">
<input type="hidden" name="tab" value="search">
<input type="text" name="search_patient_appointments" style="width:100%;padding:10px;border:solid 1px #A2A2A2;border-radius:100px;" placeholder="Search patient number"></div><div style="display:inline-block;vertical-align:top;margin-left:10px;"><input type="submit" style="padding:10px;border-radius:100px;
font-weight:bold;background-color:#0066FF;color:#FFFFFF;cursor:pointer;" value="Search"></div>
</form>
</div>



<div style="margin-top:50px;">
<div style="font-size:16px;font-weight:bold;padding:10px;">Search by date</div>
<style>
select{padding:10px;border:solid 1px #A2A2A2;}
</style>
<form method="get">
<input type="hidden" name="search_by_date">
<input type="hidden" name="tab" value="search_by_date">

<select name="month"><?php 
for($m=1; $m<=12; $m++){
     $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
     echo '<option '.(date('F')==$month? 'selected':'').'>'.$month.'</option>';
}?></select>
<select name="day"><?php 
for($hh=1;$hh<=9;$hh++)echo '<option '.(date('d')==$hh? 'selected':'').'>'.$hh.'</option>';
for($hh=10;$hh<=31;$hh++)echo '<option '.(date('d')==$hh? 'selected':'').'>'.$hh.'</option>';

?></select>
<select name="year"><?php 
for($dd=date('Y');$dd<=2020;$dd++)echo '<option '.(date('Y')==$dd? 'selected':'').'>'.$dd.'</option>';
?></select>
<br><input type="submit" style="padding:10px;border-radius:100px;width:100%;margin-top:10px;
font-weight:bold;background-color:#0066FF;color:#FFFFFF;cursor:pointer;" value="Search by date">
</form></div>












<div style="margin-top:50px;">
<div style="font-size:16px;font-weight:bold;padding:10px;">Search by day and month</div>
<style>
select{padding:10px;border:solid 1px #A2A2A2;}
</style>
<form method="get">
<input type="hidden" name="search_by_date_month">
<input type="hidden" name="tab" value="search_by_date_month">

<select name="month"><?php 
for($m=1; $m<=12; $m++){
     $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
     echo '<option '.(date('F')==$month? 'selected':'').'>'.$month.'</option>';
}?></select>
<select name="day"><?php 
for($hh=1;$hh<=9;$hh++)echo '<option '.(date('d')==$hh? 'selected':'').'>'.$hh.'</option>';
for($hh=10;$hh<=31;$hh++)echo '<option '.(date('d')==$hh? 'selected':'').'>'.$hh.'</option>';

?></select>
<br><input type="submit" style="padding:10px;border-radius:100px;width:100%;margin-top:10px;
font-weight:bold;background-color:#0066FF;color:#FFFFFF;cursor:pointer;" value="Search by date">
</form></div>



<div style="margin-top:50px;">
<div style="font-size:16px;font-weight:bold;padding:10px;">Search by  month</div>
<style>
select{padding:10px;border:solid 1px #A2A2A2;}
</style>
<form method="get">
<input type="hidden" name="search_by_month">
<input type="hidden" name="tab" value="search_by_month">

<select name="month"><?php 
for($m=1; $m<=12; $m++){
     $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
     echo '<option '.(date('F')==$month? 'selected':'').'>'.$month.'</option>';
}?></select>
<br><input type="submit" style="padding:10px;border-radius:100px;width:100%;margin-top:10px;
font-weight:bold;background-color:#0066FF;color:#FFFFFF;cursor:pointer;" value="Search by date">
</form></div>


</div>




</div>



</div></div>
</body>