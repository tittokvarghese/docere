<?php
/* 
 * Thank Jesus 
 * @Souce-code	TKV
 */

$pageTitle="dashboard";

Header::$action			=	"enable";
Header::$title			=	array("action"=>"1", "content"=>"Dashboard | ADMIN CP - ".SITE_NAME);
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
<div class="TabConts"><div class="AdPageTitle">Dashboard</div>
<div style="margin-top:50px;"></div>
<div style="word-spacing:-10px;">
<a href="<?php echo SITE_URL;?>users/"><div class="dashCircle" style="background-color:#0066FF;color:#FFFFFF;border-color:#003399;"><div class="num">
<?php echo MainFunc::GetTableRow("users");?></div><div class="text">Users</div></div></a>

<a href="<?php echo SITE_URL;?>appointments/"><div class="dashCircle" style="background-color:#CC9900;color:#FFFFFF;border-color:#CC0000;"><div class="num">
<?php echo MainFunc::GetTableRow("appointments");?></div><div class="text">Appointments</div></div></a>

<a href="<?php echo SITE_URL;?>leaves/"><div class="dashCircle" style="background-color:#999966;color:#FFFFFF;border-color:#990066;"><div class="num">
<?php echo MainFunc::GetTableRow("leaves");?></div><div class="text">Leaves</div></div></a>

<a href="<?php echo SITE_URL;?>logs/"><div class="dashCircle" style="background-color:#FF3333;color:#FFFFFF;border-color:#CC0066;"><div class="num">
<?php echo MainFunc::GetTableRow("login_logs");?></div><div class="text">Logs</div></div></a>

<a href="<?php echo SITE_URL;?>symptoms/"><div class="dashCircle" style="background-color:#00CC33;color:#FFFFFF;border-color:#006633;"><div class="num">
<?php echo MainFunc::GetTableRow("symptoms");?></div><div class="text">Symptoms</div></div></a>

<div class="dashCircle" style="background-color:#00FF33;color:#FFFFFF;border-color:#666666;"><div class="num">
<?php echo MainFunc::GetTableRow("notifications");?></div><div class="text">Notifications</div></div>
</div>

</div>











</div>
</div>
</body>