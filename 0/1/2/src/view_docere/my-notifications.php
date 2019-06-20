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
Header::$title			=	array("action"=>"1", "content"=>"My Notifications | ".SITE_NAME);
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




<script>
$(function(){
$(".LoadNotifications_ajax").trigger("click");
});
</script>
<i class="LoadNotifications_ajax"></i>






<div class="SpecialitiesBox AppointmentsBox" style="display:;overflow-x:hidden;overflow-y:auto;background-color:#0033FF;"><div class="SpecialitiesBoxTitle">Notifications</div>

<span id="LoadNotifications"></span>
</div>





</div>
</div>
</body>