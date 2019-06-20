<div class="ProfileBox">
<!--<i class="fa fa-cog proEdit" title="Edit Settings"></i>-->
<div align="center" style="padding:20px;"><img class="ShowProfileImage_ajax PhotoUpload_Ajax" src="<?php echo  MainFunc::GetProfilePic($_SESSION['USER_ID']);?>" style="width:120px;height:120px;border-radius:100%;cursor:pointer;" alt="..." align="absmiddle">
<div align="center" class="ShowProfileName_ajax" style="font-size:22px;color:#000033;font-weight:500;padding-top:15px;"><?php echo MainFunc::GetName($_SESSION['USER_ID'],3);?></div>




<div class="ShowProfileAbout_ajax" style="margin-top:30px;text-align:center;">
<?php
if(!MainFunc::CheckUserDoctor($_SESSION['USER_ID']))
{
?>
<form method="post" action="<?php echo SITE_URL;?>profile_save/" enctype="multipart/form-data">
<input class="passInput" type="text" placeholder="First Name" name="doc_fname" value="<?php echo MainFunc::GetName($_SESSION['USER_ID'],1);?>"><br>
<input class="passInput" type="text" placeholder="Last Name" name="doc_lname" value="<?php echo MainFunc::GetName($_SESSION['USER_ID'],2);?>"><br>
<input class="passInput" type="text" placeholder="Location" name="doc_location" value="<?php echo MainFunc::GetUsersTable($_SESSION['USER_ID'],"ulocation");?>"><br>
<input type="file" name="doc_upload_image" id="PhotoUpload_Ajax" />

<i class="fa fa-male EditGender SaveGender_ajax <?php if(MainFunc::UserGender($_SESSION['USER_ID'])==1)  echo 'EditGenderActive';?>" action="1"></i>
<i class="fa fa-female EditGender SaveGender_ajax <?php if(MainFunc::UserGender($_SESSION['USER_ID'])==2)  echo 'EditGenderActive';?>" action="2"></i>
<input type="hidden" value="1" name="patient">
<input type="submit" id="SaveProfileDoctor_ajax" style="display:none;" >
</form>


<br>
<div class="passBut SaveProfileDoctor_ajax">Save Profile</div>





<?php
}
else
{
?>
<form method="post" action="<?php echo SITE_URL;?>profile_save/"  enctype="multipart/form-data">
<input type="file" name="doc_upload_image" id="PhotoUpload_Ajax" />
<input class="passInput" type="text" placeholder="First Name" name="doc_fname" value="<?php echo MainFunc::GetName($_SESSION['USER_ID'],1);?>"><br>
<input class="passInput" type="text" placeholder="Last Name" name="doc_lname" value="<?php echo MainFunc::GetName($_SESSION['USER_ID'],2);?>"><br>
<input class="passInput" type="text" placeholder="Degree" name="doc_degree" value="<?php echo MainFunc::GetDoctorsTable($_SESSION['USER_ID'],"doc_degree");?>"><br>
<input class="passInput" type="text" placeholder="Consultation Fee" maxlength="5" name="doc_fee" value="<?php echo MainFunc::GetDoctorsTable($_SESSION['USER_ID'],"doc_fee");?>"><br><?php

$array	=	array("Cardiologist","Pediatrician","Gynecologist","Neurologist","General Physician","Diabetologist","Chest Specialist","Dentist","General Surgeon","Laparoscopic","Cardiac Surgery","Plastic Surgeon","Orthopedist","Gastroenterologist","Oncologist","Skin Specialist","Psychiatrist","Eye Specialist","ENT","Urologist","Nephrologist","Physiotherapist","Psychologist","Homeopathy","Ayurvedic","Dietitian");

echo '<select class="passInput" name="doc_type">';
foreach($array as $arr)
echo '<option value="'.$arr.'" '.(MainFunc::GetDoctorsTable($_SESSION['USER_ID'],"doc_type")==$arr? 'selected':'').'>'.$arr.'</option>';
echo '</select>';

?>
<input class="passInput" type="text" placeholder="Location" name="doc_location" value="<?php echo MainFunc::GetUsersTable($_SESSION['USER_ID'],"ulocation");?>"><br>
<textarea class="passInput" name="doc_services" placeholder="Services Offered"><?php echo MainFunc::GetDoctorsTable($_SESSION['USER_ID'],"doc_services");?></textarea><br>
<textarea class="passInput" name="doc_member" placeholder="Memberships"><?php echo MainFunc::GetDoctorsTable($_SESSION['USER_ID'],"doc_member");?></textarea><br>
<textarea class="passInput" name="doc_about" placeholder="About"><?php echo MainFunc::GetDoctorsTable($_SESSION['USER_ID'],"doc_about");?></textarea><br>



<i class="fa fa-male EditGender SaveGender_ajax <?php if(MainFunc::UserGender($_SESSION['USER_ID'])==1)  echo 'EditGenderActive';?>" action="1"></i>
<i class="fa fa-female EditGender SaveGender_ajax <?php if(MainFunc::UserGender($_SESSION['USER_ID'])==2)  echo 'EditGenderActive';?>" action="2"></i>


<div style="font-size:20px;font-weight:700;color:#003399;margin:30px 0px 15px 0px;text-align:left;">Symptoms</div>


<?php
	$get_doc_sym = dbTKV::SQLQUERY("SELECT * FROM symptoms WHERE sym_uid='".$_SESSION['USER_ID']."'  ORDER BY symid DESC");
	$symdata='';
	$symdataArray=array();
	$symdataIdArray=array();
	while($sym_row  = dbTKV::SQL_FETCH($get_doc_sym))
	{
	$symdataIdArray[]=$sym_row['symid'];
	$symdataArray[]=$sym_row['sym_items'];
	$symdata .= ''.$sym_row['sym_items'].',';
	}
	
	echo '<textarea class="passInput" name="doc_symptoms" placeholder="Add Symptoms">'.rtrim($symdata,',').'</textarea><br>';
	
?>
<div align="left"><ol type="1"><?php

	foreach($symdataArray as $symdataRow => $name){
	echo  '<li class="timeTableRow"><strong>'.$name.'</strong> <div class="TimeDelete SymRemove_ajax" sid="'.$symdataIdArray[$symdataRow].'">Remove</div></li>';
	}
?></ol></div>

<input type="submit" id="SaveProfileDoctor_ajax" style="display:none;" >
<input type="hidden" value="2" name="patient">

</form>
<br>

<div class="passBut SaveProfileDoctor_ajax">Save Profile</div>



<form method="post" action="<?php echo SITE_URL;?>profile_save/">
<div class="TimeTable" align="left">
<div style="font-size:20px;font-weight:700;color:#003399;margin-bottom:15px;">Timing</div>
<div style="display:inline-block;vertical-align:middle;">
<?php
$days = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');


for($i=1;$i<8;$i++)
{
$weeks	=	date("l",mktime(0,0,0,3,28,2009)+$i * (3600*24));
echo '<div class="labelTime"><label for="'.$weeks.'"><input type="checkbox" name="doc_week[]" value="'.$weeks.'" id="'.$weeks.'"> '.$weeks.'</label></div>'; 
}
?>
</div><div style="display:inline-block;vertical-align:middle;float:right;"><div class="strong">From</div>
<select name="f_hh"><?php 
for($hh=1;$hh<=9;$hh++)echo '<option>0'.$hh.'</option>';
for($hh=10;$hh<=12;$hh++)echo '<option>'.$hh.'</option>';

?></select>
<select name="f_mm"><?php 
for($dd=0;$dd<=9;$dd++)echo '<option>0'.$dd.'</option>';
for($dd=10;$dd<=60;$dd++)echo '<option>'.$dd.'</option>';
?></select>
<select name="f_time"><option>AM</option><option>PM</option></select><br>

<div class="strong">To</div>
<select name="t_hh"><?php 
for($hh=1;$hh<=9;$hh++)echo '<option>0'.$hh.'</option>';
for($hh=10;$hh<=12;$hh++)echo '<option>'.$hh.'</option>';

?></select>
<select name="t_mm"><?php 
for($dd=0;$dd<=9;$dd++)echo '<option>0'.$dd.'</option>';
for($dd=10;$dd<=60;$dd++)echo '<option>'.$dd.'</option>';
?></select>
<select name="t_time"><option>AM</option><option>PM</option></select><br>


<input class="passInput" type="text" placeholder="Limit" name="doc_limit" value="0" maxlength="3" style="width:50px;margin-top:10px;">
</div><br><br>
<div class="passBut SaveProfileTimeDoctor_ajax">Add Time</div>
</div>

<input type="hidden" value="2" name="doc_time">
<input type="submit" id="SaveProfileTimeDoctor_ajax" style="display:none;" >
</form>

<br>

<div align="left"><ol type="1">
<?php
	$get_doc_time = dbTKV::SQLQUERY("SELECT * FROM timetable WHERE tmt_uid='".$_SESSION['USER_ID']."' ORDER BY tmtid DESC ");
	while($time_row  = dbTKV::SQL_FETCH($get_doc_time))
	{
	echo  '<li class="timeTableRow"><strong>'.$time_row['tmt_week'].'</strong><br>'.$time_row['tmt_fhh'].':'.$time_row['tmt_fmm'].''.$time_row['tmt_ftime'].' - '.$time_row['tmt_thh'].':'.$time_row['tmt_tmm'].''.$time_row['tmt_totime'].'<br>Limit: '.$time_row['tmt_limit'].' <div class="TimeDelete TimeRemove_ajax" tid="'.$time_row['tmtid'].'">Remove</div></li>';
	}
		
?></ol>
</div>







<form method="post" action="<?php echo SITE_URL;?>profile_save/">
<div class="TimeTable" align="center">
<div style="font-size:20px;font-weight:700;color:#003399;margin-bottom:15px;">Leaves</div>
<select name="lmonth"><?php 

for($m=1; $m<=12; $m++){
     $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
     echo '<option '.(date('F')==$month? 'selected':'').'>'.$month.'</option>';
}?></select>
<select name="ldays"><?php 
for($hh=1;$hh<=9;$hh++)echo '<option '.(date('d')==$hh? 'selected':'').'>0'.$hh.'</option>';
for($hh=10;$hh<=31;$hh++)echo '<option '.(date('d')==$hh? 'selected':'').'>'.$hh.'</option>';

?></select>
<select name="lyear"><?php 
for($dd=date('Y');$dd<=2020;$dd++)echo '<option '.(date('Y')==$dd? 'selected':'').'>'.$dd.'</option>';
?></select>

<br><br>
<div class="passBut SaveProfileLeaveDoctor_ajax">Add Leave</div>
</div>

<input type="hidden" value="1" name="leaves">
<input type="submit" id="SaveProfileLeaveDoctor_ajax" style="display:none;" >
</form>

<br>
<div align="left"><ol type="1">
<?php
	$get_doc_time = dbTKV::SQLQUERY("SELECT * FROM leaves WHERE lea_did='".$_SESSION['USER_ID']."' ORDER BY leaid DESC ");
	while($time_row  = dbTKV::SQL_FETCH($get_doc_time))
	{
	echo  '<li class="timeTableRow"><strong>'.$time_row['lea_day'].'-'.$time_row['lea_month'].'-'.$time_row['lea_year'].'</strong>  <div class="TimeDelete LeaveRemove_ajax" tid="'.$time_row['leaid'].'">Remove</div></li>';
	}
		
?></ol>
</div>










<?php
}
?>




<!--<div class="proDet"><i class="fa fa-<?php if(MainFunc::UserGender($_SESSION['USER_ID'])==1)  echo 'male'; else echo 'female';?> proGender"></i></div>
<div class="proDet"><i class="fa fa-map-marker"></i> <?php echo MainFunc::GetUsersTable($_SESSION['USER_ID'],"ulocation");?></div>
-->
</div>




<div style="margin-top:50px;text-align:left;">
<div style="font-size:16px;font-weight:bold;margin-bottom:15px;color:#000033;">Change Password</div>
<div style="margin-top:10px;">
<form method="post" action="<?php echo SITE_URL;?>password/">
<input class="passInput" type="password" placeholder="Old password" name="opwd"><br>
<input class="passInput" type="password" placeholder="New password" name="npwd">
<input type="submit" id="PasswordChange_ajax" style="display:none;" >
</form>

<div class="passBut PasswordChange_ajax">Update</div>
</div></div>






<div class="BottomProfile">&copy; <?php echo date("Y");?> <?php echo SITE_NAME;?>, Made with by <a target="_blank" href="<?php echo SITE_URL_PRODUCT;?>">TKVSOFT</a></div>
</div></div>