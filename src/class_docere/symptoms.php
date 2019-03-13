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



	if(isset($_POST['symptoms']))
	{
		$symptoms 		= MainFunc::Encrypt(MainFunc::filter($_POST['symptoms']));
		$sym 			= dbTKV::SQLQUERY("SELECT * FROM symptoms  WHERE  symid='".$symptoms."' "); 
		if(!dbTKV::SQLNUM_ROWS($sym)) return;
			dbTKV::SQLQUERY("DELETE FROM symptoms WHERE  symid='".$symptoms."'	");
		exit;
	}


?>