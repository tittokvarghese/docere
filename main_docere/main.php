<?php
/* 
* Thank Jesus 
* @Souce-code	TKV
*/

class MainFunc
{


					public static function GetTableRow($table)
					{
					$q	= dbTKV::SQLQUERY("SELECT * FROM ".$table."	");
					if(dbTKV::SQLNUM_ROWS($q))
					return dbTKV::SQLNUM_ROWS($q);
					}


					
					public static function GetNotifications()
					{
					$q	= dbTKV::SQLQUERY("SELECT * FROM notifications  WHERE  not_tid='".$_SESSION['USER_ID']."'	 AND  not_seen='0'	");
					if(dbTKV::SQLNUM_ROWS($q))
					return dbTKV::SQLNUM_ROWS($q);
					}
					
					
					public static function GetAppointments()
					{
					$q	= dbTKV::SQLQUERY("SELECT A.*,U.* FROM appointments A,users U  WHERE  A.apts_pid='".$_SESSION['USER_ID']."'	 AND U.uid=A.apts_did AND  A.apts_seen='0'	");
					if(dbTKV::SQLNUM_ROWS($q))
					return dbTKV::SQLNUM_ROWS($q);
					}
					public static function GetAppointmentsDoctors()
					{
					$q	= dbTKV::SQLQUERY("SELECT * FROM appointments   WHERE  apts_did='".$_SESSION['USER_ID']."'	 AND  apts_seen='0'	");
					if(dbTKV::SQLNUM_ROWS($q))
					return dbTKV::SQLNUM_ROWS($q);
					}
					
					
					
					public static function GetUsersTable($id,$item)
					{
					$q	= dbTKV::SQLQUERY("SELECT * FROM users WHERE uid='".$id."'  ");
					if(!dbTKV::SQLNUM_ROWS($q))
					return false;
					$row	= dbTKV::SQL_FETCH($q);
					return $row[$item]; 
					}
					public static function GetDoctorsTable($id,$item)
					{
					$q	= dbTKV::SQLQUERY("SELECT * FROM doctors WHERE doc_uid='".$id."'  ");
					if(!dbTKV::SQLNUM_ROWS($q))
					return false;
					$row	= dbTKV::SQL_FETCH($q);
					return $row[$item]; 
					}
					
					
					public static function IsUser($id)
					{
					$q	= dbTKV::SQLQUERY("SELECT * FROM users WHERE uid='".$id."'  ");
					if(dbTKV::SQLNUM_ROWS($q))
					return TRUE;
					}
					
					
					
					
					public static function UserGender($id)
					{
					$q	= dbTKV::SQLQUERY("SELECT * FROM users WHERE uid='".$id."'  ");
					if(!dbTKV::SQLNUM_ROWS($q))
					return false;
					$row	= dbTKV::SQL_FETCH($q);
					return $row['ugender']; 
					
					}
					
					
					
					
					
					public static function CheckUserAdmin($id)
					{
					$q	= dbTKV::SQLQUERY("SELECT * FROM users WHERE uid='".$id."' AND utype='admin' ");
					if(dbTKV::SQLNUM_ROWS($q))
					return true;
					}
					
					public static function CheckUserDoctor($id)
					{
					$q	= dbTKV::SQLQUERY("SELECT * FROM users WHERE uid='".$id."' AND utype='doctor' ");
					if(dbTKV::SQLNUM_ROWS($q))
					return true;
					}
					
					
					
					
					
					public static function isSession()
					{
						if(isset($_SESSION['USER_ID']))
							return $_SESSION['USER_ID'];
					}
					
					
					
					public static function GetName($id,$mode)
					{
					$q	= dbTKV::SQLQUERY("SELECT * FROM users WHERE uid='".$id."' ");
					if( !dbTKV::SQLNUM_ROWS($q))
					return "Name";
					$row	= dbTKV::SQL_FETCH($q);
					if($mode=='1') 	return $row['fname']; 	else if($mode=='2') 	return $row['lname']; 	else	return $row['fname'].' '.$row['lname'];
					}
					
					
					
					
					public static function GetProfilePic($id)
					{
					$q	= dbTKV::SQLQUERY("SELECT * FROM users WHERE uid='".$id."' ");
					if( !dbTKV::SQLNUM_ROWS($q))
					return SITE_URL.SRC_PATH.'img/avatar.jpg';
					
					$row = dbTKV::SQL_FETCH($q);
					
					if($row['uimage']==0)
					return SITE_URL.SRC_PATH.'img/avatar.jpg';
					else
					return SITE_URL.PHOTO_SAVE_PATH.$row['uimage'];
					}
					
					
					
					
					
					
					
