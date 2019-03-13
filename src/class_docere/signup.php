<?php
/* 
 * Thank Jesus 
 * @Souce-code	TKV
 */


	if(isset($_POST['sfname']))
	{
	$sfname 	= MainFunc::Encrypt(MainFunc::filter($_POST['sfname']));
	$slname 	= MainFunc::Encrypt(MainFunc::filter($_POST['slname']));
	$semail 	= MainFunc::Encrypt(MainFunc::filter($_POST['semail']));
	$spwd 		= MainFunc::Encrypt(MainFunc::filter($_POST['spwd']));
	$stype 		= MainFunc::Encrypt(MainFunc::filter($_POST['stype']));
	
	echo SignUp::Action($sfname,$slname,$semail,$spwd,$stype);
	exit;
	}





class SignUp{
public static function xxxxxxx(){
}



public static function Action($frt_s,$las_s,$usr_lid,$pwd,$stype){

		$check_uid 		  = dbTKV::SQLQUERY("SELECT login_id FROM users  WHERE login_id='".$usr_lid."'   "); //checking email or phone

		if(empty($frt_s) or strlen($frt_s)<1)
		{
			return "Enter your first name";
		}
		else if(empty($las_s) or strlen($las_s)<1)
		{
			return "Enter your last name";
		}
		else if(is_numeric($frt_s) or is_numeric($las_s))
		{
			return "Name should be character";
		}
		else if(empty($usr_lid) or strlen($usr_lid)<1) // empty username
		{
			return "Enter your email";
		}
		else if( !MainFunc::isEmail($usr_lid))// Email id is not correct
		{
			return "Email not valid";
		}
		else if(dbTKV::SQLNUM_ROWS($check_uid))
		{
			return "This email has already exist, choose another one!";
		}
		else if(empty($pwd) or strlen($pwd)<6)
		{
			return "Password must be min 6 char.";
		}
		else
		{
			$pwd_gen  			= MainFunc::PwdHash($pwd);
			$signup_check 		= dbTKV::SQLQUERY("INSERT INTO  users (fname,lname,login_id,upwd,utype,utime,udate,uip,ubra) 
			VALUES('".$frt_s."','".$las_s."','".$usr_lid."','".$pwd_gen."','".$stype."','".time()."','".MainFunc::date_Time()."',
					'".MainFunc::ipCheck()."','".MainFunc::GetBroswer()."')");
			
			if($signup_check == FALSE) return "Signup Error, Try again";
			
			$latest_Uid 		= dbTKV::SQL_INSERT_ID();  
			if(MainFunc::LoginStart($latest_Uid))
			{
				MainFunc::LoginLogs($latest_Uid); //Database LOGS
			}	
			
		}




}



}
?>