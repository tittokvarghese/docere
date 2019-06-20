<?php
/*
 @script	TKVSOFT
*/



//error_reporting(0);

define("SITE_NAME",'Docere');
define("SITE_URL",'http://localhost/docere/'); // http://example.com/
define("SITE_URL_PRODUCT",'http://tkvsoft.com/'); 

define("DB_SERVER", "localhost");
define("DB_USERBR", "root");
define("DB_PASSBR", '');
define("DB_NAMEBR", "docere");
define("GOOGLE_SITE_VERIF",'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX');



define("SRC_PATH",'src/');
define("TKV_CONTROL_PATH",'main_docere/');
define("TKV_VIEW_PATH",'view_docere/');
define("TKV_CLASS_PATH",'class_docere/');
define("STORGE_PATH",'storage_docere/');
define("PHOTO_SAVE_PATH",STORGE_PATH.'photo/');
define("FILES_SAVE_PATH",STORGE_PATH.'files/');
define("ERROR_LOGS", STORGE_PATH.'logs/');
define("FAVI_ICON",SITE_URL.SRC_PATH.'img/ficon.png');


define("DEFAULT_TIMEZONE_OFFSET", "(UTC+05:30) Kolkata");
define("DEFAULT_TIMEZONE_NAME", "Asia/Calcutta");
date_default_timezone_set(DEFAULT_TIMEZONE_NAME);

define("ACCESS_DENIED","<!DOCTYPE html><html><head><title>Access Denied</title></head><body><h1 style='margin:0;font-family: trebuchet ms;color:#666666;text-decoration:underline;'>Access Denied</h1></body></html>");



define("CSS_PATH",'<link type="text/css" rel="stylesheet" href="'.SITE_URL.SRC_PATH.'css/main.css" />


<link type="text/css" rel="stylesheet" href="'.SITE_URL.SRC_PATH.'css/font/css/font-awesome.min.css" />');

define("JQUERY_FILE",'
<script type="text/javascript">var turl="'.SITE_URL.'";</script>
<script language="JavaScript" type="text/javascript" src="'.SITE_URL.SRC_PATH.'js/main.js" ></script>
<script language="JavaScript" type="text/javascript" src="'.SITE_URL.SRC_PATH.'js/docere.js" ></script>
');

/*<script language="JavaScript" type="text/javascript" src="'.SITE_URL.SRC_PATH.'js/clientval-script.js" ></script>*/




define("JQUERY_FILE_SLIDER",'<script language="JavaScript" type="text/javascript" src="'.SITE_URL.SRC_PATH.'js/jssor_slider.js"></script>');
	
	
	

/*
define("xxxxxxxxxxxxxx",'xxxxxxxxxxxxxxx');
define("xxxxxxxxxxxxxx",'xxxxxxxxxxxxxxx');
*/
	ini_set('session.save_path', STORGE_PATH.'sessions');

	session_start();
