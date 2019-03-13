<div class="Header"><div class="HeaderBody"><div class="Logo"><a href="<?php echo SITE_URL;?>">
<img src="<?php echo SITE_URL.SRC_PATH;?>img/logo1.png" class="ImgLogoLove" alt="..." align="absmiddle">
<img src="<?php echo SITE_URL.SRC_PATH;?>img/logo3.png" class="ImgLogoLove" alt="..." align="absmiddle">
</a></div>
<div class="LogoR">



<?php 
if(!MainFunc::CheckUserAdmin($_SESSION['USER_ID']))
{
?><i class="fa fa-calendar-check ViewAppointments LoadAppointments_ajax" id="<?php if(MainFunc::CheckUserDoctor($_SESSION['USER_ID'])) echo 'new'; else echo 'latest';?>"><?php 
if(MainFunc::CheckUserDoctor($_SESSION['USER_ID']))
{
if(MainFunc::GetAppointmentsDoctors())echo '<span class="cnts">'.MainFunc::GetAppointmentsDoctors().'</span>';
}
else
{
if(MainFunc::GetAppointments())echo '<span class="cnts">'.MainFunc::GetAppointments().'</span>';
}
?></i>
<i class="fa fa-flag ViewAppointments LoadNotifications_ajax"><?php if(MainFunc::GetNotifications())echo '<span class="cnts">'.MainFunc::GetNotifications().'</span>';?></i>
<?php
}
?>




<a href="<?php echo SITE_URL;?>"><span class="RMenu">
<img src="<?php echo  MainFunc::GetProfilePic($_SESSION['USER_ID']);?>" style="width:40px;height:40px;border-radius:100%;" alt="Image" align="absmiddle">
<?php echo MainFunc::GetName($_SESSION['USER_ID'],1);?></span></a>
<a href="<?php echo SITE_URL;?>logout/"><span class="RMenu">LogOut</span></a>
</div>

</div></div>



<?php 
if(MainFunc::CheckUserAdmin($_SESSION['USER_ID']))
echo '<div class="msKAdminHome">';
else
echo '<div class="msK mtkv msKHome">';


?>
<div class="Content">

<?php if(isset($_GET['updated'])){?>
<div style="padding:15px;background-color:#FFFF33;font-size:18px;font-weight:700;position:relative;z-index:2;border-radius:3px;">Password Updated</div>
<?php } ?>




<?php if(MainFunc::CheckUserDoctor($_SESSION['USER_ID'])){?>

<?php } else { ?>
<div class="SpecialitiesBox AppointmentsBox" style="display:none;"><div class="SpecialitiesBoxTitle">Appointments<span style="float:right;"><div class="appTab LoadAppointments_ajax" id="latest">Latest</div><div class="appTab LoadAppointments_ajax" id="old">Old</div></span></div><span id="LoadAppointments"></span></div>
<?php } ?>

