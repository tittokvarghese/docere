<?php
/* 
 * Thank Jesus 
 * @Souce-code	TKV
 */

$pageTitle="leaves";

Header::$action			=	"enable";
Header::$title			=	array("action"=>"1", "content"=>"Leaves | ADMIN CP - ".SITE_NAME);
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
?><div class="TabConts" style="background-color:#"><div class="AdPageTitle">Leaves</div><div style="margin-top:50px;"></div>
<?php

$aid='';
if(isset($_GET['id']))
{
	$aid=MainFunc::Encrypt(MainFunc::filter($_GET['id']));
	$re1d="SELECT * FROM  leaves WHERE lea_type='1' AND lea_did='".$aid."'		";
}
else
	$re1d="SELECT * FROM  leaves WHERE lea_type='1' ";


	$totalcount = dbTKV::SQLNUM_ROWS(dbTKV::SQLQUERY($re1d));
	$pagelimit = "10";
	$totalpages = ceil($totalcount / $pagelimit); 
	if (isset($_GET['page_refer']) && is_numeric($_GET['page_refer']) && $_GET['page_refer'] <= $totalpages)
		$currentpage=MainFunc::Encrypt($_GET['page_refer']);
    else 
    	$currentpage = 1;

    if ($currentpage < 1)
		$currentpage = $totalpages; 
	$offset = ($currentpage - 1) * $pagelimit;
	
	$get_doc_usr = dbTKV::SQLQUERY("$re1d ORDER BY leaid DESC  LIMIT $offset,$pagelimit");
	while($usr_row  = dbTKV::SQL_FETCH($get_doc_usr))
	{
	echo '<div class="UsersBox"><div class="Ud"><img src="'.MainFunc::GetProfilePic($usr_row['lea_did']).'" class="UdImg" alt="Image" align="absmiddle"></div><div class="UTitle">
	
	<a href="'.SITE_URL.'profile/?id='.$usr_row['lea_did'].'">'.MainFunc::GetName($usr_row['lea_did'],1).'</a>
	
	</div><div class="UMenu">
	
	<div class="UbuT Ubut5">
	
	'.$usr_row['lea_day'].'/'.$usr_row['lea_month'].'/'.$usr_row['lea_year'].' - '.$usr_row['lea_week'].'
	
	
	</div>
	
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