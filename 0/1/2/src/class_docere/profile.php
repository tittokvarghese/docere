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



if(isset($_GET['id']))
{
	$aid=MainFunc::Encrypt(MainFunc::filter($_GET['id']));
	if(!MainFunc::IsUser($aid))
	{
		header("Location: ".SITE_URL."");
		exit;
	}
}




	

?>