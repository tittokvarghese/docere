<?php
/* 
 * Thank Jesus 
 * @Souce-code	TKV
 */

$pageTitle="logs";

Header::$action			=	"enable";
Header::$title			=	array("action"=>"1", "content"=>"Logs | ADMIN CP - ".SITE_NAME);
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

?><div class="TabConts" style="background-color:#"><div class="AdPageTitle">Logs</div><div style="margin-top:50px;"></div>
<?php

$aid='';
if(isset($_GET['id']))
{
	$aid=MainFunc::Encrypt(MainFunc::filter($_GET['id']));
	$re1d="SELECT * FROM  login_logs WHERE lgst_uid='".$aid."'		";
}
else
	$re1d="SELECT * FROM  login_logs ";


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
	
	$get_doc_usr = dbTKV::SQLQUERY("$re1d  ORDER BY lgstid DESC   LIMIT $offset,$pagelimit");
	while($usr_row  = dbTKV::SQL_FETCH($get_doc_usr))
	{
	echo '<div class="UsersBox"><div class="Ud"><img src="'.MainFunc::GetProfilePic($usr_row['lgst_uid']).'" class="UdImg" alt="Image" align="absmiddle"></div><div class="UTitle">
	
	<a href="'.SITE_URL.'profile/?id='.$usr_row['lgst_uid'].'">'.MainFunc::GetName($usr_row['lgst_uid'],3).'</a>
	
	
<div class="LogsInfo">
<div class="leftTabb">Time</div> <div class="RightTabb">'.MainFunc::timeS($usr_row['lgst_time'],0).'</div>
<br><div class="leftTabb">Date</div>  <div class="RightTabb">'.$usr_row['lgst_date'].'</div>
<br><div class="leftTabb">IP</div>  <div class="RightTabb">'.$usr_row['lgst_ip'].'</div>
<br><div class="leftTabb">OS</div> <div class="RightTabb"> '.$usr_row['lgst_os'].'</div>
<br><div class="leftTabb">Broswer</div>  <div class="RightTabb">'.$usr_row['lgst_bra'].'</div>
<br><div class="leftTabb">Broswer Info</div>  <div class="RightTabb">'.$usr_row['lgst_bra_info'].'</div>
<br><div class="leftTabb">Ref URL</div>  <div class="RightTabb">'.$usr_row['lgst_refurl'].'</div>
</div>
		
	</div><div class="UMenu">
	
	
	</div></div>';
	}
	
	
	$prevpage = $currentpage - 1;
	$nextpage = $currentpage + 1;
	echo '<div style="padding:10px;">';
	if(isset($_GET['page_refer']))
	{
		if($_GET['page_refer'] > 1)
		echo '<a class="DbMoreLimit" href="?'.($aid==TRUE? 'id='.$aid.'&amp;':'').'page_refer='.$prevpage.'">Back</a>';
		
	}
	echo '<a class="DbMoreLimit" href="?'.($aid==TRUE? 'id='.$aid.'&amp;':'').'page_refer='.$nextpage.'">See more</a>';
	echo '<br><br>';
	$range = 7;
	for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++)
	{
		if (($x > 0) && ($x <= $totalpages))
		{
			if ($x == $currentpage)
				echo '<span class="DbMoreLimitTagAct">[<b>'.$x.'</b>]</span> ';
			else
				echo '<a href="?'.($aid==TRUE? 'id='.$aid.'&amp;':'').'page_refer='.$x.'" class="DbMoreLimitTag">'.$x.'</a> '; 
		} 
	} 	
	echo '</div>';	
	
	
	
	
	
	
	
	
	
?>
</div>

</div></div></body>