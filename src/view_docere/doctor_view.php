<?php
/* 
 * Thank Jesus 
 * @Souce-code	TKV
 */
 

Header::$action			=	"enable";
Header::$title			=	array("action"=>"1", "content"=>SITE_NAME." - Home");
Header::$icon			=	array("action"=>"1");
Header::$author			=	array("action"=>"1", "content"=>SITE_NAME);
Header::$contentType	=	array("action"=>"1");
Header::$description	=	array("action"=>"1", "content"=>"");
Header::$keywords		=	array("action"=>"1", "content"=>SITE_NAME);
Header::$google			=	array("action"=>"1");
Header::$robots			=	array("action"=>"1", "content"=>"noindex");//robots.txt

Header::$add			=	array("action"=>"1", "content"=>"<style>


</style>".CSS_PATH.JQUERY_FILE."");



?><body class="Home">
<?php include 'header.php'; ?>
<script>

$(function(){
$(".LoadAppointments_ajax,.LoadNotifications_ajax").trigger("click");
});
</script>
<div style="display:inline-block;vertical-align:top;">

<div class="DoctorsBox AppointmentsBox" style="display:;"><div class="SpecialitiesBoxTitle">Appointments<span style="float:right;"><div class="appTab LoadAppointments_ajax" id="today">Today</div><div class="appTab LoadAppointments_ajax" id="new">New</div><div class="appTab LoadAppointments_ajax" id="previous">Previous</div></span></div><span id="LoadAppointments"></span></div><br>


<div class="DoctorsBox NotificationsBox" style="display:;max-height:800px;overflow-x:hidden;overflow-y:auto;background-color:#FF9966;"><div class="SpecialitiesBoxTitle">Notifications</div><span id="LoadNotifications"></span></div>


</div>
<?php include 'right_profile.php';?>



<div class="Bottom"></div></div></div></body>