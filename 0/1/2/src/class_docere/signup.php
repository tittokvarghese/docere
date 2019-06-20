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
	$phnumb 	= MainFunc::Encrypt(MainFunc::filter($_POST['phnumb']));
	$age 		= MainFunc::Encrypt(MainFunc::filter($_POST['age']));
	
	echo SignUp::Action($sfname,$slname,$semail,$spwd,$stype,$phnumb,$age);
	exit;
	}





class SignUp{
public static function xxxxxxx(){
}



public static function Action($frt_s,$las_s,$usr_lid,$pwd,$stype,$phnumb,$age)
{

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
		else if(!preg_match('/^[A-Za-z \'.]+$/i',$frt_s) or !preg_match('/^[A-Za-z \'.]+$/i',$las_s))
		{
			return "Name should be character";
		}
		
		
		
		//		else if(preg_match('([a-zA-Z].*[0-9]|[0-9].*[a-zA-Z])', $frt_s) or preg_match('([a-zA-Z].*[0-9]|[0-9].*[a-zA-Z])', $las_s))

		else if(empty($usr_lid) or strlen($usr_lid)<1) // empty username
		{
			return "Enter your email";
		}
		else if( !MainFunc::isEmail($usr_lid))// Email id is not correct
		{
			return "Email not valid";
		}
		else if(empty($phnumb) or strlen($phnumb)<1 or !is_numeric($phnumb))
		{
			return "Enter your phone number";
		}
		else if($phnumb<=1)
		{
			return "Enter your valid phone number";
		}
		else if(strlen($phnumb)<10)
		{
			return "Enter your number min 10 char";
		}
			

		
		
		else if($stype=="Patient")
		{
			if(empty($age) or strlen($age)<2 or !is_numeric($age))
			{
				return "Enter your age";
			}
			else if($age<1)
			{
				return "Enter your valid age";
			}
		}		
		if(dbTKV::SQLNUM_ROWS($check_uid))
		{
			return "This email has already exist!";
		}
		else if(empty($pwd) or strlen($pwd)<6)
		{
			return "Password must be min 6 char.";
		}
		else
		{
			$pwd_gen  			= MainFunc::PwdHash($pwd);
			
			
			$uactA = '0';			
			$check_admin = dbTKV::SQLQUERY("SELECT * FROM users  WHERE utype='admin'   ");  //Creating admin
			if(!dbTKV::SQLNUM_ROWS($check_admin))
			{
				$stype 		= 'admin';
				$uactA 		= '1';

			}
			
			
			$signup_check 		= dbTKV::SQLQUERY("INSERT INTO  users (uact,fname,lname,login_id,upwd,utype,utime,udate,uip,ubra,uphone,uage) 
			VALUES('".$uactA."','".$frt_s."','".$las_s."','".$usr_lid."','".$pwd_gen."','".$stype."','".time()."','".MainFunc::date_Time()."',
					'".MainFunc::ipCheck()."','".MainFunc::GetBroswer()."','".$phnumb."','".$age."')");
			
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