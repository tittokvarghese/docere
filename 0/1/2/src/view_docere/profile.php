<?php
/* 
 * Thank Jesus 
 * @Souce-code	TKV
 */

if(isset($_GET['id']))
{
	$ProfileId=MainFunc::Encrypt(MainFunc::filter($_GET['id']));
}
	


$pageTitle="profile";

Header::$action			=	"enable";
Header::$title			=	array("action"=>"1", "content"=>"".MainFunc::GetName($ProfileId,3)." - ".SITE_NAME);
Header::$icon			=	array("action"=>"1");
Header::$author			=	array("action"=>"1", "content"=>SITE_NAME);
Header::$contentType	=	array("action"=>"1");
Header::$description	=	array("action"=>"1", "content"=>"");
Header::$keywords		=	array("action"=>"1", "content"=>SITE_NAME);
Header::$google			=	array("action"=>"1");
Header::$robots			=	array("action"=>"1", "content"=>"noindex");//robots.txt
Header::$add			=	array("action"=>"1", "content"=>"<style>

</style>".CSS_PATH.JQUERY_FILE."");


?><body class="AdminHome">

<?php 
include 'header.php'; 


?>
<div class="Content">
<div align="left"  style="padding:40px;">


<?php 
include 'left_tab_menu.php'; 
?>




<div class="TabConts">
<div style="margin-top:30px;"></div>


<div align="center">
<img src="<?php echo  MainFunc::GetProfilePic($ProfileId);?>" style="width:100px;height:100px;border-radius:100%;" alt="Image" align="absmiddle">
<br>
<div class="AdPageTitle"><?php echo MainFunc::GetName($ProfileId,3);?>


<div style="margin-top:5px;">
<?php 
if(MainFunc::UserGender($ProfileId)==1)  
echo '<i class="fa fa-male EditGender SaveGender_ajax EditGenderActive"></i>';
else
echo '<i class="fa fa-female EditGender SaveGender_ajax EditGenderActive"></i>';
?>
</div>

</div>
</div>



<div align="center" style="margin-top:30px;">
<a href="<?php echo SITE_URL;?>appointments/?id=<?php echo $ProfileId;?>" class="BoxClicks" style="background-color:#FF3366;">Appointments</a>
<a href="<?php echo SITE_URL;?>logs/?id=<?php echo $ProfileId;?>" class="BoxClicks" style="background-color:#009933;">Logs</a>
<?php if(MainFunc::CheckUserDoctor($ProfileId)){?>
<a href="<?php echo SITE_URL;?>leaves/?id=<?php echo $ProfileId;?>" class="BoxClicks" style="background-color:#0066FF;">Leaves</a>
<a href="<?php echo SITE_URL;?>symptoms/?id=<?php echo $ProfileId;?>" class="BoxClicks" style="background-color:#990000;">Symptoms</a>

<?php
if(MainFunc::GetDoctorsTable($ProfileId,"doc_file"))
{
?>
<br><br><a href="<?php echo SITE_URL;?>storage_docere/files/<?php echo MainFunc::GetDoctorsTable($ProfileId,"doc_file");?>" class="BoxClicks" style="background-color:#990000;">Download Data</a>
<?php
}
?>


<?php
}
?>
</div>






<div style="line-height:25px;margin-top:30px;font-size:14px;">

<br><div class="leftTabb">Time:</div> <div class="RightTabb"><?php echo MainFunc::timeS(MainFunc::GetUsersTable($ProfileId,"utime"),0);?></div>
<br><div class="leftTabb">Date:</div> <div class="RightTabb"><?php echo MainFunc::GetUsersTable($ProfileId,"udate");?></div>
<br><div class="leftTabb">IP:</div> <div class="RightTabb"><?php echo MainFunc::GetUsersTable($ProfileId,"uip");?></div>
<br><div class="leftTabb">Broswer:</div> <div class="RightTabb"><?php echo MainFunc::GetUsersTable($ProfileId,"ubra");?></div>
<br><div class="leftTabb">Type:</div> <div class="RightTabb"><?php echo MainFunc::GetUsersTable($ProfileId,"utype");?></div>
<br><div class="leftTabb">Email ID:</div> <div class="RightTabb"><?php echo MainFunc::GetUsersTable($ProfileId,"login_id");?></div>
<br><div class="leftTabb">Location:</div> <div class="RightTabb"><?php echo MainFunc::GetUsersTable($ProfileId,"ulocation");?></div>

<?php if(MainFunc::CheckUserDoctor($ProfileId)){?>
<br><br><br><div class="leftTabb">Degree:</div> <div class="RightTabb"><?php echo MainFunc::GetDoctorsTable($ProfileId,"doc_degree");?></div>
<br><div class="leftTabb">Consultation Fee:</div> <div class="RightTabb"><?php echo MainFunc::GetDoctorsTable($ProfileId,"doc_fee");?></div>
<br><div class="leftTabb">Specialities:</div> <div class="RightTabb"><?php echo MainFunc::GetDoctorsTable($ProfileId,"doc_type");?></div>
<br><div class="leftTabb">Services Offered:</div> <div class="RightTabb"><?php echo str_replace("\n","<br>", MainFunc::GetDoctorsTable($ProfileId,"doc_services"));?></div>
<br><div class="leftTabb">Memberships:</div> <div class="RightTabb"><?php echo str_replace("\n","<br>", MainFunc::GetDoctorsTable($ProfileId,"doc_member"));?></div>
<br><div class="leftTabb">About:</div> <div class="RightTabb"><?php echo str_replace("\n","<br>", MainFunc::GetDoctorsTable($ProfileId,"doc_about"));?></div>
<?php
}
?>


</div>






<br><br><br><br><br><br><br>



</div>

</div></div></body>