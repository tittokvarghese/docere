<?php
/* 
 * Thank Jesus 
 * @Souce-code	TKV
 */

$pageTitle="users";

Header::$action			=	"enable";
Header::$title			=	array("action"=>"1", "content"=>"Users | ADMIN CP - ".SITE_NAME);
Header::$icon			=	array("action"=>"1");
Header::$author			=	array("action"=>"1", "content"=>SITE_NAME);
Header::$contentType	=	array("action"=>"1");
Header::$description	=	array("action"=>"1", "content"=>"");
Header::$keywords		=	array("action"=>"1", "content"=>SITE_NAME);
Header::$google			=	array("action"=>"1");
Header::$robots			=	array("action"=>"1", "content"=>"noindex");//robots.txt
Header::$add			=	array("action"=>"1", "content"=>"<style>

</style>".CSS_PATH.JQUERY_FILE."");


?><body class="AdminHome"><?php 
include 'header.php'; 


?>
<div class="Content">
<div align="left"  style="padding:40px;">


<?php 
include 'left_tab_menu.php'; 
?><div class="TabConts"><div class="AdPageTitle">Users</div><div style="margin-top:50px;"></div>
 
<div align="center" style="padding-bottom:100px;">
<a href="?doctors"><div class="dashCircle" style="background-color:#999966;color:#FFFFFF;border-color:#990066;">
<div class="num"><?php echo MainFunc::GetTableRow("users where utype='Doctor' ");?></div><div class="text">Doctors</div></div></a>
<a href="?patients"><div class="dashCircle" style="background-color:#00FF33;color:#FFFFFF;border-color:#666666;">
<div class="num"><?php echo MainFunc::GetTableRow("users where utype='Patient' ");?></div><div class="text">Patients</div></div></a>
<a href="?admin"><div class="dashCircle" style="background-color:#0033CC;color:#FFFFFF;border-color:#009933;">
<div class="num"><?php echo MainFunc::GetTableRow("users where utype='admin' ");?></div><div class="text">Admin</div></div></a>
<a href="?blocked"><div class="dashCircle" style="background-color:#FF9900;color:#FFFFFF;border-color:#009933;">
<div class="num"><?php echo MainFunc::GetTableRow("users where uact='2' ");?></div><div class="text">Blocked</div></div></a>
<a href="?deactived"><div class="dashCircle" style="background-color:#FF9999;color:#FFFFFF;border-color:#009933;">
<div class="num"><?php echo MainFunc::GetTableRow("users where uact='0' ");?></div><div class="text">Deactived</div></div></a>
</div>


<?php


	$re1d="SELECT * FROM users where NOT utype='admin'	";


if(isset($_GET['doctors']))
	$re1d="SELECT * FROM users where utype='Doctor'	";
else if(isset($_GET['patients']))
	$re1d="SELECT * FROM users where utype='Patient'	";
else if(isset($_GET['admin']))
	$re1d="SELECT * FROM users where utype='admin'	";
else if(isset($_GET['blocked']))
	$re1d="SELECT * FROM users where uact='2'	";
else if(isset($_GET['deactived']))
	$re1d="SELECT * FROM users where uact='0'	";






	$totalcount = dbTKV::SQLNUM_ROWS(dbTKV::SQLQUERY($re1d));
	$pagelimit = "5";
	$totalpages = ceil($totalcount / $pagelimit); 
	if (isset($_GET['page_refer']) && is_numeric($_GET['page_refer']) && $_GET['page_refer'] <= $totalpages)
		$currentpage=MainFunc::Encrypt($_GET['page_refer']);
    else 
    	$currentpage = 1;

    if ($currentpage < 1)
		$currentpage = $totalpages; 
	$offset = ($currentpage - 1) * $pagelimit;
	
	$get_doc_usr = dbTKV::SQLQUERY("$re1d  ORDER BY uid DESC  LIMIT $offset,$pagelimit");
	while($usr_row  = dbTKV::SQL_FETCH($get_doc_usr))
	{
	echo '<div class="UsersBox" id="'.$usr_row['uid'].'"><div class="Ud"><img src="'.MainFunc::GetProfilePic($usr_row['uid']).'" class="UdImg" alt="Image" align="absmiddle"></div><div class="UTitle">'.(MainFunc::CheckUserDoctor($usr_row['uid']) ? 'Dr.' : '').MainFunc::GetName($usr_row['uid'],3).'</div>
	
	
	
	'.($usr_row['utype']!='admin' ? '<div class="UMenu"><div do="'.($usr_row['uact']==1? 'deactive':'approve').'" class="UbuT '.($usr_row['uact']==1? 'Ubut6':'Ubut1').' AdActionUser_ajax">'.($usr_row['uact']==1? 'Deactive':'Approve').'</div><div do="'.($usr_row['uact']==2? 'unblock':'block').'" class="UbuT Ubut2 AdActionUser_ajax">'.($usr_row['uact']==2? 'Unblock':'Block').'</div><a href="'.SITE_URL.'profile/?id='.$usr_row['uid'].'" class="UbuT Ubut3">View Profile</a><a href="'.SITE_URL.'logs/?id='.$usr_row['uid'].'" class="UbuT Ubut4">View Logs</a></div>' : '').'
	
	
	
	
	
	</div>';
	}
	
	
	$prevpage = $currentpage - 1;
	$nextpage = $currentpage + 1;
	
	$link = '';
	if(isset($_GET['doctors']))
	$link = 'doctors&';
	else if(isset($_GET['patients']))
	$link = 'patients&';
	else if(isset($_GET['admin']))
	$link = 'admin&';
	else if(isset($_GET['blocked']))
	$link = 'blocked&';
	else if(isset($_GET['deactived']))
	$link = 'deactived&';

	
	
	

	
	
	echo '<div style="padding:10px;">';
	if(isset($_GET['page_refer']))
	{
		if($_GET['page_refer'] > 1)
		echo '<a class="DbMoreLimit" href="?'.$link.'page_refer='.$prevpage.'">Back</a>';
		
	}
	echo '<a class="DbMoreLimit" href="?'.$link.'page_refer='.$nextpage.'">See more</a>';
	echo '<br><br>';
	$range = 7;
	for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++)
	{
		if (($x > 0) && ($x <= $totalpages))
		{
			if ($x == $currentpage)
				echo '<span class="DbMoreLimitTagAct">[<b>'.$x.'</b>]</span> ';
			else
				echo '<a href="?'.$link.'page_refer='.$x.'" class="DbMoreLimitTag">'.$x.'</a> '; 
		} 
	} 	
	echo '</div>';	
	
	
	
	
	
	
	
	
	
?>
</div>

</div></div></body>