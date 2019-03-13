<div class="Header1" style="background-color:#003366;height:170px;">
<div class="HeaderBody1">




<div class="HeaderBody1" style="position:absolute;text-transform:uppercase;"><div align="center">


<?php

if(MainFunc::isSession())
{

echo '
<div style="float:left;text-align:left;color:#FFFFFF;padding:15px;margin-left:60px;">

Appointments '.(MainFunc::GetAppointments() ? '('.MainFunc::GetAppointments().')' : '').'
| 
Notifications '.(MainFunc::GetNotifications() ? '('.MainFunc::GetNotifications().')' : '').'
| 
My questions (189)</div>
<div style="float:right;text-align:left;color:#FFFFFF;padding:15px;margin-right:60px;">'.MainFunc::GetName($_SESSION['USER_ID'],3).' | Edit Profile | <a style="color:#FFFFFF;"  href="'.SITE_URL.'logout/">LogOut</a></div>
';
}

?>




</div></div>








<div align="center" style="font-size:18px;padding:40px;" >
<a href="<?php echo SITE_URL;?>" style="color:#FFFFFF;"><img src="<?php echo SITE_URL.SRC_PATH;?>img/logo.png"  style="width:300px;" alt="..." align="absmiddle">
</a>
</div>


</div>
</div>