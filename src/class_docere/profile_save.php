<?php
/* 
 * Thank Jesus 
 * @Souce-code	TKV
 */


	if(isset($_POST['doc_fname']))
	{
	echo Profile::Save();
	//exit;
	}
	else if(isset($_POST['doc_time']))
	{
	echo Profile::SaveTimeTable();
	//exit;
	}
	else if(isset($_POST['gender']))
	{
	echo Profile::SaveGender();
	exit;
	}

	else if(isset($_POST['symremove']))
	{
	$symremove 			= MainFunc::Encrypt(MainFunc::filter($_POST['symremove']));
	$sym 				= dbTKV::SQLQUERY("SELECT * FROM symptoms  WHERE  sym_uid='".$_SESSION['USER_ID']."' AND symid='".$symremove."' "); 
	if(dbTKV::SQLNUM_ROWS($sym))
		dbTKV::SQLQUERY("DELETE FROM symptoms WHERE sym_uid='".$_SESSION['USER_ID']."' 	AND symid='".$symremove."'	");

	exit;
	}

	else if(isset($_POST['timeremove']))
	{
	$timeremove 		= MainFunc::Encrypt(MainFunc::filter($_POST['timeremove']));
	$time 				= dbTKV::SQLQUERY("SELECT * FROM timetable  WHERE  tmt_uid='".$_SESSION['USER_ID']."' AND tmtid='".$timeremove."' "); 
	if(dbTKV::SQLNUM_ROWS($time))
		dbTKV::SQLQUERY("DELETE FROM timetable WHERE tmt_uid='".$_SESSION['USER_ID']."' 	AND tmtid='".$timeremove."'	");

	exit;
	}
	
	else if(isset($_POST['leaves']))
	{
	$lmonth 	= MainFunc::Encrypt(MainFunc::filter($_POST['lmonth']));
	$ldays 		= ltrim(MainFunc::Encrypt(MainFunc::filter($_POST['ldays'])),'0');
	$lyear 		= MainFunc::Encrypt(MainFunc::filter($_POST['lyear']));
	
		$leaves 	= dbTKV::SQLQUERY("SELECT * FROM leaves  WHERE  
					lea_did='".$_SESSION['USER_ID']."' AND lea_day='".$ldays."' AND lea_month='".$lmonth."' AND lea_year='".$lyear."'			"); 
		if(!dbTKV::SQLNUM_ROWS($leaves))
		{
			dbTKV::SQLQUERY("INSERT INTO leaves (lea_did,lea_day,lea_month,lea_year,lea_week,lea_type)
			VALUES('".$_SESSION['USER_ID']."','".$ldays."','".$lmonth."','".$lyear."','".date("l", strtotime($ldays.'-'.$lmonth.'-'.$lyear))."','1') 	");
		}
		
		
		


			$apymLeave 	= dbTKV::SQLQUERY("SELECT * FROM  appointments  WHERE  
				apts_day='".$ldays."' AND apts_month='".$lmonth."'  AND apts_year='".$lyear."' 	"); 
			
			if(dbTKV::SQLNUM_ROWS($apymLeave))
			{
				while($rowLeave = dbTKV::SQL_FETCH($apymLeave))
				{
					
				dbTKV::SQLQUERY("INSERT INTO notifications (not_tid,not_fid,not_time,not_star,not_feedback,not_type)
					VALUES('".$rowLeave['apts_pid']."','".$_SESSION['USER_ID']."','".time()."','0','','3'	) ");
					
				dbTKV::SQLQUERY("DELETE FROM  appointments WHERE 
					apts_did='".$_SESSION['USER_ID']."'	AND  apts_pid='".$rowLeave['apts_pid']."' AND 	aptsid='".$rowLeave['aptsid']."'	");
								
				}	
			}


		
		
		
		
		
		

	header("Location: ".SITE_URL."");
	exit;
	}
	else if(isset($_POST['leaveremove']))
	{
	$timeremove 		= MainFunc::Encrypt(MainFunc::filter($_POST['leaveremove']));
	$timeleaves 		= dbTKV::SQLQUERY("SELECT * FROM leaves  WHERE  lea_did='".$_SESSION['USER_ID']."' AND leaid='".$timeremove."' "); 
	if(dbTKV::SQLNUM_ROWS($timeleaves))
		dbTKV::SQLQUERY("DELETE FROM leaves WHERE lea_did='".$_SESSION['USER_ID']."' 	AND leaid='".$timeremove."'	");

	exit;
	}









class Profile{
public static function xxxxxxx(){
}







public static function SaveTimeTable(){

	
	if(!isset($_POST['doc_week']))
	{
			return "Select your Week";
	}

	
	$doc_week 		= implode(",",$_POST['doc_week']);
	$f_hh 			= MainFunc::Encrypt(MainFunc::filter($_POST['f_hh']));
	$f_mm 			= MainFunc::Encrypt(MainFunc::filter($_POST['f_mm']));
	$f_time 		= MainFunc::Encrypt(MainFunc::filter($_POST['f_time']));

	$t_hh 			= MainFunc::Encrypt(MainFunc::filter($_POST['t_hh']));
	$t_mm 			= MainFunc::Encrypt(MainFunc::filter($_POST['t_mm']));
	$t_time 		= MainFunc::Encrypt(MainFunc::filter($_POST['t_time']));
	
	$doc_limit 		= MainFunc::Encrypt(MainFunc::filter($_POST['doc_limit']));



		if(empty($doc_limit) or strlen($doc_limit)<1 or ctype_space($doc_limit))
		{
			return "Enter your Limits";
		}


		$doctors 	= dbTKV::SQLQUERY("SELECT * FROM timetable  WHERE  
					tmt_uid='".$_SESSION['USER_ID']."' AND tmt_week='".$doc_week."' AND tmt_ftime='".$f_time."'			"); 
		if(!dbTKV::SQLNUM_ROWS($doctors))
		{
			dbTKV::SQLQUERY("INSERT INTO timetable (tmt_uid,tmt_week,tmt_fhh,tmt_fmm,tmt_ftime,tmt_thh,tmt_tmm,tmt_totime,tmt_limit)
			VALUES('".$_SESSION['USER_ID']."','".$doc_week."','".$f_hh."','".$f_mm."','".$f_time."','".$t_hh."','".$t_mm."','".$t_time."','".$doc_limit."') ");
		}
		
}














public static function SaveGender(){
	$gender 		= MainFunc::Encrypt(MainFunc::filter($_POST['gender']));
	dbTKV::SQLQUERY("UPDATE users SET ugender='".$gender."' WHERE  uid='".$_SESSION['USER_ID']."' ");	
}


public static function Save(){

	$doc_fname 			= MainFunc::Encrypt(MainFunc::filter($_POST['doc_fname']));
	$doc_lname 			= MainFunc::Encrypt(MainFunc::filter($_POST['doc_lname']));
	$patient 			= MainFunc::Encrypt(MainFunc::filter($_POST['patient']));
	$doc_location 		= MainFunc::Encrypt(MainFunc::filter($_POST['doc_location']));
	$doc_upload_image 	= @$_FILES['doc_upload_image'];



		$check_uid 	= dbTKV::SQLQUERY("SELECT * FROM users  WHERE  uid='".$_SESSION['USER_ID']."' ");
		if(empty($doc_fname) or strlen($doc_fname)<1 or ctype_space($doc_fname))
		{
			return "Enter your First name";
		}
		else if(empty($doc_lname) or strlen($doc_lname)<1 or ctype_space($doc_lname))
		{
			return "Enter your Last name";
		}
		else if(!dbTKV::SQLNUM_ROWS($check_uid))
		{
			return "Sorry no such account exists";
		}
		
				
	if(isset($doc_upload_image) && is_uploaded_file($doc_upload_image['tmp_name']))
	{
		include 'photo_upload_class.php';
		$photo = new setProfilePhoto($doc_upload_image);
		$photo->upload();
	
			dbTKV::SQLQUERY("UPDATE users SET fname='".$doc_fname."',lname='".$doc_lname."',ulocation='".$doc_location."',uimage='".$photo->newImageName."'
					WHERE  uid='".$_SESSION['USER_ID']."' ");	
	}				
	else
	{
			dbTKV::SQLQUERY("UPDATE users SET fname='".$doc_fname."',lname='".$doc_lname."',ulocation='".$doc_location."'
					WHERE  uid='".$_SESSION['USER_ID']."' ");	
	}				
					
				
				
				
				
				

			if($patient==1) return;
		
		
		$doc_degree 		= MainFunc::Encrypt(MainFunc::filter($_POST['doc_degree']));
		$doc_fee 			= MainFunc::Encrypt(MainFunc::filter($_POST['doc_fee']));
		$doc_type 			= MainFunc::Encrypt(MainFunc::filter($_POST['doc_type']));
		$doc_symptoms 		= MainFunc::Encrypt(MainFunc::filter($_POST['doc_symptoms']));
		$doc_services 		= MainFunc::TrimMsg($_POST['doc_services']);
		$doc_member 		= MainFunc::TrimMsg($_POST['doc_member']);
		$doc_about 			= MainFunc::TrimMsg($_POST['doc_about']);
		
		$doctors 	= dbTKV::SQLQUERY("SELECT * FROM doctors  WHERE  doc_uid='".$_SESSION['USER_ID']."' "); 
		if(!dbTKV::SQLNUM_ROWS($doctors))
		{
			dbTKV::SQLQUERY("INSERT INTO doctors (doc_uid,doc_degree,doc_fee,doc_type,doc_services,doc_member,doc_about)
			VALUES('".$_SESSION['USER_ID']."','".$doc_degree."','".$doc_fee."','".$doc_type."','".$doc_services."','".$doc_member."','".$doc_about."') ");
		}
		else
		{
				dbTKV::SQLQUERY("UPDATE doctors SET 
				doc_degree='".$doc_degree."',doc_fee='".$doc_fee."',doc_type='".$doc_type."',
				doc_services='".$doc_services."',doc_member='".$doc_member."',doc_about='".$doc_about."'
				WHERE  doc_uid='".$_SESSION['USER_ID']."' ");	
		}
		
		
		if(isset($_POST['doc_symptoms']))
		{
			$sym 	= dbTKV::SQLQUERY("SELECT * FROM symptoms  WHERE  sym_uid='".$_SESSION['USER_ID']."' "); 
			if(dbTKV::SQLNUM_ROWS($sym))
				dbTKV::SQLQUERY("DELETE FROM symptoms WHERE sym_uid='".$_SESSION['USER_ID']."'");

			
			foreach(explode(",",$doc_symptoms) as $symptoms)
			{
				
					dbTKV::SQLQUERY("INSERT INTO symptoms (sym_uid,sym_items)
					VALUES('".$_SESSION['USER_ID']."','".$symptoms."') ");
				
			
			}
		
		}		
		
		
		
		
		
}









}




	header("Location: ".SITE_URL."");
	exit;

?>