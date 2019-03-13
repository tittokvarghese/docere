<?php
/* 
 * Thank Jesus 
 * @Souce-code	TKV
 */


	if(isset($_POST['search_doc']))
	{
	echo Profile::SearchDoc();
	exit;
	}





class Profile{
public static function xxxxxxx(){
}





public static function ShowTime($uid){
	$get_doc_time = dbTKV::SQLQUERY("SELECT * FROM timetable WHERE tmt_uid='".$uid."' ORDER BY tmtid DESC ");
	$return ='';
	while($time_row  = dbTKV::SQL_FETCH($get_doc_time))
	{
 $return .=  ' <div class="docDes"><strong><i class="fa fa-clock"></i> '.$time_row['tmt_week'].'</strong><br>'.$time_row['tmt_fhh'].':'.$time_row['tmt_fmm'].''.$time_row['tmt_ftime'].' - '.$time_row['tmt_thh'].':'.$time_row['tmt_tmm'].''.$time_row['tmt_totime'].'</div>';
	}
return 	$return;
}


public static function SearchDoc(){

	$return 		= '';
	$search_doc 	= MainFunc::Encrypt(MainFunc::filter($_POST['search_doc']));
	$implode	 	= implode("','",explode(",",$search_doc));

	if(isset($_POST['bysym']))
		$q	= "SELECT D.*, S.*, U.* FROM doctors D, symptoms S, users U  WHERE  
		S.sym_items IN('".$implode."') AND U.uid=S.sym_uid AND D.doc_uid=S.sym_uid 	
		GROUP BY S.sym_uid ORDER  BY S.symid DESC	 	";
	else
		$q	= "SELECT D.*,U.* FROM doctors D,users U  WHERE  D.doc_type='".$search_doc."'	 AND U.uid=D.doc_uid		";


	if(dbTKV::SQLNUM_ROWS(dbTKV::SQLQUERY($q)))
	{
		/* SHOW MORE SCRIPT	*/
			$offset	=	'0';
			$limit	=	'10';
	
			if(isset($_POST['see_more']))
			$offset	=	($_POST['see_more'] + $limit); // Limit set
		/* END SHOW MORE SCRIPT	*/
			
	$query_word = dbTKV::SQLQUERY("$q LIMIT $offset,$limit ");
	
	
	while($row  = dbTKV::SQL_FETCH($query_word))
	{
$return .= '

<div class="docBox OpenDocProfile_ajax" id="'.$row['uid'].'" services="'.($row['doc_services']==NULL ? 'Not Specified':str_replace("\n","<br>", $row['doc_services'])).'" memberships="'.($row['doc_member']==NULL ? 'Not Specified':str_replace("\n","<br>", $row['doc_member'])).'" about="'.($row['doc_about']==NULL ? 'Not Specified':str_replace("\n","<br>", $row['doc_about'])).'"><div class="docImg"><img src="'.MainFunc::GetProfilePic($row['uid']).'" class="docW" alt="..." align="absmiddle"></div><div class="docDiv"><div class="docTitle"><span>'.MainFunc::GetName($row['uid'],3).'</span><div class="docHigh">'.$row['doc_degree'].'</div></div><div class="docSpec">'.$row['doc_type'].'</div>

<div class="docLoc"><i class="fa fa-map-marker"></i> '.$row['ulocation'].'</div>
<div class="docDes"><i class="fa fa-money-bill-alt"></i> Consultation Fees: Rs. <strong>'.$row['doc_fee'].'</strong></div>

'.self::ShowTime($row['uid']).'

<div class="docBut BookAppointment_ajax">Book Appointment</div>

<br><br><span id="BookAppointment'.$row['uid'].'"></span>

</div></div>';	
	}	
		
		if(dbTKV::SQLNUM_ROWS(dbTKV::SQLQUERY($q)) <= ($offset))
		{
		$return .=  '<div style="padding:10px;"></div>';
		}
		else
		{
			if(dbTKV::SQLNUM_ROWS(dbTKV::SQLQUERY($q)) >= $limit)
$return .=  '<span class="UsrLoadMore'.$offset.'"></span><div id="UsrLoadMore_ajax" href="admin/users/" action="'.$type.'" class="docSeeMore" limit="'.$offset.'">See More</div>';
		}
		
		
	} else
	$return .=  '<div align="center" style="padding:40px;background-color:#FFFFFF;"><b>No doctors found!</b></div>';

return $return;
























}









}




	header("Location: ".SITE_URL."");
	exit;

?>