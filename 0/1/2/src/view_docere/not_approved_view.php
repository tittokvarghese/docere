<?php
/* 
 * Thank Jesus 
 * @Souce-code	TKV
 */




if(isset($_FILES['doc_file']))
{

	$doc_file 	 = $_FILES['doc_file'];
	$newImageName = rand(99999,999999).'_'.time().'_'.rand(time(),999999).'_'.rand(99999,999999).'_n';
	$fullpath	= FILES_SAVE_PATH.$newImageName.'.'; 
	$imageSize 	= $doc_file['size'];
	$tempSrc	= $doc_file['tmp_name']; 
	$imageType	= $doc_file['type']; 
	$fileExt = substr(strrchr($doc_file['name'],'.'),1);



	$allowedfileExtensions = array('docx', 'pdf', 'pptx', 'jpeg','jpg', 'png', 'xls', 'doc');
	if (in_array($fileExt, $allowedfileExtensions))
	{
		move_uploaded_file($tempSrc,$fullpath.$fileExt);
		
		
		
		$doctors 	= dbTKV::SQLQUERY("SELECT * FROM doctors  WHERE  doc_uid='".$_SESSION['USER_ID']."' "); 
		if(!dbTKV::SQLNUM_ROWS($doctors))
		{
			dbTKV::SQLQUERY("INSERT INTO doctors (doc_uid,doc_file)
			VALUES('".$_SESSION['USER_ID']."','".$newImageName.'.'.$fileExt."') ");
		}
		else
		{
				dbTKV::SQLQUERY("UPDATE doctors SET 
				doc_file='".$newImageName.'.'.$fileExt."'				WHERE  doc_uid='".$_SESSION['USER_ID']."' ");	
		}
		
	}
	else
	{
	header('Location: '.SITE_URL.'?error_uploading');
	exit;
	}


	header('Location: '.SITE_URL.'?uploading_done');
	exit;
}








Header::$action			=	"enable";
Header::$title			=	array("action"=>"1", "content"=>"Your account is not approved | ".SITE_NAME);
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


<i class="LoadNotifications_ajax"></i>

<div class="Content">
<div align="center">



<div style="padding:15px;border:solid 1px #CCCCCC;background-color:#FFFF99;margin-top:40px;font-size:16px;font-weight:bold;width:600px;">Your account is not approved!</div>



<div style="padding:20px;border:solid 1px #CCCCCC;background-color:#EBEBEB;margin-top:50px;width:600px;">

<?php
if(MainFunc::CheckUserDoctor($_SESSION['USER_ID']))
{
?>
<div style="font-size:16px;font-weight:bold;"><u>Update your profile</u></div>
<div align="left">




<?php
if(isset($_GET['error_uploading']))
echo '<div style="padding:8px;background-color:#FFFF99;margin-top:40px;font-size:14px;font-weight:bold;text-align:center;">
Uploading Error</div>';
else if(isset($_GET['uploading_done']))
echo '<div style="padding:8px;background-color:blue;color:#fff;margin-top:40px;font-size:14px;font-weight:bold;text-align:center;">
File Uploaded</div>';
?>



<div style="font-weight:bold;padding:15px;">Select your pdf/doc/jpeg file</div>
<form method="post" enctype="multipart/form-data">
<input type="file" name="doc_file" style="width:100%;border-radius:100px;padding:10px;font-size:14px;background-color:#D6D6D6;"><br>
<div align="right" style="padding:10px;">
<input type="submit" style="border-radius:5px;padding:;font-size:14px;background-color:#0066FF;color:#FFFFFF;font-weight:bold;float:;cursor:pointer;">
</div>
<input type="hidden" name="xxxxxxxxxxxx">
</form>
</div>
<?php
}
?>



<a href="<?php echo SITE_URL;?>edit/" style="font-size:15px;font-weight:bold;">Edit your profile</a>
</div>









</div>
</div>
</body>