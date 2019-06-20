<div class="Header1" style="background-color:#003366;height:190px;">
<div class="HeaderBody1">




<div class="HeaderBody1" style="position:absolute;text-transform:uppercase;"><div align="center">


<?php


if(MainFunc::isSession())
{


	if(MainFunc::CheckActiveUser($_SESSION['USER_ID']))
	{
		if(!MainFunc::CheckUserAdmin($_SESSION['USER_ID']))
		{
			if(MainFunc::CheckUserDoctor($_SESSION['USER_ID']))
			{
				echo '<div style="float:left;text-align:left;color:#FFFFFF;padding:15px;margin-left:60px;">
				<a style="color:#FFFFFF;" href="'.SITE_URL.'patient_appointments/">Appointments</a> 
				'.(MainFunc::GetAppointmentsDoctors() ? '('.MainFunc::GetAppointmentsDoctors().')' : '').'
				</div>';
			}
			else
			{
				echo '<div style="float:left;text-align:left;color:#FFFFFF;padding:15px;margin-left:60px;">
				<a style="color:#FFFFFF;"  href="'.SITE_URL.'my-appointments/">Appointments</a> '.(MainFunc::GetAppointments() ? '('.MainFunc::GetAppointments().')' : '').'
				| <a style="color:#FFFFFF;"  href="'.SITE_URL.'my-notifications/">Notifications</a> '.(MainFunc::GetNotifications() ? '('.MainFunc::GetNotifications().')' : '').'
				</div>';
			}
		}
		else
		{
			echo '<div style="float:left;text-align:left;color:#FFFFFF;padding:15px;margin-left:60px;">Welcome ADMIN</div>';
		}
	}


echo '
<div style="float:right;text-align:left;color:#FFFFFF;padding:15px;margin-right:60px;">

'.(MainFunc::CheckUserDoctor($_SESSION['USER_ID']) ? '<a href="'.SITE_URL.'profiles/?id='.$_SESSION['USER_ID'].'" style="color:#fff;">Dr.'.MainFunc::GetName($_SESSION['USER_ID'],3).'</a>' : 

(!MainFunc::CheckUserAdmin($_SESSION['USER_ID']) ? 
'<a href="'.SITE_URL.'patient/?id='.$_SESSION['USER_ID'].'" style="color:#fff;">'.MainFunc::GetName($_SESSION['USER_ID'],3).'</a>'
: MainFunc::GetName($_SESSION['USER_ID'],3))




).' 




| <a style="color:#FFFFFF;"  href="'.SITE_URL.'edit/">Edit Profile</a> | <a style="color:#FFFFFF;"  href="'.SITE_URL.'logout/">LogOut</a></div>';
}

?>




</div></div>








<div align="center" style="font-size:18px;padding:40px;" >
<a href="<?php echo SITE_URL;?>" style="color:#FFFFFF;"><img src="<?php echo SITE_URL.SRC_PATH;?>img/logo.png"  style="width:300px;" alt="..." align="absmiddle">
</a>
</div>


</div>
</div>