<?php
/* 
 * Thank Jesus 
 * @Souce-code	TKV
 */
 

Header::$action			=	"enable";
Header::$title			=	array("action"=>"1", "content"=>"Welcome to Online doctor appointment | ".SITE_NAME);
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

<script>
$(function(){
$(".LoadAppointments_ajax,.LoadNotifications_ajax").trigger("click");
});
</script>
<i class="LoadNotifications_ajax"></i>

<div class="Content">
<div align="center">






<div class="DoctorsBox NotificationsBox" style="display:;max-height:800px;overflow-x:hidden;overflow-y:auto;background-color:#0033FF;"><div class="SpecialitiesBoxTitle">Notifications</div><span id="LoadNotifications"></span></div>














</div>
</div>
</body>