					public static function PwdHash($pwd,$salt = NULL) // Password and salt generation
					{
					if ($salt == NULL)
					$salt = substr(md5(uniqid(rand(), TRUE)), 0, 9);//SALT_LENGTH
					else
					$salt = substr($salt,0,9);//SALT_LENGTH
					return $salt.sha1($pwd.$salt);
					}
					
					public static function LoginStart($id)
					{
					session_regenerate_id(TRUE); /* prevent against session fixation attacks. */
					$_SESSION['USER_ID']  = $id;  		
					if(isset($_SESSION['USER_ID']))	
					return TRUE;		
					}
					
					
					
					public static function LoginLogs($uid)
					{
					dbTKV::SQLQUERY("INSERT INTO login_logs (lgst_uid,lgst_ip,lgst_time,lgst_date,lgst_os,lgst_bra,lgst_bra_info,lgst_refurl)
					VALUES('".$uid."','".self::ipCheck()."','".time()."','".self::date_Time()."','".self::getOS()."',
					'".self::getBrowserName()."','".self::GetBroswer()."','".@$_SERVER['HTTP_REFERER']."') ");
					}
					
					
					public static function Logout()
					{
					unset($_SESSION['USER_ID']);
					session_unset();
					session_destroy(); 
					if( !isset($_SESSION['USER_ID']))	
					return TRUE;		
					}
					
					
					
					public static function TrimMsg($string)
					{
					$string = trim(preg_replace('/ {2,}/', ' &nbsp; ', $string));
					return $string;
					}
					
					
					
					public static function LogWriter($file_name,$title,$contents)
					{
					$ext	 	  = ".log";
					$qw 	  	  = @fopen(ERROR_LOGS.$file_name.$ext, "a+");
					$old_contents = file_get_contents(ERROR_LOGS.$file_name.$ext);	
					@ftruncate($qw, 0);
					
					
					$newData =
					"******************************************************************************************************
					".$title."
					Time : 	".time()."
					Date :	".self::date_Time()."
					OS :	".self::getOS()."
					PC-INFO : ".@php_uname()."
					Broswer : ".self::getBrowserName()."
					Broswer-INFO :	".self::GetBroswer()."	
					IP :	".self::ipCheck()."
					Ref URL: 	".@$_SERVER['HTTP_REFERER']."
					KEYWORD :	".$contents."
					\n";
					
					
					@fwrite($qw, $newData.PHP_EOL.$old_contents);
					@fclose($qw);
					
					
					
					}
					
					
					
					
					public static function random($count)
					{
					$a = '';
					for ($i = 0; $i<$count; $i++) 
					{
					$a .= mt_rand(1,9);
					}
					return $a;
					}
					
					
					public static function PrintWritter($getPath) //PowerFull Tool
					{
					ob_start();
					include $getPath; 
					$output = ob_get_contents();
					ob_end_clean();
					
					echo '<!DOCTYPE html><html lang="en"><head>'.Header::write().'</head>'.$output.'</html>';
					}
					
					public static function GetBroswer()
					{
					return $_SERVER['HTTP_USER_AGENT'];
					}
					
					public static function getBrowserName() {
					
					$browser        =   "Unknown Browser";
					$browser_array  =   array(
					'/msie/i'       =>  'Internet Explorer',
					'/firefox/i'    =>  'Firefox',
					'/safari/i'     =>  'Safari',
					'/chrome/i'     =>  'Chrome',
					'/edge/i'       =>  'Edge',
					'/opera/i'      =>  'Opera',
					'/netscape/i'   =>  'Netscape',
					'/maxthon/i'    =>  'Maxthon',
					'/konqueror/i'  =>  'Konqueror',
					'/mobile/i'     =>  'Handheld Browser'
					);
					
					foreach ($browser_array as $regex => $value) { 
					
					if (preg_match($regex, self::GetBroswer())) {
					$browser    =   $value;
					}
					
					}
					
					return $browser;
					
					}
					
					public static function ipCheck()
					{
					if (getenv('HTTP_CLIENT_IP')) {
					$ipfor = getenv('HTTP_CLIENT_IP');
					}
					elseif (getenv('HTTP_X_FORWARDED_FOR')) {
					$ipfor = getenv('HTTP_X_FORWARDED_FOR');
					}
					elseif (getenv('HTTP_X_FORWARDED')) {
					$ipfor = getenv('HTTP_X_FORWARDED');
					}
					elseif (getenv('HTTP_FORWARDED_FOR')) {
					$ipfor = getenv('HTTP_FORWARDED_FOR');
					}
					elseif (getenv('HTTP_FORWARDED')) {
					$ipfor = getenv('HTTP_FORWARDED');
					}
					else {
					$ipfor = $_SERVER['REMOTE_ADDR'];
					}
					return $ipfor;
					}	
					
					
					public static function Encrypt($string)
					{
					/*$string = htmlspecialchars($string);*/
					$string = trim("$string");
					$string = stripslashes($string);
					$string = dbTKV::SQL_REAL_ESCAPE($string);
					return $string;
					}
					
					
					public static function date_Time($uid=FALSE)
					{
					$timezone = new DateTimeZone(DEFAULT_TIMEZONE_NAME);
					$date = new DateTime();
					$date->setTimezone($timezone);
					return $date->format('D, F j, Y, g:i:s A');
					}
					
					
					public static function getOS()
					{ 
					$user_agent		=	$_SERVER['HTTP_USER_AGENT'];
					$os_platform    =   "Unknown OS Platform, ".PHP_OS;
					$os_array       =   array(
					'/windows nt 10/i'      =>  'Windows 10',
					'/windows nt 6.3/i'     =>  'Windows 8.1',
					'/windows nt 6.2/i'     =>  'Windows 8',
					'/windows nt 6.1/i'     =>  'Windows 7',
					'/windows nt 6.0/i'     =>  'Windows Vista',
					'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
					'/windows nt 5.1/i'     =>  'Windows XP',
					'/windows xp/i'         =>  'Windows XP',
					'/windows nt 5.0/i'     =>  'Windows 2000',
					'/windows me/i'         =>  'Windows ME',
					'/win98/i'              =>  'Windows 98',
					'/win95/i'              =>  'Windows 95',
					'/win16/i'              =>  'Windows 3.11',
					'/macintosh|mac os x/i' =>  'Mac OS X',
					'/mac_powerpc/i'        =>  'Mac OS 9',
					'/linux/i'              =>  'Linux',
					'/ubuntu/i'             =>  'Ubuntu',
					'/iphone/i'             =>  'iPhone',
					'/ipod/i'               =>  'iPod',
					'/ipad/i'               =>  'iPad',
					'/android/i'            =>  'Android',
					'/blackberry/i'         =>  'BlackBerry',
					'/webos/i'              =>  'Mobile'
					);
					foreach ($os_array as $regex => $value)
					{ 
					if (preg_match($regex, $user_agent)) $os_platform = $value;
					}   
					return $os_platform;
					}
					
					
					public static function timeS($session_time,$opt=false) 
					{ 
					$time_difference = time() - $session_time; 
					$seconds = $time_difference; 
					$minutes = round($time_difference / 60);
					$hours = round($time_difference / 3600); 
					$days = round($time_difference / 86400); 
					$weeks = round($time_difference / 604800); 
					$months = round($time_difference / 2419200); 
					$years = round($time_difference / 29030400);  
					
					
					if($seconds <= 60)
					{
					$ago= " Just now "; 
					}
					else if($minutes <=60)
					{
					if($minutes==1)
					$ago= "one minute ago"; 
					else
					$ago= "$minutes minutes ago"; 
					}
					else if($hours <=24)
					{
					if($hours==1)
					$ago= "one hour ago";
					else
					$ago= "$hours hours ago";
					}
					else if($days <=7)
					{
					if($days==1)
					$ago= "one day ago";
					else
					$ago= "$days days ago";
					}
					else if($weeks <=4)
					{
					if($weeks==1)
					$ago= "one week ago";
					else
					$ago= "$weeks weeks ago";
					}
					else if($months <=12)
					{
					if($months==1)
					$ago= "one month ago";
					else
					$ago= "$months months ago";
					} 
					else 
					{ 
					if($years==1)
					$ago= "one year ago";
					else
					$ago= "$years years ago";
					}
					
					if($opt==true)
					echo $ago;
					else
					return $ago;
					}
					
					
					public static function isEmail($q)
					{
					return preg_match('/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU', $q) ? TRUE : FALSE;
					}
					
					public static function filter($d)
					{
					return trim(htmlspecialchars(strip_tags($d)));
					}
					
}
/*************************/
?>