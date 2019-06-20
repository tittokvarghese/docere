<?php
/* 
 * Thank Jesus 
 * @Souce-code	TKV
 */




	if(isset($_POST['questions_answers']))
	{
	     $answers_text	= MainFunc::TrimMsg(MainFunc::Encrypt($_POST['answers_text']));
		 $ProfileId 	= MainFunc::Encrypt(MainFunc::filter($_POST['ProfileId']));
		 $QuestId 		= MainFunc::Encrypt(MainFunc::filter($_POST['QuestId']));
		
		if(empty($answers_text) or strlen($answers_text)<1 or ctype_space($answers_text))
			return;
			
			
		
			dbTKV::SQLQUERY("INSERT INTO questions_answers (qa_to_id,qa_fr_id,qa_text,qa_time,qa_qd_id)
				VALUES('".$ProfileId."','".$_SESSION['USER_ID']."','".$answers_text."','".time()."','".$QuestId."') 	");
			
			$latest_Uid 		= dbTKV::SQL_INSERT_ID();	

			dbTKV::SQLQUERY("INSERT INTO notifications (not_tid,not_fid,not_time,not_type,not_qa_id,not_qra_id)
				VALUES('".$ProfileId."','".$_SESSION['USER_ID']."','".time()."','5','".$QuestId."','".$latest_Uid."'	) ");	
				
		header("Location: ".SITE_URL."profiles/?id=".$_SESSION['USER_ID']."#answers");
		exit;
	}

	else if(isset($_POST['questions_data']))
	{
	     $questions_text	= MainFunc::TrimMsg(MainFunc::Encrypt($_POST['questions_text']));
		 $ProfileId 		= MainFunc::Encrypt(MainFunc::filter($_POST['ProfileId']));
		
		if(empty($questions_text) or strlen($questions_text)<1 or ctype_space($questions_text))
			return;
		
			dbTKV::SQLQUERY("INSERT INTO questions_data (qd_to_id,qd_fr_id,qd_text,qd_time)
				VALUES('".$ProfileId."','".$_SESSION['USER_ID']."','".$questions_text."','".time()."') 	");
				
			$latest_Uid 		= dbTKV::SQL_INSERT_ID();	
			dbTKV::SQLQUERY("INSERT INTO notifications (not_tid,not_fid,not_time,not_type,not_qa_id)
				VALUES('".$ProfileId."','".$_SESSION['USER_ID']."','".time()."','4','".$latest_Uid."'	) ");	
				
		header("Location: ".SITE_URL."profiles/?id=".$ProfileId."#answers");
		exit;
	}
	else if(isset($_POST['reporting_profile']))
	{
		 $reporting_profile 		= MainFunc::Encrypt(MainFunc::filter($_POST['reporting_profile']));
		 $ProfileId 				= MainFunc::Encrypt(MainFunc::filter($_POST['ProfileId']));
		 $reporting_profile_other	= '';
		 
		 
		 if($reporting_profile=="Other")
		 {
	     	$reporting_profile_other	= MainFunc::TrimMsg(MainFunc::Encrypt($_POST['reporting_profile_other']));
		 }
		 
		 
		 
		 
		
			dbTKV::SQLQUERY("INSERT INTO profile_report (pr_rid,pr_frid,pr_sub,pr_other,pr_time)
			VALUES('".$ProfileId."','".$_SESSION['USER_ID']."','".$reporting_profile."','".$reporting_profile_other."','".time()."') 	");
			
	header("Location: ".SITE_URL."profiles/?id=".$ProfileId."&report_done");
	exit;
	}
	else if(isset($_GET['delete_ques']))
	{
		 $delete_ques 	= MainFunc::Encrypt(MainFunc::filter($_GET['delete_ques']));
		 $ProfileId 	= MainFunc::Encrypt(MainFunc::filter($_GET['ProfileId']));
		
			
			$apym 	= dbTKV::SQLQUERY("SELECT * FROM  questions_data  WHERE  
				qd_fr_id='".$_SESSION['USER_ID']."'	AND 	qd_to_id='".$ProfileId."' AND 	qd_id='".$delete_ques."' 	"); 
			if(dbTKV::SQLNUM_ROWS($apym))
				dbTKV::SQLQUERY("DELETE FROM  questions_data WHERE 
				qd_fr_id='".$_SESSION['USER_ID']."'	AND 	qd_to_id='".$ProfileId."' AND 	qd_id='".$delete_ques."'	");
				
				
			$apym2 	= dbTKV::SQLQUERY("SELECT * FROM  questions_answers  WHERE  
				qa_fr_id='".$ProfileId."'	AND 	qa_to_id='".$_SESSION['USER_ID']."' AND 	qa_qd_id='".$delete_ques."' 	"); 
			if(dbTKV::SQLNUM_ROWS($apym2))
				dbTKV::SQLQUERY("DELETE FROM  questions_answers WHERE 
				qa_fr_id='".$ProfileId."'	AND 	qa_to_id='".$_SESSION['USER_ID']."' AND 	qa_qd_id='".$delete_ques."'	");
				

			$apymnn 	= dbTKV::SQLQUERY("SELECT * FROM  notifications  WHERE  
				(	(not_fid='".$_SESSION['USER_ID']."'	AND not_tid='".$ProfileId."') OR 
					(not_fid='".$ProfileId."'	AND not_tid='".$_SESSION['USER_ID']."')	)
				 AND 	not_qa_id='".$delete_ques."' 	"); 
			if(dbTKV::SQLNUM_ROWS($apymnn))
				dbTKV::SQLQUERY("DELETE FROM  notifications WHERE 
				(	(not_fid='".$_SESSION['USER_ID']."'	AND not_tid='".$ProfileId."') OR 
					(not_fid='".$ProfileId."'	AND not_tid='".$_SESSION['USER_ID']."')	)
					 AND 	not_qa_id='".$delete_ques."'	");
				
				
			

	header("Location: ".SITE_URL."profiles/?id=".$ProfileId."&delete_done#answers");
	exit;
	}
	else if(isset($_GET['delete_answers']))
	{
		 $delete_ques 		= MainFunc::Encrypt(MainFunc::filter($_GET['delete_answers']));
		 $delete_ques_id 	= MainFunc::Encrypt(MainFunc::filter($_GET['delete_ques_id']));
		 $ProfileId 		= MainFunc::Encrypt(MainFunc::filter($_GET['ProfileId']));
		
			
				
			$apym2 	= dbTKV::SQLQUERY("SELECT * FROM  questions_answers  WHERE  
				qa_to_id='".$ProfileId."'	AND 	qa_fr_id='".$_SESSION['USER_ID']."' AND  qa_id='".$delete_ques."' AND 	qa_qd_id='".$delete_ques_id."' 	"); 
			if(dbTKV::SQLNUM_ROWS($apym2))
				dbTKV::SQLQUERY("DELETE FROM  questions_answers WHERE 
				qa_to_id='".$ProfileId."'	AND 	qa_fr_id='".$_SESSION['USER_ID']."'  AND  qa_id='".$delete_ques."' AND 	qa_qd_id='".$delete_ques_id."'	");
				

			$apymnn 	= dbTKV::SQLQUERY("SELECT * FROM  notifications  WHERE  
				not_fid='".$_SESSION['USER_ID']."'	AND not_tid='".$ProfileId."'  AND 	not_qra_id='".$delete_ques."'  AND not_type='5'	"); 
			if(dbTKV::SQLNUM_ROWS($apymnn))
				dbTKV::SQLQUERY("DELETE FROM  notifications WHERE 
				not_fid='".$_SESSION['USER_ID']."'	AND not_tid='".$ProfileId."'  AND 	not_qra_id='".$delete_ques."'  AND not_type='5'	");
				
				
			

	header("Location: ".SITE_URL."profiles/?id=".$_SESSION['USER_ID']."&delete_done#answers");
	exit;
	}









?>