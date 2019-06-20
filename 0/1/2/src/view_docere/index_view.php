<?php
/* 
 * 
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

<div class="Content">
<div align="center">


<div style="width:850px; display:inline-block;vertical-align:top; margin-top:-38px;position:relative;z-index:5;">


<div style="text-align:left;color:#FFFFFF;font-size:15px;text-transform:uppercase;">
<div class="show_category_ajax activeMenu" style="display:inline-block;vertical-align:top;padding:10px 30px 10px 30px;cursor:pointer;">Category</div>
<div class="show_search_ajax" style="display:inline-block;vertical-align:top;padding:10px 30px 10px 30px;cursor:pointer;">Search Doctors</div>
<div class="show_search_box_ajax" style="display:inline-block;vertical-align:top;padding:10px 30px 10px 30px;cursor:pointer;">Find Doctors</div>
</div>

<div class="SearchBox" style="height:auto; border-top:none;text-align:left;padding:10px;text-align:left;background-color:#FBFBFB;">
<?php




$get_doc_sym = dbTKV::SQLQUERY("SELECT D.*,U.* FROM  doctors D,users U 	WHERE 	U.uact='1' AND U.uid=D.doc_uid GROUP BY D.doc_type ");
	while($sym_row  = dbTKV::SQL_FETCH($get_doc_sym))
	{
	echo '<div class="Special SpecialitiesDoctors_ajax" title="'.$sym_row['doc_type'].'"><img src="'.SITE_URL.SRC_PATH.'img/specialities/'.strtolower(str_replace(" ","_",$sym_row['doc_type'])).'.png" class="SpecialImg" alt="'.$sym_row['doc_type'].'" align="absmiddle"><br>'.$sym_row['doc_type'].'</div>';

	}


/*

$array	=	array("Cardiologist","Pediatrician","Gynecologist","Neurologist","General Physician","Diabetologist","Chest Specialist","Dentist","General Surgeon","Laparoscopic","Cardiac Surgery","Plastic Surgeon","Orthopedist","Gastroenterologist","Oncologist","Skin Specialist","Psychiatrist","Eye Specialist","ENT","Urologist","Nephrologist","Physiotherapist","Psychologist","Homeopathy","Ayurvedic","Dietitian");

foreach($array as $arr)
echo '<div class="Special SpecialitiesDoctors_ajax" title="'.$arr.'"><img src="'.SITE_URL.SRC_PATH.'img/specialities/'.strtolower(str_replace(" ","_",$arr)).'.png" class="SpecialImg" alt="'.$arr.'" align="absmiddle"><br>'.$arr.'</div>';

*/




?>
</div>
<div class="CategoryBox" style="height:auto; border-top:none;text-align:left;padding:10px;text-align:left;display:none;">
<?php

	$get_doc_sym = dbTKV::SQLQUERY("SELECT S.*,U.* FROM symptoms S,users U WHERE 	U.uact='1' AND U.uid=S.sym_uid   GROUP BY S.sym_items ");
	while($sym_row  = dbTKV::SQL_FETCH($get_doc_sym))
	{
	echo '<label for="'.trim($sym_row['sym_items']).'"><div class="Symptoms"><input class="SymptomsArray" type="checkbox" value="'.trim($sym_row['sym_items']).'" id="'.trim($sym_row['sym_items']).'">'.trim($sym_row['sym_items']).'</div></label>';
	}
?>
<div class="passBut FindSymDoctors_ajax">Find Doctors</div>
</div>






<div class="SearchEnterBox" style="height:auto; border-top:none;text-align:left;padding:10px;text-align:left;display:none;">
<input type="text" id="find_doctors_enterbox" placeholder="Search Doctors" style="font-size:17px;background:;padding:10px;width:100%;border:solid 1px #0066FF;">
</div>








<span class="SmartSearchBox" id="LoadDoctors"></span>





</div><div style=" margin-left:20px; width:300px;margin-top:-38px;position:relative;z-index:5;display:inline-block;vertical-align:top;">


<?php

