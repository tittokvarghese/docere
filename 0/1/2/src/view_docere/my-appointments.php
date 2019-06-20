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
	
	
if(MainFunc::CheckUserDoctor($_SESSION['USER_ID']))
{
header("Location:  ".SITE_URL."");
exit;
}		
	
	
Header::$action			=	"enable";
Header::$title			=	array("action"=>"1", "content"=>"My Appointments | ".SITE_NAME);
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
<div align="left"  style="padding:70px;">

<div class="SpecialitiesBox AppointmentsBox" style="display:;"><div class="SpecialitiesBoxTitle">Appointments<span style="float:right;"><div class="appTab LoadAppointments_ajax" id="latest">Latest</div><div class="appTab LoadAppointments_ajax" id="old">Old</div></span></div><span id="LoadAppointments"></span></div>


<i class="LoadAppointments_ajax" id="latest"></i>


</div>
</div>
</body>