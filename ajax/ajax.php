<?php
session_start();
if($_SESSION['login']!=true) header("Location: index.php?message=Log in."); 
else {
  include_once("../inc/loader.php");
   
  if (isset($_GET["action"]) && !empty($_GET["action"])) { //Da li postoji definisana i prosledjena akxija
	// Otvaramo konekciju ka bazi ako nam treba da imamo
	$aDB = new db();
    $action = $request->get['action'];
    switch($action) { //Switch u zavisnosti koja je akcija upitanju
	  
	   case "show_ph": 
		global $request,$aDB;
			$workdata = $request->get;
			foreach($workdata AS $name => $value){
				$workdata[$name] = $aDB->c($value);
			}
			if($workdata['state']=="N"){
				$state = "Y";
				$ph_show_css = "fa fa-eye-slash";
				$ph_show_js = "Hide";
			}elseif($workdata['state']=="Y"){
				$state = "N";
				$ph_show_css = "fa fa-eye";
				$ph_show_js = "Show";
			}
			$SQL = "UPDATE gallery SET ph_show='".$state."' WHERE id_ph = '".$workdata['id_ph']."' ";
			$aDB->query($SQL);
		 
			$result['show_ph']='<a class="btn btn-default" onclick="show_hide(\''.$state.'\','.$workdata['id_ph'].')"><i class="'.$ph_show_css.'"></i> '.$ph_show_js.'</a>
                            <a class="btn btn-default" onclick="sure('.$workdata['id_ph'].')"><i class="fa fa-times"></i> Delete</a>';

				//$data['id']=1;
				//$data['naslov']='vino 1';
				//$data['opis']="balbalbalbalba";
				//$data['cena']="123";
				
			  echo json_encode($result);
	  break;
	  
	  
	  default: 
		$return['error']='Nepostojeca akcija';
		echo json_encode($return);
	  break;
    }
  }
//}
  
  
 
 /* $results = mysql_query("SELECT para FROM content WHERE  para_ID='$id'");   
  if( mysql_num_rows($results) > 0 )
  {
   $row = mysql_fetch_array( $results );
   echo $row['para'];
  } */
 }
?>