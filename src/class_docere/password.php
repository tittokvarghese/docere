<?php
/* 
 * Thank Jesus 
 * @Souce-code	TKV
 */


	if(isset($_POST['opwd']))
	{
		echo Password::Update();
		exit;
	}
	else if(isset($_POST['emailpassword']))
	{
		echo Password::IndexUpdate();
		exit;
	}
	else if(isset($_POST['newpassword']))
	{
		echo Password::ChangePasswordUpdate();
		exit;
	}
	
	
	
	
	
	


class Password{
public static function xxxxxxx(){
}


public static function ChangePasswordUpdate(){

	$emailpassword 		= MainFunc::Encrypt(MainFunc::filter($_POST['emailpassword2']));
	$newpassword 		= MainFunc::Encrypt(MainFunc::filter($_POST['newpassword']));
	$codepassword 		= MainFunc::Encrypt(MainFunc::filter($_POST['codepassword']));

	 if(empty($newpassword) or strlen($newpassword)<6 or ctype_space($newpassword))
		return "Enter your new password";
	 else if(empty($codepassword) or strlen($codepassword)<4 or ctype_space($codepassword))
		return "Enter your code";
				
	$check_uid 	= dbTKV::SQLQUERY("SELECT * FROM new_password  WHERE   npwd_email='".$emailpassword."' AND npwd_code='".$codepassword."' ");
		if(!dbTKV::SQLNUM_ROWS($check_uid)) return 'Error';

	$row_pwd	= dbTKV::SQL_FETCH($check_uid);
	if($codepassword==$row_pwd["npwd_code"])
	{
		$cr_new_pwd	=	MainFunc::PwdHash($newpassword);
		$pwd_check 	=	dbTKV::SQLQUERY("UPDATE users SET upwd='".$cr_new_pwd."' WHERE  login_id='".$emailpassword."'  ");
		
		dbTKV::SQLQUERY("DELETE FROM  new_password WHERE 	npwd_email='".$emailpassword."' AND npwd_code='".$codepassword."'	");
	}
	

}


public static function IndexUpdate(){

	$emailpassword 		= MainFunc::Encrypt(MainFunc::filter($_POST['emailpassword']));

	 if(empty($emailpassword) or strlen($emailpassword)<6 or ctype_space($emailpassword))
		return "Enter your email";
	$check_uid 	= dbTKV::SQLQUERY("SELECT * FROM users  WHERE   login_id='".$emailpassword."' ");
		if(!dbTKV::SQLNUM_ROWS($check_uid)) return 'Sorry no such account exists';



		$puact_code 	= MainFunc::random(4);
		$message		= 'Your verification code is '.$puact_code.'';
		$esending 		= @mail($emailpassword,$message,$message,"From: \"Docere\" <auto-docere@gmail.com>\r\n");


		$newPwdTable 	= dbTKV::SQLQUERY("SELECT * FROM new_password  WHERE   npwd_email='".$emailpassword."' 	");
		if(!dbTKV::SQLNUM_ROWS($newPwdTable)) 
				dbTKV::SQLQUERY("INSERT INTO new_password (npwd_email,npwd_code,npwd_time)
					VALUES('".$emailpassword."','".$puact_code."','".time()."'	) ");


}






public static function Update(){

	$opwd 		= MainFunc::Encrypt(MainFunc::filter($_POST['opwd']));
	$npwd		= MainFunc::Encrypt(MainFunc::filter($_POST['npwd']));
	
		if(empty($opwd) or strlen($opwd)<6 or ctype_space($opwd))
		return "Enter your old password";
		else if(empty($npwd) or strlen($npwd)<6 or ctype_space($npwd))
		return "Enter your new password";


	$check_uid 	= dbTKV::SQLQUERY("SELECT * FROM users  WHERE   uid='".$_SESSION['USER_ID']."' ");
	$row_pwd	= dbTKV::SQL_FETCH($check_uid);

	 if($row_pwd["upwd"] != MainFunc::PwdHash($opwd,substr($row_pwd["upwd"],0,9)))
		return "Your old password is not match!";

		$cr_new_pwd	=	MainFunc::PwdHash($npwd);
		$pwd_check 	=	dbTKV::SQLQUERY("UPDATE users SET upwd='".$cr_new_pwd."' WHERE uid='".$_SESSION['USER_ID']."'  ");

	header("Location: ".SITE_URL."?updated");
	exit;
}




}

	header("Location: ".SITE_URL."");
	exit;

?>