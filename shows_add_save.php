<?php
session_start();
if($_SESSION['login']!=true) header("Location: index.php?message=Log in."); 
else {
	include("inc/loader.php");
	include("inc/funkcije.php");
		//Ucitavamo mysql klasu
		if($_POST['place_name']!="" && $_POST['show_date']!=""){
			//$naslov = mysql_real_escape_string($_POST['naziv']);
			$place_name	= $request -> post['place_name'];
			$place_loc		= $request -> post['place_loc'];
			$show_date	= $request -> post['show_date'];
			$show_hour	= $request -> post['show_hour'];
			$show_mins	= $request -> post['show_mins'];
			// Pretvaramo datum iz forme i vreme u format koji nam odgovara za upis u bazu
			$datum = explode("-",$show_date); "dd-mm-yyyy";
			$sDate= $datum[2]."-".$datum[1]."-".$datum[0];
			$s_datetime = $sDate." ".$show_hour.":".$show_mins.":00";
			
			$idko = $_SESSION['sidko'];
			
			$vremec = time();
			
			
			// Unosimo novu kategoriju u bazu
			$DB = new db();
			$SQL = "INSERT INTO shows (
				place,
				gps_loc,
				show_time
			) VALUES( 
				'".$DB->c($place_name)."', 
				'".$DB->c($place_loc)."', 
				'".$DB->c($s_datetime)."'
			)";

			$result = $DB -> query($SQL);


			$DB -> close();
			$result=true;
			if ($result){
				$poruka = "Place and time successfully set!";
			}else{
				$poruka = "Error, Place and time is not set";
			}
			
		}else{
			$poruka = "Unauthorized direct access to the page!";
		}
		header("Location: shows.php?message=$poruka"); 

	}
?>
