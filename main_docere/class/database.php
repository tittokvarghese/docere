<?php
/* 
 * Thank Jesus 
 * @Souce-code	TKV
 * @Scripting	Titto K Varghese
 */
 
 
class dbTKV
{
	private $connection	= FALSE;
	private $server;
	private $dbuser;
	private $dbpass;
	private $dbname;
	
	public function __construct($shost,$suser,$spass,$sname)
	{
		$this->server = $shost;
		$this->dbuser = $suser;
		$this->dbpass = $spass;		
		$this->dbname = $sname;	
	}
	
	
	public function connectTDocere()
	{
		$this->connection	= mysqli_connect($this->server, $this->dbuser, $this->dbpass, $this->dbname)  
		or self::fatal_error("Cannot access the server [mysqli_connect error]");
		$db	= mysqli_select_db($this->connection, $this->dbname) or self::fatal_error("Try again!",TRUE);
		return $this->connection;
	}

	private static function fatal_error($error,$display=FALSE)
	{ 
		$qw 	  	  = @fopen(ERROR_LOGS."PHP_TKV_ERRORS.log", "a+");
		$old_contents = file_get_contents(ERROR_LOGS."PHP_TKV_ERRORS.log");	
		@ftruncate($qw, 0);
		
		$newData = "[".time().", ".MainFunc::date_Time().", ".MainFunc::ipCheck().", ".MainFunc::GetBroswer()."] === ".$error;
		
    	@fwrite($qw, $newData.PHP_EOL.$old_contents);
		@fclose($qw);
		
		if($display == TRUE)
		die($error);
	}
	
	public  function insertIdconc()
	{ 
		return $this->connection;
	}

	public function __destruct()
	{
		if($this->connection)
		{ 
			@mysqli_close($this->connection);
			$this->connection = FALSE;
			unset($this->connection);
		}
	}



	public function SQL_ERRORS($q=false)
	{
	return mysqli_error($q);
	}	
	
	public static function SQLNUM_ROWS($q)
	{
	return mysqli_num_rows($q);
	}

	public static function SQLQUERY($q)
	{
		$qry	=	mysqli_query($GLOBALS['db']->connection,$q);
		if($qry	== FALSE)
		self::fatal_error($GLOBALS['db']->SQL_ERRORS($GLOBALS['db']->connection)." with query ".$q);
		
		return $qry;
	}
	
	public static function SQL_FETCH($q)
	{
		$qry	=	mysqli_fetch_array($q,MYSQLI_BOTH);
		return $qry;
	}

	public static function SQL_FETCH_ROWS($q)
	{
		$qry	=	mysqli_fetch_row($q);
		return $qry;
	}
	
	public static function SQL_REAL_ESCAPE($q)
	{
	return mysqli_real_escape_string($GLOBALS['db']->connection,$q);
	}

	public static function SQL_INSERT_ID()
	{
		$qry	=	intval(mysqli_insert_id($GLOBALS['db']->connection));
		return $qry;
	}	

	public static function SQL_NUM_FIELDS($q)
	{
		$qry	=	mysqli_num_fields($q);
		return $qry;
	}	
	
	

	

}
/***********************************************/












class Header
{
	public static $action;
	public static $title;
	public static $icon;
	public static $author;
	public static $contentType;
	public static $description;
	public static $keywords;
	public static $google;
	public static $robots;
	public static $add;
	
	public static function write()
	{
	
		if(self::$action!="enable")	return;
		$htmldisplay="";
	 
	
		if(self::$title["action"])
		{
		$htmldisplay.= "<title>".self::$title["content"]."</title>";
		}
		if(self::$icon["action"])
		{
		$htmldisplay.= '<link rel="shortcut icon" type="image/x-icon" href="'.FAVI_ICON.'">';
		}
		if(self::$author["action"])
		{
		}
		if(self::$contentType["action"])
		{
		$htmldisplay.= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		}
		if(self::$description["action"])
		{
		$htmldisplay.= '<meta name="description" content="'.self::$description["content"].'" />';
		}
		if(self::$keywords["action"])
		{
		$htmldisplay.= '<meta name="keywords" content="'.strtolower(SITE_NAME).','.self::$keywords["content"].'">';
		}
		if(self::$google["action"])
		{
		$htmldisplay.= '<meta name="google-site-verification" content="'.GOOGLE_SITE_VERIF.'" />';
		}
		if(self::$robots["action"])
		{
		$htmldisplay.= '<meta name="robots" content="'.self::$robots["content"].'" >';
		}
		
		$htmldisplay.= '';
		
		
		if(self::$add["action"])
		{
		$htmldisplay.= self::$add["content"];
		}
		
		
		return $htmldisplay;
	}
	
}
/**************/













class LoadDocereTIndex
{
	public 		$requestName;
	public 		$setNormalFile;
	public 		$setViewFile;
	public 		$setClassFile;
	public 		$set_user_folder;
	public 		$get_new_username;
	protected 	$slash_removed;
	protected 	$request_uri;
	protected 	$set_url_hold;
	protected 	$set_temp_hold;
	protected 	$set_stable_hold;
	protected 	$holdData;
	protected 	$replace_slash;
	protected 	$new_req_str;
	protected 	$new_req_strpos;
	protected 	$get_cur_username;
	protected 	$get_temp_username;
	protected 	$set_new_username;
	protected 	$check_sql_users;

	public function __construct()
	{
		$this->request_uri	 = $_SERVER['REQUEST_URI'];
		if(isset($_GET['request'])) 
		$this->requestName = $_GET['request'];
	}
	public function checkDocere()
	{
		if($this->requestName == FALSE)
		return TRUE;
		$this->slash_removed = trim($this->requestName,'/');
		$this->setNormalFile = SRC_PATH.TKV_VIEW_PATH."files/".$this->slash_removed; 
		$this->setClassFile	 = SRC_PATH.TKV_CLASS_PATH.str_replace("/", "_titto_", $this->slash_removed).".php"; 
		$this->setViewFile	 = SRC_PATH.TKV_VIEW_PATH.str_replace("/", "_titto_", $this->slash_removed).".php"; 
	}


	
}
/****/