<?php
/* 
 * Thank Jesus 
 * @Souce-code	TKV
 */




if(isset($_GET['visited_profile']))
{
		 $ProfileId 	= MainFunc::Encrypt(MainFunc::filter($_GET['ProfileId']));
		 $appointment_id 	= MainFunc::Encrypt(MainFunc::filter($_GET['appointment_id']));

			$apym2 	= dbTKV::SQLQUERY("SELECT * FROM  appointments  WHERE  
				apts_pid='".$ProfileId."'	AND 	apts_did='".$_SESSION['USER_ID']."' AND  aptsid='".$appointment_id."'	AND apts_seen='0' 	"); 
			if(dbTKV::SQLNUM_ROWS($apym2))
				dbTKV::SQLQUERY("INSERT INTO visited_doctors (vd_to_id,vd_fr_id,vd_time)
				VALUES('".$ProfileId."','".$_SESSION['USER_ID']."','".time()."') 	");
				
		dbTKV::SQLQUERY("UPDATE appointments SET apts_seen='1' WHERE  
				apts_pid='".$ProfileId."'	AND  apts_did='".$_SESSION['USER_ID']."' AND aptsid='".$appointment_id."' ");	


	header('Location: '.SITE_URL.'patient/?id='.$ProfileId.'');
	exit;
}
else if(isset($_GET['cancel_app']))
{
	$ProfileId 			= MainFunc::Encrypt(MainFunc::filter($_GET['ProfileId']));
	$appointment_id 	= MainFunc::Encrypt(MainFunc::filter($_GET['appointment_id']));

	if(MainFunc::CheckUserDoctor($_SESSION['USER_ID']))
	{
		$apym 	= dbTKV::SQLQUERY("SELECT * FROM  appointments  WHERE  
			apts_did='".$_SESSION['USER_ID']."'	AND 	apts_pid='".$ProfileId."' AND 	aptsid='".$appointment_id."' 	"); 
		if(dbTKV::SQLNUM_ROWS($apym))
			dbTKV::SQLQUERY("DELETE FROM  appointments WHERE 
			apts_did='".$_SESSION['USER_ID']."'	AND 	apts_pid='".$ProfileId."' AND 	aptsid='".$appointment_id."'	");
			
		dbTKV::SQLQUERY("INSERT INTO notifications (not_tid,not_fid,not_time,not_star,not_feedback,not_type)
			VALUES('".$ProfileId."','".$_SESSION['USER_ID']."','".time()."','0','','2'	) ");
	}
	
	header('Location: '.SITE_URL.'patient_appointments/');
	exit;
}

























if(!isset($_GET['tab']))
{
header('Location: '.SITE_URL.'patient_appointments/?tab=today');
exit;
}

?>