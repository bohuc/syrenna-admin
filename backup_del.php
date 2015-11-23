<?php
session_start();
if($_SESSION['login']!=true) header("Location: index.php?message=Log in");
else {
	include("inc/loader.php");
	include("inc/funkcije.php");
		//Ucitavamo mysql klasu
		if($_REQUEST['file']!=""){
			$filename="backup/".$_REQUEST['file'].".sql";
			if(file_exists($filename)) unlink($filename);
		}
header("Location: backup.php"); 
}

?>
