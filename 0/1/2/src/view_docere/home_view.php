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
<?php  include 'header.php'; ?>





<div class="SpecialitiesBox"><div class="SpecialitiesBoxTitle">Specialities</div>
<?php

$array	=	array("Cardiologist","Pediatrician","Gynecologist","Neurologist","General Physician","Diabetologist","Chest Specialist","Dentist","General Surgeon","Laparoscopic","Cardiac Surgery","Plastic Surgeon","Orthopedist","Gastroenterologist","Oncologist","Skin Specialist","Psychiatrist","Eye Specialist","ENT","Urologist","Nephrologist","Physiotherapist","Psychologist","Homeopathy","Ayurvedic","Dietitian");

foreach($array as $arr)
echo '<div class="Special SpecialitiesDoctors_ajax" title="'.$arr.'"><img src="'.SITE_URL.SRC_PATH.'img/specialities/'.strtolower(str_replace(" ","_",$arr)).'.png" class="SpecialImg" alt="'.$arr.'" align="absmiddle"><br>'.$arr.'</div>';


?>
</div>

<div style="display:inline-block;vertical-align:top;width:740px;">

<div class="DoctorsBox NotificationsBox" style="display:none;max-height:400px;overflow-x:hidden;overflow-y:auto;background-color:#FF9966;"><div class="SpecialitiesBoxTitle">Notifications</div><span id="LoadNotifications"></span></div>


<div class="DoctorsBox"><div class="DoctorsBoxTitle">Symptoms</div><span id="LoadDoctors">




<div style="background-color:#FFFFFF;padding:10px;"><?php

	$get_doc_sym = dbTKV::SQLQUERY("SELECT * FROM symptoms GROUP BY sym_items ");
	while($sym_row  = dbTKV::SQL_FETCH($get_doc_sym))
	{
	echo '<label for="'.$sym_row['sym_items'].'"><div class="Symptoms"><input class="SymptomsArray" type="checkbox" value="'.$sym_row['sym_items'].'" id="'.$sym_row['sym_items'].'">'.$sym_row['sym_items'].'</div></label>';
	}
?>
</div>

<div class="passBut FindSymDoctors_ajax">Find Doctors</div>




</span></div>

</div><?php include 'right_profile.php';?>










<div class="Bottom"></div></div></div></body>