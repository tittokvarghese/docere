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





class Profile
{
public static function xxxxxxx(){
}







public static function SearchDoc(){

	$return 		= '';
	$search_doc 	= MainFunc::Encrypt(MainFunc::filter($_POST['search_doc']));
	$implode	 	= implode("','",explode(",",$search_doc));



//echo $implode;
//exit;

/*$q	= "SELECT D.*,U.* FROM doctors D,users U  WHERE (U.fname LIKE '%".$search_doc."%' OR U.fname LIKE '%%".$search_doc."%' OR  U.lname LIKE '%".$search_doc."%' OR  U.lname LIKE '%%".$search_doc."%') AND D.doc_uid=U.uid	AND U.uact='1'	 	";*/



	if(isset($_POST['bysym']))
		$q	= "SELECT D.*, S.*, U.* FROM doctors D, symptoms S, users U  WHERE  
		S.sym_items IN('".$implode."') AND U.uid=S.sym_uid AND D.doc_uid=S.sym_uid 	 AND U.uact='1'
		GROUP BY S.sym_uid ORDER  BY S.symid DESC	 	";
	else if(isset($_POST['search_entry']))
		$q	= "SELECT D.*,U.* FROM doctors D,users U  WHERE CONCAT( U.fname,  ' ', U.lname ) LIKE  '%".$search_doc."%' 	
			 AND D.doc_uid=U.uid	AND U.uact='1'	 	";
			 
			 
			 
		 
			 
			 
	else
		$q	= "SELECT D.*,U.* FROM doctors D,users U  WHERE  D.doc_type='".$search_doc."'	 AND U.uid=D.doc_uid	AND U.uact='1'	";


	if(dbTKV::SQLNUM_ROWS(dbTKV::SQLQUERY($q)))
	{
		/* SHOW MORE SCRIPT	*/
			$offset	=	'0';
			$limit	=	'15';
	
			if(isset($_POST['see_more']))
			$offset	=	($_POST['see_more'] + $limit); // Limit set
		/* END SHOW MORE SCRIPT	*/
			
	$query_word = dbTKV::SQLQUERY("$q LIMIT $offset,$limit ");
	
	
	while($row  = dbTKV::SQL_FETCH($query_word))
	{
$return .= '

<div class="docBox" id="'.$row['uid'].'" services="'.($row['doc_services']==NULL ? 'Not Specified':str_replace("\n","<br>", $row['doc_services'])).'" memberships="'.($row['doc_member']==NULL ? 'Not Specified':str_replace("\n","<br>", $row['doc_member'])).'" about="'.($row['doc_about']==NULL ? 'Not Specified':str_replace("\n","<br>", $row['doc_about'])).'"><div class="docImg"><img src="'.MainFunc::GetProfilePic($row['uid']).'" class="docW" alt="..." align="absmiddle"></div><div class="docDiv"><div class="docTitle"><span>'.MainFunc::GetName($row['uid'],3).'</span><div class="docHigh">'.$row['doc_degree'].'</div></div><div class="docSpec">'.$row['doc_type'].'</div>

<div class="docLoc"><i class="fa fa-map-marker"></i> '.$row['ulocation'].'</div>
<div class="docDes"><i class="fa fa-money-bill-alt"></i> Consultation Fees: Rs. <strong>'.$row['doc_fee'].'</strong></div>

'.MainFunc::ShowTime($row['uid']).'


'.(MainFunc::isSession() ? '<a href="'.SITE_URL.'profiles/?id='.$row['uid'].'" class="docBut">Book Appointment</a>' : '').'


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
$return .=  '<span class="UsrLoadMore'.$offset.'"></span><div id="UsrLoadMore_ajax" href="admin/users/"  class="docSeeMore" limit="'.$offset.'">See More</div>';
		}
		
		
	} else
	$return .=  '<div align="center" style="padding:40px;background-color:#FFFFFF;"><b>No doctors found!</b></div>';

return $return;
}









}




	header("Location: ".SITE_URL."");
	exit;

?>