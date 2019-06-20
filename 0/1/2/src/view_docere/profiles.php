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
else
{
header("Location:  ".SITE_URL."");
exit;
}
	
	
if(!MainFunc::CheckUserDoctor($ProfileId))
{
header("Location:  ".SITE_URL."");
exit;
}	
if(!MainFunc::CheckActiveUser($_SESSION['USER_ID']))
{
header("Location:  ".SITE_URL."");
exit;
}	

/*if(MainFunc::CheckUserDoctor($_SESSION['USER_ID']))
{
header("Location:  ".SITE_URL."");
exit;
}	
	*/
		
if(!MainFunc::CheckActiveUser($ProfileId))
{
header("Location:  ".SITE_URL."");
exit;
}	
	
	
	
	
	
Header::$action			=	"enable";
Header::$title			=	array("action"=>"1", "content"=>(MainFunc::CheckUserDoctor($ProfileId) ? 'Dr.' : '').MainFunc::GetName($ProfileId,3)." | ".SITE_NAME);
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
<div align="left"  style="padding:70px;padding-top:20px;">


<?php


if(isset($_GET['token']))
{


$day   = MainFunc::Encrypt(MainFunc::filter($_GET['day']));
$month = MainFunc::Encrypt(MainFunc::filter($_GET['month']));
$year  = MainFunc::Encrypt(MainFunc::filter($_GET['year']));





$myQueryToken = dbTKV::SQLQUERY("SELECT * FROM appointments   WHERE  apts_did='".$ProfileId."'	
 AND apts_day='".$day."' AND apts_month='".$month."'	AND apts_year='".$year."' 		");

$myToken =  dbTKV::SQLNUM_ROWS($myQueryToken);


$rowTok  = dbTKV::SQL_FETCH($myQueryToken);
	//echo $rowTok['apts_week'];

$get_doc_time = dbTKV::SQLQUERY("SELECT * FROM timetable WHERE tmt_uid='".$ProfileId."' AND tmt_week LIKE '%".$rowTok['apts_week']."%' ORDER BY tmtid DESC ");
$time_row  = dbTKV::SQL_FETCH($get_doc_time);
	

	


echo '<div style="border:solid 1px #707070;padding:10px;background-color:#FFFF99;text-align:center;font-size:16px;margin-bottom:20px;font-weight:bold;">';

if($myToken>0)
{
echo 'Your appointment confirmed!<br><br>Token -'.$myToken;
echo '<div class="docDes"><strong><i class="fa fa-clock"></i> '.$time_row['tmt_week'].'</strong><br>'.$time_row['tmt_fhh'].':'.$time_row['tmt_fmm'].''.$time_row['tmt_ftime'].' - '.$time_row['tmt_thh'].':'.$time_row['tmt_tmm'].''.$time_row['tmt_totime'].'</div>';
}
else
echo 'Your appointment rearranged';


echo '</div>';

}

?>




<div align="left" style="display:inline-block;vertical-align:top;margin-top:50px;">
<img src="<?php echo  MainFunc::GetProfilePic($ProfileId);?>" style="width:150px;height:150px;border-radius:100%;" alt="Image" align="absmiddle"><br>


<?php
if(!MainFunc::CheckUserDoctor($_SESSION['USER_ID']))
{


if(isset($_GET['report_done']))
{
?>
<div align="center" style="padding:10px; background-color:#FFFF99;margin-top:20px;color:#000000;"><strong>Thanks for reporting</strong></div>
<?php
}
else
{
?>
<div class="reporting_profile" align="left" style="padding:10px; background-color:#EEEEEE;margin-top:20px;color:#000000;display:none;">
<strong>Why are you reporting?</strong><br>
<form method="post">
<input onClick="$('#reporting_profile_other').hide();" type="radio" name="reporting_profile" id="rep1" checked value="Services not good"><label for="rep1">Services not good</label><br>
<input onClick="$('#reporting_profile_other').hide();" type="radio" name="reporting_profile" id="rep2" value="Late appointments"><label for="rep2">Late appointments</label><br>
<input onClick="$('#reporting_profile_other').hide();" type="radio" name="reporting_profile" id="rep3" value="Costly services"><label for="rep3">Costly services</label><br>
<input onClick="$('#reporting_profile_other').show().focus();" type="radio" name="reporting_profile" id="rep4" value="Other"><label for="rep4">Other</label><br>
<textarea style="padding:10px; border:solid 1px #000;margin-top:5px;display:none;" name="reporting_profile_other" id="reporting_profile_other"></textarea><br>

<input type="hidden" value="<?php echo $ProfileId;?>" name="ProfileId">
<input type="submit" value="Report"  style=" background:none; width:100%;padding:5px;border:solid 1px #666666;text-align:center;margin-top:20px;font-size:15px;cursor:pointer; border-radius:50px;color:#000000;">

</form></div><div onClick="$(this).hide();$('.reporting_profile').show();" style="padding:5px;border:solid 1px #666666;text-align:center;margin-top:20px;font-size:15px;cursor:pointer; border-radius:50px;color:#000000;">Report</div>
<?php
}
}
?>



</div><div align="left" style="padding:10px;display:inline-block;vertical-align:top;background-color:#;width:620px;margin-left:20px;">

<span style="font-size:25px;"><?php 
if(MainFunc::CheckUserDoctor($ProfileId)) echo 'Dr.';		echo MainFunc::GetName($ProfileId,3);?></span>
<span style="font-size:15px;vertical-align:baseline;margin-left:10px;"><?php echo MainFunc::GetDoctorsTable($ProfileId,"doc_degree");?></span>

<div style="font-size:14px;vertical-align:middle;">
<br><strong>Specialities:</strong> <?php echo MainFunc::GetDoctorsTable($ProfileId,"doc_type");?>
<?php
	$qprof	= "SELECT D.*,U.* FROM doctors D,users U  WHERE   U.uid='".$ProfileId."'	AND U.uact='1'	";
	$rowpp  = dbTKV::SQL_FETCH(dbTKV::SQLQUERY($qprof));
	echo '<br><br><strong>Location:</strong> '.$rowpp['ulocation'].'';
	echo '<br><br><strong>Consultation Fees: Rs:</strong> '.$rowpp['doc_fee'].'';
?>
<br><br><strong>Services Offered:</strong><br><?php echo str_replace("\n","<br>", MainFunc::GetDoctorsTable($ProfileId,"doc_services"));?>
<br><br><strong>Memberships:</strong><br><?php echo str_replace("\n","<br>", MainFunc::GetDoctorsTable($ProfileId,"doc_member"));?>
<br><br><strong>About:</strong><br><?php echo str_replace("\n","<br>", MainFunc::GetDoctorsTable($ProfileId,"doc_about"));?>
</div>




<div style="padding:20px;border:solid 1px #999999;text-align:center;margin-top:50px;font-size:20px; font-weight:bold; color:#333333;">
<?php
if(!MainFunc::CheckUserDoctor($_SESSION['USER_ID']))
echo 'Ask to Doctor';
else
echo 'Questions';

?></div>
<a name="answers"></a>


<div style=" margin:20px 0px 20px 0px;">



<?php

	$q_answers	= "SELECT Q.*,U.* FROM questions_data Q,users U  WHERE  Q.qd_to_id='".$ProfileId."'	 AND U.uid=Q.qd_fr_id AND U.uact='1'   
	ORDER BY Q.qd_id DESC ";

	if(!dbTKV::SQLNUM_ROWS(dbTKV::SQLQUERY($q_answers)))
	{
	echo '<div style="text-align:center;font-size:16px;color:#666666;font-weight:bold;padding:10px;">No questions</div>';
	}
	else
	{
			
	$query_answers = dbTKV::SQLQUERY("$q_answers LIMIT 20 ");
	while($row_ques  = dbTKV::SQL_FETCH($query_answers))
	{
	
	//$row_ques['apts_day']
	
	
	
	?>

<div style="border:solid 1px #CCCCCC;padding:10px 10px 10px 10px;background-color:#F8F8F8;margin-bottom:15px;border-radius:15px 0px;">
<div style="font-size:16px;color:#666666;font-weight:bold;display:inline-block;vertical-align:top;"><a href="<?php echo SITE_URL;?>patient/?id=<?php echo $row_ques['qd_fr_id'];?>">
<img src="<?php echo  MainFunc::GetProfilePic($row_ques['qd_fr_id']);?>" style="width:35px;height:35px;border-radius:100%;" alt="Image" align="absmiddle"></a></div>
<div style="font-size:14px;color:#666666;display:inline-block;vertical-align:top;width:530px;margin-left:8px;text-align:justify;">
<?php echo str_replace("\n","<br>",$row_ques['qd_text']);?>
</div>

<div align="right" style="font-size:12px;color:#666666;margin:5px;"><?php echo MainFunc::GetName($row_ques['qd_fr_id'],3).' | '.MainFunc::timeS($row_ques['qd_time'],0);?> 

<?php
if($_SESSION['USER_ID']==$row_ques['qd_to_id'])
{
?>
| <strong style="cursor:pointer;color:#000000;text-decoration:underline;" onClick="$('#Reply<?php echo $row_ques['qd_id'];?>').show();$('#answers_text<?php echo $row_ques['qd_id'];?>').focus();">Reply</strong>
<?php
}


if($_SESSION['USER_ID']==$row_ques['qd_fr_id'])
{
?>
| <a href="<?php echo SITE_URL;?>profiles/?delete_ques=<?php echo $row_ques['qd_id'];?>&amp;ProfileId=<?php echo $row_ques['qd_to_id'];?>" onClick="if(confirm('Are you sure you want to remove?')==false){return false;}">Delete</a>
<?php
}
?>

</div>







<?php

	$q_qanswers	= "SELECT Q.*,U.* FROM questions_answers Q,users U  WHERE  
	
	Q.qa_fr_id='".$ProfileId."'	 AND Q.qa_qd_id='".$row_ques['qd_id']."'	 AND
	
	 U.uid=Q.qa_fr_id AND U.uact='1'   ORDER BY Q.qa_id DESC ";

	if(dbTKV::SQLNUM_ROWS(dbTKV::SQLQUERY($q_qanswers)))
	{
		
	$query_qanswers = dbTKV::SQLQUERY("$q_qanswers LIMIT 7 ");
	while($row_quesA  = dbTKV::SQL_FETCH($query_qanswers))
	{
	?>
<div style="border:solid 1px #E1E1E1;padding:10px 10px 10px 10px;background-color:#FAFAFA;margin-bottom:10px;border-radius:0px 15px;margin-left:40px;">
<div style="font-size:16px;color:#666666;font-weight:bold;display:inline-block;vertical-align:top;">
<img src="<?php echo  MainFunc::GetProfilePic($ProfileId);?>" style="width:35px;height:35px;border-radius:100%;" alt="Image" align="absmiddle"></div>
<div style="font-size:14px;color:#003366;display:inline-block;vertical-align:top;width:450px;margin-left:8px;text-align:justify;">
<?php echo str_replace("\n","<br>",$row_quesA['qa_text']);?></div>
<div align="right" style="font-size:11px;color:#666666;margin-top:5px;"><strong>Replied</strong> | <?php echo MainFunc::timeS($row_quesA['qa_time'],0);?>  
<?php

if($_SESSION['USER_ID']==$row_quesA['qa_fr_id'])
{
?>
| <a 
href="<?php echo SITE_URL;?>profiles/?delete_answers=<?php echo $row_quesA['qa_id'];?>&amp;delete_ques_id=<?php echo $row_quesA['qa_qd_id'];?>&amp;ProfileId=<?php echo $row_quesA['qa_to_id'];?>" onClick="if(confirm('Are you sure you want to remove?')==false){return false;}">Delete</a>
<?php

}

?>






</div>
</div>













<?php

	}
	}
	
?>








<form method="post" style="margin-top:10px;display:none;margin-left:40px;" id="Reply<?php echo $row_ques['qd_id'];?>">
<textarea id="answers_text<?php echo $row_ques['qd_id'];?>" name="answers_text" style="padding:10px;border:solid 1px #00CC33;font-size:15px;width:100%;border-radius:0px;border-left:solid 4px #00CC33;"  placeholder="Reply"></textarea>
<input type="hidden" name="ProfileId" value="<?php echo $row_ques['qd_fr_id'];?>">
<input type="hidden" name="QuestId" value="<?php echo $row_ques['qd_id'];?>">
<input type="hidden" name="questions_answers">
<input type="submit" value="REPLY" style=" width:100px;padding:5px;text-align:center;margin-top:0px;font-size:15px;cursor:pointer;
background-color:#00CC33;color:#FFFFFF;">
</form>















</div>
<?php

	}
	}
	
?>









</div>




<?php
if(!MainFunc::CheckUserDoctor($_SESSION['USER_ID']))
{
?>
<form method="post">
<textarea name="questions_text" style="padding:10px;border:solid 1px #666666;font-size:17px;width:100%;border-radius:0px;border-left:solid 4px #0066CC;"  placeholder="Ask a questions"></textarea>
<input type="hidden" name="questions_data"><br>
<input type="hidden" value="<?php echo $ProfileId;?>" name="ProfileId">
<input type="submit" value="SEND" style=" width:100px;padding:8px;text-align:center;margin-top:0px;font-size:15px;cursor:pointer;float:right;
background-color:#003399;color:#FFFFFF;">
</form>
<?php
}
?>






















</div><div align="center" style="padding:10px;display:inline-block;vertical-align:top; width:320px;margin-left:20px;">


<?php
if(!MainFunc::CheckUserDoctor($_SESSION['USER_ID']))
{




$apymC 	= dbTKV::SQLQUERY("SELECT * FROM  appointments  WHERE  
apts_pid='".$_SESSION['USER_ID']."'	AND 	apts_did='".$ProfileId."' AND apts_seen='0' 	"); 
if(dbTKV::SQLNUM_ROWS($apymC))
{
echo '<div style="font-size:15px;margin-top:50px; color:#0033FF;font-weight:bold;">You have taken appointment(s) to this doctor, check out your all <u><a href="'.SITE_URL.'my-appointments/">appointments</a></u>!</div>';

while($row  = dbTKV::SQL_FETCH($apymC))
{
	$myToken =  dbTKV::SQLNUM_ROWS(dbTKV::SQLQUERY("SELECT * FROM appointments   WHERE  apts_did='".$ProfileId."'	
	 AND apts_day='".$row['apts_day']."' 
	 AND apts_month='".$row['apts_month']."'	
	  AND apts_year='".$row['apts_year']."' 		"));
	echo '<div style="padding:10px 0px 0px 0px;font-size:14px;color:#006633;">
	'.$row['apts_day'].'-'.$row['apts_month'].'-'.$row['apts_year'].' <strong>'.$row['apts_week'].' - Token - '.$myToken.'</strong>
	</div>
	
	
	<div class="BookAppointment_ajax" id="'.$ProfileId.'" style=" border: solid 1px #999999; margin-top:20px;padding:10px;font-size:18px;text-transform:uppercase;border-radius:5px;display:inline-block;cursor:pointer;background-color:#FBFBFB;">Change Date</div>
	
	
	
	';

}


}
else
{
?>
<div class="BookAppointment_ajax" id="<?php echo $ProfileId;?>" style=" border: solid 1px #999999; padding:10px;font-size:18px;text-transform:uppercase;border-radius:5px;display:inline-block;cursor:pointer;background-color:#FBFBFB;">GET APPOINTMENT</div>
<?php
}

}

?>
<div style="border:solid 1px #999999;padding-top:40px;margin-top:-20px;display:none;" id="BookAppointment<?php echo $ProfileId;?>"></div>
<?php

echo '<br><br><div align="center" style="padding:10px;line-height:20px;border-top:solid 1px #ccc;"><span style="font-size:15px;font-weight:bold;">Available Time</span><br><br>';
echo self::ShowTime($ProfileId);
echo '</div>';

?>




</div>










</div>
</div>
</body>