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
 
if(isset($_GET['id']))
{
	$ProfileId=MainFunc::Encrypt(MainFunc::filter($_GET['id']));
}
else
{
header("Location:  ".SITE_URL."");
exit;
}
	
	

	
	
	if(MainFunc::CheckUserDoctor($_SESSION['USER_ID']))
	{
	
	
	}
	else
	{
			if($_SESSION['USER_ID']!=$ProfileId)
		{
		header("Location:  ".SITE_URL."");
		exit;
		}

	
	}
	
	
/*if(!MainFunc::CheckUserDoctor($_SESSION['USER_ID']))
{
header("Location:  ".SITE_URL."");
exit;
}	*/

		
if(!MainFunc::CheckActiveUser($ProfileId))
{
header("Location:  ".SITE_URL."");
exit;
}	
	
	
if(!MainFunc::CheckActivePatient($ProfileId))
{
header("Location:  ".SITE_URL."");
exit;
}	
		
	
Header::$action			=	"enable";
Header::$title			=	array("action"=>"1", "content"=> MainFunc::GetName($ProfileId,3)." | ".SITE_NAME);
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
<div align="left"  style="padding:70px;padding-top:20px;">





<div align="left" style="display:inline-block;vertical-align:top;margin-top:50px;">
<img src="<?php echo  MainFunc::GetProfilePic($ProfileId);?>" style="width:150px;height:150px;border-radius:100%;" alt="Image" align="absmiddle"></div><div align="left" style="padding:10px;display:inline-block;vertical-align:top;background-color:#;width:650px;margin-left:20px;">

<span style="font-size:25px;"><?php 
if(MainFunc::CheckUserDoctor($ProfileId)) echo 'Dr.';		echo MainFunc::GetName($ProfileId,3);?></span>
<span style="font-size:15px;vertical-align:baseline;margin-left:10px;"><?php echo MainFunc::GetDoctorsTable($ProfileId,"doc_degree");?></span>

<div style="font-size:14px;vertical-align:middle;">
<br><strong>Age:</strong> <?php echo str_replace("\n","<br>", MainFunc::GetUsersTable($ProfileId,"uage"));?>
<strong style="margin-left:30px;">Phone number:</strong> <?php echo str_replace("\n","<br>", MainFunc::GetUsersTable($ProfileId,"uphone"));?>
<br><br><strong>HomeTown:</strong> <?php echo MainFunc::GetUsersTable($ProfileId,"ulocation");?>

<br><br><strong>Created on:</strong> <?php echo str_replace("\n","<br>", MainFunc::GetUsersTable($ProfileId,"udate"));?>, <u><?php echo MainFunc::timeS(MainFunc::GetUsersTable($ProfileId,"utime"),0);?></u>

</div>



<a name="PatientReport"></a>
<div style="padding:15px;border:solid 0px #999999;text-align:left;margin-top:50px;font-size:18px;  color:#FFFFFF;border-radius:100px;background-color:#006699;">
Patient Report

<?php
if(MainFunc::CheckUserDoctor($_SESSION['USER_ID']))
{
?>
<a href="<?php echo SITE_URL;?>patient/?id=<?php echo $ProfileId;?>&amp;openRoom=<?php echo $_SESSION['USER_ID'];?>#PatientReport" style="float:right;font-size:13px;cursor:pointer;color:#FFFF00;margin-right:10px;"><strong>YOUR REPORTS</strong></a>
<?php
}
?>



</div>
<div style="border:solid 1px #999999;text-align:left;height:500px;overflow:auto;border-radius:15px;margin-top:10px;background-color:#C1C1C1;">





<?php