if(!MainFunc::isSession())
{


?>



<div style="text-align:right;color:#FFFFFF;font-size:15px;text-transform:uppercase;">
<div class="showSignup_ajax" style="display:inline-block;vertical-align:top;padding:10px 30px 10px 30px;cursor:pointer;">Registration</div>
<div class="showLogin_ajax activeMenu" style="display:inline-block;vertical-align:top;padding:10px 30px 10px 30px;cursor:pointer;">Login</div>

</div>

<div style="height:auto; text-align:left;padding:10px;text-align:left;background-color:#FBFBFB;">
<div style="padding:10px;line-height:45px;text-align:center;">

<span class="ActionBox Login_ajax"><div class="error lerror">Enter your Email</div>
<input type="text" placeholder="Email" id="login_email" style="width:100%;border-radius:100px;padding:10px;font-size:14px;background-color:#D6D6D6;"><br>
<input type="password" placeholder="Password" id="login_pwd" style="width:100%;border-radius:100px;padding:10px;font-size:14px;background-color:#D6D6D6;"><br>
<div class="LoginBut login_ajax">LogIn</div><div class="showRecover_ajax" style="margin-top:10px;font-size:13px;color:#040404;cursor:pointer;">Recover my password?</div></span>

<span class="ActionBox Signup_ajax" style="display:none;"><div class="error serror"></div>
<input type="text" value="Thomas" placeholder="First name" id="sfname" style="width:100%;border-radius:100px;padding:10px;font-size:14px;background-color:#D6D6D6;"><br>
<input type="text" value="Holo" placeholder="Last name" id="slname" style="width:100%;border-radius:100px;padding:10px;font-size:14px;background-color:#D6D6D6;"><br>
<input type="text" value="a@gmail.com" placeholder="Email" onKeyDown="itemKeyDown2(this)" id="semail" style="width:100%;border-radius:100px;padding:10px;font-size:14px;background-color:#D6D6D6;"><br>
<input type="password" value="1234567890" placeholder="Password" id="spwd" style="width:100%;border-radius:100px;padding:10px;font-size:14px;background-color:#D6D6D6;"><br>
<select id="stype" style="width:100%;border-radius:100px;padding:10px;font-size:14px;background-color:#D6D6D6;">
<option disabled selected>Select your profile</option>
<option>Patient</option>
<option>Doctor</option>
</select>

<script>
function itemKeyDown2(e) {
var email = $("#semail").val(),reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
if (reg.test(email) == false) 
$(".serror").show().html("Invalid email address");
else
$(".serror").hide();
}

</script>








<span class="doc_file" style="display:none;">
<div style="font-weight:bold;">Select your pdf/doc file</div>
<input type="file" id="doc_file" style="width:100%;border-radius:100px;padding:10px;font-size:14px;background-color:#D6D6D6;">
</span>




<input type="text" value="9944558890" maxlength="10" placeholder="Phone Number" id="phnumb" style="width:100%;border-radius:100px;padding:10px;font-size:14px;background-color:#D6D6D6;">
<span class="sage" style="display:none;"><br><input type="text" maxlength="2" value="25" placeholder="Age" id="age" style="width:100%;border-radius:100px;padding:10px;font-size:14px;background-color:#D6D6D6;"></span>
<div class="LoginBut signup_ajax">SignUp</div></span>

<span class="ActionBox Recover_ajax" style="display:none;">
<div class="error perror"></div><span id="UpdatePasswordCode"><input type="text" placeholder="Enter your email" id="emailpassword" style="width:100%;border-radius:100px;padding:10px;font-size:14px;background-color:#D6D6D6;"><br><div class="LoginBut password_ajax">Update</div></span>
</span>

</div>

<div  style="font-size:15px;text-align:justify;line-height:22px;margin-top:20px;">Docere is a smart web application, that provides a registration and login for both doctors and patients. The patients can give the problem to find the doctor in different location.</div>
</div>

<?php 
}
?>
</div>












<div class="Bottom" style="font-size:12px;font-weight:normal;color:#000000;">&copy; <?php echo date("Y");?> <?php echo SITE_NAME;?>, Made with by <a target="_blank" href="<?php echo SITE_URL_PRODUCT;?>" style="color:#000000;">TKVSOFT</a></div>





</div>
</div>
</body>