<?php
/* 
 * Thank Jesus 
 * @Souce-code	TKV
 */


if(!MainFunc::CheckUserAdmin($_SESSION['USER_ID']))
{
	header("Location: ".SITE_URL."");
	exit;
}


	if(isset($_POST['actionuserid']))
	{
	$actionuserid 		= MainFunc::Encrypt(MainFunc::filter($_POST['actionuserid']));
	$what 				= MainFunc::Encrypt(MainFunc::filter($_POST['what']));
	$sym 				= dbTKV::SQLQUERY("SELECT * FROM users  WHERE  uid='".$actionuserid."' "); 
	if(!dbTKV::SQLNUM_ROWS($sym)) return;
	
		if($what=="block")
			dbTKV::SQLQUERY("UPDATE users SET uact='2' WHERE   uid='".$actionuserid."' AND NOT utype='admin' ");	
		else if($what=="unblock")
			dbTKV::SQLQUERY("UPDATE users SET uact='1' WHERE   uid='".$actionuserid."' ");	
			
		else if($what=="approve")
			dbTKV::SQLQUERY("UPDATE users SET uact='1' WHERE   uid='".$actionuserid."' ");	
		else if($what=="deactive")
			dbTKV::SQLQUERY("UPDATE users SET uact='0' WHERE   uid='".$actionuserid."' AND NOT utype='admin'");	

	exit;
	}
	









?>