if(isset($_GET['openRoom']))
{



	$openRoom 	= MainFunc::Encrypt(MainFunc::filter($_GET['openRoom']));

	$q_answers	= "SELECT P.*,U.*,D.* FROM patient_report P,users U,doctors D  WHERE  P.pr_to_id='".$ProfileId."' AND P.pr_fr_id='".$openRoom."' AND D.doc_uid=P.pr_fr_id	 AND U.uid=P.pr_fr_id AND U.uact='1'   
	ORDER BY P.pr_id DESC ";

	if(!dbTKV::SQLNUM_ROWS(dbTKV::SQLQUERY($q_answers)))
	{
	echo '<div style="text-align:center;font-size:16px;color:#666666;font-weight:bold;padding:10px;">No new reports</div>';
	}
	else
	{
			
	$query_answers = dbTKV::SQLQUERY("$q_answers LIMIT 20 ");
	while($row_ques  = dbTKV::SQL_FETCH($query_answers))
	{
	
	//$row_ques['apts_day']
	
	
	
	?>
<div style="border-bottom:solid 1px #CACACA;padding:10px;padding-bottom:3px;background-color:#FCFCFC;"><div style="display:inline-block;vertical-align:top;"><img src="<?php echo  MainFunc::GetProfilePic($row_ques['pr_fr_id']);?>" style="width:35px;height:35px;border-radius:100%;" alt="Image" align="absmiddle"></div><div style="display:inline-block;vertical-align:top;width:540px;margin-left:8px;font-size:12px;text-align:justify;"><?php echo str_replace("\n","<br>",$row_ques['pr_text']);





if($row_ques['pr_file'])
	echo '<div><strong>File: <a href="'.SITE_URL.FILES_SAVE_PATH.$row_ques['pr_file'].'">DOWNLOAD</a></strong></div>';



?>


</div><div align="right" style="display:block;font-size:11px;margin-top:3px;margin-right:10px;">
<strong>Specialities:</strong> <?php echo $row_ques['doc_type'];?> | <?php echo MainFunc::timeS($row_ques['pr_time'],0);?> 

<?php
if($_SESSION['USER_ID']==$row_ques['pr_fr_id'])
{
?>
| <a href="<?php echo SITE_URL;?>patient/?delete_reports=<?php echo $row_ques['pr_id'];?>&amp;ProfileId=<?php echo $row_ques['pr_to_id'];?>" onClick="if(confirm('Are you sure you want to remove?')==false){return false;}">Delete</a>
<?php
}
?>
</div></div>
<?php 

}
}



}
else
{
?>
<div align="center" style="margin:20px;padding:20px;">
<?php

	$q_answers	= "SELECT P.*,U.*,D.* FROM patient_report P,users U,doctors D  WHERE  P.pr_to_id='".$ProfileId."' AND D.doc_uid=P.pr_fr_id	 AND U.uid=P.pr_fr_id AND U.uact='1'   
	GROUP BY P.pr_fr_id ORDER BY P.pr_id DESC  ";

	if(!dbTKV::SQLNUM_ROWS(dbTKV::SQLQUERY($q_answers)))
	{
	echo '<div style="text-align:center;font-size:16px;color:#666666;font-weight:bold;padding:10px;">No new reports</div>';
	}
	else
	{
			
	$query_answers = dbTKV::SQLQUERY("$q_answers LIMIT 20 ");
	while($row_ques  = dbTKV::SQL_FETCH($query_answers))
	{
	
	//$row_ques['apts_day']
	
	
	
?>
<a href="<?php echo SITE_URL;?>patient/?id=<?php echo $ProfileId;?>&amp;openRoom=<?php echo $row_ques['pr_fr_id'];?>#PatientReport"><div align="left" style="border:solid 1px #828282;padding:10px;width:270px;border-radius:100px;background-color:#F7F7F7;cursor:pointer;margin:10px;"><div style="display:inline-block;vertical-align:top;"><img src="<?php echo  MainFunc::GetProfilePic($row_ques['pr_fr_id']);?>" style="width:35px;height:35px;border-radius:100%;" alt="Image" align="absmiddle"></div><div style="display:inline-block;vertical-align:top;width:;margin-left:8px;font-size:12px;text-align:justify;"><div style="font-size:14px;font-weight:bold;color:#333333;"><?php 

if($row_ques['pr_fr_id']==$_SESSION['USER_ID'])
echo 'YOU';
else
echo 'Dr.'.MainFunc::GetName($row_ques['pr_fr_id'],3);?></div><div style="font-size:12px;color:#333333;"><strong>Specialities:</strong> <?php echo $row_ques['doc_type'];?></div></div></div></a>
<?php 
}
}
 ?>
</div>

<?php } ?>








</div>


<?php

