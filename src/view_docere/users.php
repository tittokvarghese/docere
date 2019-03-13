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
include 'left_tab_menu.php'; 

?><div class="TabConts"><div class="AdPageTitle">Users</div><div style="margin-top:50px;"></div>
<?php


	$re1d=dbTKV::SQLQUERY("SELECT * FROM users where NOT utype='admin'	");
	$totalcount = dbTKV::SQLNUM_ROWS($re1d);
	$pagelimit = "3";
	$totalpages = ceil($totalcount / $pagelimit); 
	if (isset($_GET['page_refer']) && is_numeric($_GET['page_refer']) && $_GET['page_refer'] <= $totalpages)
		$currentpage=MainFunc::Encrypt($_GET['page_refer']);
    else 
    	$currentpage = 1;

    if ($currentpage < 1)
		$currentpage = $totalpages; 
	$offset = ($currentpage - 1) * $pagelimit;
	
	$get_doc_usr = dbTKV::SQLQUERY("SELECT * FROM users where NOT utype='admin' ORDER BY uid DESC  LIMIT $offset,$pagelimit");
	while($usr_row  = dbTKV::SQL_FETCH($get_doc_usr))
	{
	echo '<div class="UsersBox" id="'.$usr_row['uid'].'"><div class="Ud"><img src="'.MainFunc::GetProfilePic($usr_row['uid']).'" class="UdImg" alt="Image" align="absmiddle"></div><div class="UTitle">'.MainFunc::GetName($usr_row['uid'],3).'</div><div class="UMenu"><div do="'.($usr_row['uact']==1? 'deactive':'approve').'" class="UbuT '.($usr_row['uact']==1? 'Ubut6':'Ubut1').' AdActionUser_ajax">'.($usr_row['uact']==1? 'Deactive':'Approve').'</div><div do="'.($usr_row['uact']==2? 'unblock':'block').'" class="UbuT Ubut2 AdActionUser_ajax">'.($usr_row['uact']==2? 'Unblock':'Block').'</div><a href="'.SITE_URL.'profile/?id='.$usr_row['uid'].'" class="UbuT Ubut3">View Profile</a><a href="'.SITE_URL.'logs/?id='.$usr_row['uid'].'" class="UbuT Ubut4">View Logs</a></div></div>';
	}
	
	
	$prevpage = $currentpage - 1;
	$nextpage = $currentpage + 1;
	echo '<div style="padding:10px;">';
	if(isset($_GET['page_refer']))
	{
		if($_GET['page_refer'] > 1)
		echo '<a class="DbMoreLimit" href="?page_refer='.$prevpage.'">Back</a>';
		
	}
	echo '<a class="DbMoreLimit" href="?page_refer='.$nextpage.'">See more</a>';
	echo '<br><br>';
	$range = 7;
	for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++)
	{
		if (($x > 0) && ($x <= $totalpages))
		{
			if ($x == $currentpage)
				echo '<span class="DbMoreLimitTagAct">[<b>'.$x.'</b>]</span> ';
			else
				echo '<a href="?page_refer='.$x.'" class="DbMoreLimitTag">'.$x.'</a> '; 
		} 
	} 	
	echo '</div>';	
	
	
	
	
	
	
	
	
	
?>
</div>

</div></div></body>