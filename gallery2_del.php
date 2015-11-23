<?php
session_start();
if($_SESSION['login']!=true) header("Location: index.php?message=Log in."); 
else {
	include("inc/loader.php");
	include("inc/funkcije.php");
		//Ucitavamo mysql klasu
		if($_GET['id_ph']!=""){
		
			$id_ph = $request -> get['id_ph'];
			
			$DB = new db();
			$SQL = "SELECT photo FROM gallery WHERE id_ph='".$DB->c($id_ph)."' LIMIT 1";
			$DB -> query($SQL);
			$row = $DB -> fetch_assoc();
			$photo	= $row['photo'];
			
			//	Brisanje fajla koji se veze za ponudu 
				$filename="../img/gallery/$photo";
				if(file_exists($filename)) unlink($filename);
				
				$filename="../img/gallery/thumb_$photo";
				if(file_exists($filename)) unlink($filename);
				
			$SQL = "DELETE FROM gallery WHERE id_ph='".$DB->c($id_ph)."' LIMIT 1";

			$result = $DB -> query($SQL);
			$DB -> close();

			if ($result){
				$poruka = "image deleted!";
			}else{
				$poruka = "Error, no image deleted!";
			}
		}else{
			$poruka = "Unauthorized direct access to the page!";
		}
		header("Location: gallery2.php?message=".$poruka.""); 
	}

?>
