<?php
session_start();
if($_SESSION['login']!=true) header("Location: index.php?message=Log in."); 
else {
	include("inc/loader.php");
	include("inc/funkcije.php");
		//Ucitavamo mysql klasu
		if($_GET['id_show']!=""){
		
			$id_show = $request -> get['id_show'];
			
			$DB = new db();
			$SQL = "DELETE FROM shows WHERE id_show='".$DB->c($id_show)."' LIMIT 1";

			$result = $DB -> query($SQL);
			$DB -> close();

			if ($result){
				$poruka = "Deleted!";
			}else{
				$poruka = "Error, not deleted!";
			}
		}else{
			$poruka = "Unauthorized direct access to the page!";
		}
		header("Location: shows.php?message=$poruka"); 
	}

?>