if(MainFunc::CheckUserDoctor($_SESSION['USER_ID']))
{
	if(isset($_GET['openRoom']))
	{
	if($openRoom==$_SESSION['USER_ID'])
	{
	?>
		<div style="border:solid 0px #999999;padding:0px;margin-top:5px;">
		<form method="post" enctype="multipart/form-data">
		<textarea name="reports_text" style="padding:10px;font-size:15px;width:100%; height:100px;border-radius:0px 0px;border:solid 0px #666666;
		background-color:#C1C1C1;"  placeholder="Patient Report"  ></textarea>
        
        
        
        
        <div style="font-weight:bold;padding:15px;">File attachments</div>
<input type="file" name="patient_file" style="width:100%;border-radius:100px;padding:10px;font-size:14px;background-color:#D6D6D6;"><br>

        
        
		<input type="hidden" name="reports_data"><br>
		<input type="hidden" value="<?php echo $ProfileId;?>" name="ProfileId">
		<input type="submit" value="SUBMIT" style=" width:100px;padding:10px;text-align:center;margin-top:px;font-size:15px;cursor:pointer;
		background-color:#0066FF;color:#FFFFFF;border-radius:100px;font-weight:bold;float:right;">
		</form>
		</div>
<?php
	}
	}
	}
?>


























</div><div align="center" style="padding:;display:inline-block;vertical-align:top; width:300px;margin-left:20px;">

<?php

	$q_answerse	= "SELECT V.*,U.*,D.* FROM visited_doctors V,users U,doctors D  WHERE  V.vd_to_id='".$ProfileId."' AND D.doc_uid=V.vd_fr_id	 AND U.uid=V.vd_fr_id AND U.uact='1'   
	GROUP BY V.vd_fr_id ORDER BY V.vd_id DESC  ";
	
?>

<div style="z-index:5;position:relative; border: solid 1px #999999; padding:10px;font-size:15px;text-transform:uppercase;border-radius:5px;display:inline-block;background-color:#FBFBFB;">Visited Doctors (<?php echo dbTKV::SQLNUM_ROWS(dbTKV::SQLQUERY($q_answerse));?>)</div>
<div align="left" style="border:solid 1px #BEBEBE;padding-top:0px;margin-top:-8px;min-height:auto;max-height:600px;overflow-x:hidden;overflow-y:auto;">


<?php


	if(!dbTKV::SQLNUM_ROWS(dbTKV::SQLQUERY($q_answerse)))
	{
	echo '<div style="text-align:center;font-size:16px;color:#666666;font-weight:bold;padding:10px;">NO NEW VISITED DOCTORS</div>';
	}
	else
	{
		
		
			
	$query_answersdd = dbTKV::SQLQUERY("$q_answerse LIMIT 20 ");
	while($row_ques  = dbTKV::SQL_FETCH($query_answersdd))
	{
		
	
	$q_times	= "SELECT V.*,U.* FROM visited_doctors V,users U WHERE  V.vd_to_id='".$row_ques['vd_to_id']."' AND   V.vd_fr_id='".$row_ques['vd_fr_id']."' 	 AND U.uid=V.vd_fr_id AND U.uact='1'   
	 ORDER BY V.vd_id DESC  ";
		$times = dbTKV::SQLNUM_ROWS(dbTKV::SQLQUERY($q_times));

?>





<div style="border-bottom:solid 1px #D6D6D6;padding:10px;background-color:#F8F8F8;">
<div style="display:inline-block;vertical-align:top;"><img src="<?php echo  MainFunc::GetProfilePic($row_ques['vd_fr_id']);?>" style="width:45px;height:45px;border-radius:100%;" alt="Image" align="absmiddle"></div>
<div style="display:inline-block;vertical-align:top;width:200px;margin-left:10px;">
<div style="font-size:14px;font-weight:bold;color:#333333;"><?php 

if($row_ques['vd_fr_id']==$_SESSION['USER_ID'])
echo 'YOU';
else
echo 'Dr.'.MainFunc::GetName($row_ques['vd_fr_id'],3);?></div>
<div style="font-size:12px;color:#333333;"><?php echo $row_ques['doc_degree'];?></div>
<div style="font-size:12px;color:#333333;"><strong>Specialities:</strong> <?php echo $row_ques['doc_type'];?></div>
<div style="font-size:12px;color:#333333;"><strong>Mobile:</strong> <?php echo $row_ques['uphone'];?></div>
<div style="font-size:12px;color:#333333;"><strong><?php echo $times;?></strong> Time visited</div>
</div>
<!--<div align="center" style="padding:3px;background-color:#E3E3E3;margin:5px -10px -10px -10px;">
<div style="display:inline-block;vertical-align:top;width:130px;"><strong>Mobile</strong><br>9944558890</div>
<div style="display:inline-block;vertical-align:top;width:130px;"><strong>5</strong><br>Visited</div>
</div>-->
</div>
<?php
}
}
?>


</div>
</div>










</div>
</div>
</body>