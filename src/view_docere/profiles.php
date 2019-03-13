<?php
/* 
 * Thank Jesus 
 * @Souce-code	TKV
 */
 
if(isset($_GET['id']))
{
	$ProfileId=MainFunc::Encrypt(MainFunc::filter($_GET['id']));
}
	
	
Header::$action			=	"enable";
Header::$title			=	array("action"=>"1", "content"=>"Profile | ".SITE_NAME);
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
<div align="left"  style="padding:70px;">



<div align="left" style="display:inline-block;vertical-align:top;margin-top:50px;">
<img src="<?php echo  MainFunc::GetProfilePic($ProfileId);?>" style="width:150px;height:150px;border-radius:100%;" alt="Image" align="absmiddle">
</div><div align="left" style="padding:10px;display:inline-block;vertical-align:top;background-color:#;width:650px;margin-left:20px;">

<span style="font-size:25px;"><?php echo MainFunc::GetName($ProfileId,3);?></span>
<span style="font-size:15px;vertical-align:baseline;margin-left:10px;"><?php echo MainFunc::GetDoctorsTable($ProfileId,"doc_degree");?></span>

<div style="font-size:14px;vertical-align:middle;">
<br><strong>Specialities:</strong> <?php echo MainFunc::GetDoctorsTable($ProfileId,"doc_type");?>
<br><br><strong>Services Offered:</strong><br><?php echo str_replace("\n","<br>", MainFunc::GetDoctorsTable($ProfileId,"doc_services"));?>
<br><br><strong>Memberships:</strong><br><?php echo str_replace("\n","<br>", MainFunc::GetDoctorsTable($ProfileId,"doc_member"));?>
<br><br><strong>About:</strong><br><?php echo str_replace("\n","<br>", MainFunc::GetDoctorsTable($ProfileId,"doc_about"));?>
</div>

</div><div align="center" style="padding:10px;display:inline-block;vertical-align:top; border:solid 1px #999999;width:300px;margin-left:20px;">


<div style=" border: solid 1px #999999; padding:10px;font-size:18px;text-transform:uppercase;border-radius:5px;display:inline-block;cursor:pointer;">
GET APPOINTMENT
</div>





</div>























</div>
</div>
</body>