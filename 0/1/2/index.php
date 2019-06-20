<?php
/**
 * Thank Jesus
 * @author		Titto K Varghese
 * @version 	2.1 
 * @script		TKVSOFT WEB Tool
 * @site-name	docere
 * @link		XXXXXXXXXXXXX
 * @code-date	02-Sep-2018
 * Created by	TKVSOFT
 */
 
	
	
	include 'config_docere_tkv.php';
	include ''.TKV_CONTROL_PATH.'main.php';
	
	include ''.TKV_CONTROL_PATH.'class/database.php';
	include ''.TKV_CONTROL_PATH.'class/calendar.php';
	
	
	
	$GLOBALS['db'] = new dbTKV(DB_SERVER,DB_USERBR,DB_PASSBR,DB_NAMEBR);
	$linkdb	   	= $GLOBALS['db']->connectTDocere();
	$app 		= new LoadDocereTIndex();
	
/*	if(isset($_GET['love']))
		$_SESSION['LOVE']=1;
	
	if(!isset($_SESSION['LOVE']))
		exit;
*/	
	
	if($app->checkDocere())
	{
			if(isset($_SESSION['USER_ID']))
			{
				if(!MainFunc::CheckActiveUser($_SESSION['USER_ID']))
					MainFunc::PrintWritter(SRC_PATH.TKV_VIEW_PATH."not_approved_view.php");
				else if(MainFunc::CheckUserAdmin($_SESSION['USER_ID']))
					MainFunc::PrintWritter(SRC_PATH.TKV_VIEW_PATH."admin_view.php");
				else if(MainFunc::CheckUserDoctor($_SESSION['USER_ID']))
					MainFunc::PrintWritter(SRC_PATH.TKV_VIEW_PATH."doctor_view.php");
				else
					MainFunc::PrintWritter(SRC_PATH.TKV_VIEW_PATH."index_view.php");
			}
			else
			MainFunc::PrintWritter(SRC_PATH.TKV_VIEW_PATH."index_view.php");
			exit;
	} 
	else 
	{
				if(file_exists($app->setNormalFile))
				{
					MainFunc::PrintWritter($app->setNormalFile);
					exit;
				}
				else if(file_exists($app->setViewFile) or file_exists($app->setClassFile))
				{
					
						include ''.$app->setClassFile.''; // Class File including 
						
						if(file_exists($app->setViewFile))
						MainFunc::PrintWritter($app->setViewFile);
						exit;
				} 
				else 
				{
					include ''.SRC_PATH.'index.html'; 
					exit; 
				}
				
	
	}
												/****************			TKVSOFT				****************/	 
?>