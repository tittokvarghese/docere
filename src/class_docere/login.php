<?php
/* 
 * Thank Jesus 
 * @Souce-code	TKV
 */


	if(isset($_POST['login_email']))
	{
	$login_email 	= MainFunc::Encrypt(MainFunc::filter($_POST['login_email']));
	$login_pwd 		= MainFunc::Encrypt(MainFunc::filter($_POST['login_pwd']));
	
	echo Login::Action($login_email,$login_pwd);
	exit;
	}





class Login{
public static function xxxxxxx(){
}



public static function Action($usr_me,$usr_pwd){

		$check_uid 	= dbTKV::SQLQUERY("SELECT * FROM users  WHERE  login_id='".$usr_me."'  "); //checking email or phone
		$check_uid2 	= dbTKV::SQLQUERY("SELECT * FROM users  WHERE  login_id='".$usr_me."' and uact='2'  "); //checking email or phone
		$check_uid3 	= dbTKV::SQLQUERY("SELECT * FROM users  WHERE  login_id='".$usr_me."' and uact='0'  "); //checking email or phone
	
		if(empty($usr_me) or strlen($usr_me)<1 or ctype_space($usr_me))
		{
			return "Enter your Email";
		}
		else if(empty($usr_pwd) or strlen($usr_pwd)<1 or ctype_space($usr_pwd))
		{
			return "Enter your Password";
		}
		else if(!dbTKV::SQLNUM_ROWS($check_uid))
		{
			return "Sorry no such account exists";
		}
		else if(dbTKV::SQLNUM_ROWS($check_uid2))
		{
			return "Your account is blocked";
		}
		else if(dbTKV::SQLNUM_ROWS($check_uid3))
		{
			return "Your account is not approved";
		}
		$rowLog = dbTKV::SQL_FETCH($check_uid);// Data retrive
		if($rowLog["upwd"] != MainFunc::PwdHash($usr_pwd,substr($rowLog["upwd"],0,9)))
		{ 
			return "Sorry this password has not match, check to make sure that your <b>CAPS LOCK</b> key is off.";
		}
	
		
						
		if(MainFunc::LoginStart($rowLog["uid"]))
		{
			MainFunc::LoginLogs($rowLog["uid"]); //Database LOGS
		}
}




}

?>