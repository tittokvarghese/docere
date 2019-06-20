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

?>