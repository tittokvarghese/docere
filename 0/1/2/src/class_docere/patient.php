<?php
/* 
 * Thank Jesus 
 * @Souce-code	TKV
 */


	if(isset($_POST['reports_data']))
	{
	     $answers_text	= MainFunc::TrimMsg(MainFunc::Encrypt($_POST['reports_text']));
		 $ProfileId 	= MainFunc::Encrypt(MainFunc::filter($_POST['ProfileId']));
		 $patient_file 	= '';
		

			
	
			
if(isset($_FILES['patient_file']))
{


	$doc_file 	 = $_FILES['patient_file'];
	$newImageName = rand(99999,999999).'_'.time().'_'.rand(time(),999999).'_'.rand(99999,999999).'_n';
	$fullpath	= FILES_SAVE_PATH.$newImageName.'.'; 
	$imageSize 	= $doc_file['size'];
	$tempSrc	= $doc_file['tmp_name']; 
	$imageType	= $doc_file['type']; 
	$fileExt = substr(strrchr($doc_file['name'],'.'),1);


	if($imageSize>1)
	{
			$allowedfileExtensions = array('docx', 'pdf', 'pptx', 'jpeg','jpg', 'png', 'xls', 'doc');
			if (in_array($fileExt, $allowedfileExtensions))
			{
				move_uploaded_file($tempSrc,$fullpath.$fileExt);
				$patient_file 	= $newImageName.'.'.$fileExt;
			}	
			else
			{
				header("Location: ".SITE_URL."patient/?id=".$ProfileId."&openRoom=".$_SESSION['USER_ID']."&error_uploading#PatientReport");
				exit;
			}
	}
	
	
			if(empty($answers_text) or strlen($answers_text)<1 or ctype_space($answers_text))
			{
				if($imageSize<1)
				return;
			}
	
	
}

			
			dbTKV::SQLQUERY("INSERT INTO patient_report (pr_to_id,pr_fr_id,pr_text,pr_file,pr_time)
				VALUES('".$ProfileId."','".$_SESSION['USER_ID']."','".$answers_text."','".$patient_file."','".time()."') 	");
	
			
		header("Location: ".SITE_URL."patient/?id=".$ProfileId."&openRoom=".$_SESSION['USER_ID']."#PatientReport");
		exit;
	}
	else if(isset($_GET['delete_reports']))
	{
		 $delete_reports 	= MainFunc::Encrypt(MainFunc::filter($_GET['delete_reports']));
		 $ProfileId 		= MainFunc::Encrypt(MainFunc::filter($_GET['ProfileId']));
			
			$apym2 	= dbTKV::SQLQUERY("SELECT * FROM  patient_report  WHERE  
				pr_to_id='".$ProfileId."'	AND 	pr_fr_id='".$_SESSION['USER_ID']."' AND  pr_id='".$delete_reports."'  	"); 
			if(dbTKV::SQLNUM_ROWS($apym2))
				dbTKV::SQLQUERY("DELETE FROM  patient_report WHERE 
				pr_to_id='".$ProfileId."'	AND 	pr_fr_id='".$_SESSION['USER_ID']."'  AND  pr_id='".$delete_reports."' 	");
				
				
				
	$row  = dbTKV::SQL_FETCH($apym2);
	if($row['pr_file'])
	{
		if(file_exists(FILES_SAVE_PATH.$row['pr_file']))
			unlink(FILES_SAVE_PATH.$row['pr_file']);
	}
		
				

	header("Location: ".SITE_URL."patient/?id=".$ProfileId."&openRoom=".$_SESSION['USER_ID']."&delete_done#PatientReport");
	exit;
	}


?>