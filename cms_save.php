<?php
session_start();
if($_SESSION['login']!=true) header("Location: index.php?message=Uloguj se."); 
else {
	include("inc/loader.php");
	include("inc/funkcije.php");
		//Ucitavamo mysql klasu
		if($_POST['id_page']!="" && $_POST['cms_text']!=""){
			//Treba mi id stranice koja se menja, BIO = 1, GALLERY = 2, CONTACT = 3 
			$id_page	= $request -> post['id_page'];
			if($id_page==1){
				$page= 'bio';
			}elseif($id_page==2){
				$page= 'gallery';
			}elseif($id_page==3){
				$page= 'contact';
			}
			$cms_text	= $request -> post['cms_text'];
			
			$idko = $_SESSION['sidko'];
			
			$vremec = time();
			
			if($_POST['seg_date']!=""){
				$middle_d = strtotime($seg_date); 
				$seg_date = date('Y-m-d', $middle_d);
			}else{
				$seg_date = date('Y-m-d' ,$vremec);
			}
			
			$vreme = date('d-m-y-H-i-s' ,$vremec);
			
			
			
			//Ispravke u bazi
			$DB = new db();
			$SQL = "UPDATE
							pages 
						SET
							content = '".$DB->c($cms_text)."'
						WHERE
							id_page = '".$DB->c($id_page)."' ";

			$result = $DB -> query($SQL);


			$DB -> close();
			$result=true;
			if ($result){
				$poruka = "Content changed!";
			}else{
				$poruka = "Error, Content is not changed";
			}
			
		}else{
			$poruka = "Unauthorized direct access to the page!";
		}
		header("Location: cms_".$page.".php?message=".$poruka.""); 

	}
?>
