<?php
session_start();
if($_SESSION['login']!=true) header("Location: index.php?message=Log in."); 
else {
include("inc/loader.php");
include("inc/funkcije.php");
if($_REQUEST['download']!= 'true' && $_REQUEST['file']==''){
		//Ucitavamo mysql klasu
		include_once('inc/mysqli.class.php');

		$DB = new db();
		$DB2 = new db();
		// Strukturu tabele i nazive polja stavljamo u niz $struktura
		$struktura = array();
		$dbname=$site_config['mysql']['datebase'];
		$SQL = "SHOW TABLES FROM ".$dbname."";
		$row = $DB -> query($SQL);
		while ($row = $DB -> fetch_row()){	
			//Uzimamo polja iz tabele i stavljamo u niz
			$SQL = "SHOW COLUMNS FROM ".$row[0]."";
			$DB2 -> query($SQL);
			while($row2 = $DB2 -> fetch_row() ){
				$struktura[$row[0]][] = $row2[0];
			}
		}
		$DB2 -> close();



		;

		// Kreiramo izlaz za tabele koji cemo pisati u fajl
		$datum_backupa = date('d-m-Y_H-i-s');
		$filename=$datum_backupa."_".$dbname.".sql";
		$export = "";
		$export .=
		"# Backup ".$dbname." na dan ".$datum_backupa.";
# Ime fajla : ".$filename.";
#; 
# Generated by backup script by mangup@gmail.com;
";
		foreach($struktura AS $tabela => $polja){
			$koliko_polja = count($polja);
		//	echo $tabela.' - '.$koliko_polja.'<br />';
		//	$export .= "# Backup tabele ".$tabela."\n";
			$export .="TRUNCATE TABLE ".$tabela.";\n";

			$SQL = "SELECT * FROM ".$tabela."";
			$DB -> query($SQL);
			while ($row = $DB -> fetch_assoc()){
				// Spisak polja
				$temp_polja = " (";
				$temp_podaci = "(";
				for($i=0;$i<$koliko_polja;$i++){
					$temp_polja .= $polja[$i];
					$podatak =  mysql_escape_string($row[$polja[$i]]);
					$temp_podaci .="'".$podatak."'";
					if($i<=($koliko_polja-2))	$temp_polja .= ', ';
					if($i<=($koliko_polja-2))	$temp_podaci .= ', ';
				}
				$temp_polja .=")";
				$temp_podaci .=");";
				$export.= "REPLACE INTO ".$tabela." ".$temp_polja."  VALUES ".$temp_podaci."\n";
			}

			
		}


		$DB -> close();
		$file_url="backup/".$filename;
		$pFile = fopen($file_url, "w");
		fwrite($pFile, $export);
		fclose($pFile);

		Download($file_url);


	}else{
		$filename=$_REQUEST['file'].".sql";;
		$file_url="backup/".$filename;
		
		Download($file_url);
	}
}
function Download($file_url){
global $filename;

header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: aplication/txt");
header ("Content-Disposition: attachment; filename=\"$filename\"" );
header ("Content-Description: PHP/INTERBASE Generated Data" );
readfile($file_url);
exit;
}
?>