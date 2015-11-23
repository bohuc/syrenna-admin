<?php
session_start();
if($_SESSION['login']!=true) header("Location: index.php?message=Log in."); 
else {
	include("inc/loader.php");
	include("inc/funkcije.php");
		//Ucitavamo mysql klasu
		if($_FILES["photo_file"]["error"]==0){
			//$naslov = mysql_real_escape_string($_POST['naziv']);
			$ph_name	= $request -> post['ph_name'];
			$ph_info		= $request -> post['ph_info'];
			$ph_type	= $request -> post['ph_type'];
			$ph_date	= $request -> post['ph_date'];
			
			if(isset($_POST['ph_show'])){
				$ph_show = 'Y';
			}else{
				$ph_show = 'N';
			}
			$idko = $_SESSION['sidko'];
			
			$vremec = time();
			
			if($_POST['ph_date']!=""){
				$middle_d = strtotime($ph_date); 
				$ph_date = date('Y-m-d', $middle_d);
			}else{
				$ph_date = date('Y-m-d' ,$vremec);
			}
			
			$idko = $_SESSION['sidko']; 

			//Upload slike
			$vreme = date('d-m-y-H-i-s' ,$vremec);
						
			// Pristupam $_FILES globalnoj promenljivoj uploadovane slike i izvlacim pojedinacne parametre
			$fileName = $_FILES["photo_file"]["name"]; // Ime fajla npr: slika.jpg
			$fileTmpLoc = $_FILES["photo_file"]["tmp_name"]; // Smestam fajl u PHP tmp folder
			$fileType = $_FILES["photo_file"]["type"]; // Tip slike img/jpg
			$fileSize = $_FILES["photo_file"]["size"]; // Velicina fajla u bajtovima
			$fileErrorMsg = $_FILES["photo_file"]["error"]; // Ispisuje gresku (0 za false... i 1 za true)
			$kaboom = explode(".", $fileName); // Razdvajam ime fajla u niz koristeci tacku kao razdelnik
			$first_value = reset($kaboom); // Iz prvog clana niza dobijam ime slike npr: slika
			$fileExt = end($kaboom); // Poslednji clan je ekstenzija npr: jpg

			if($fileErrorMsg == 0){
			// START PHP Upload Slike u zavisnosti od gresaka - Error Handling ---------------------
			if($fileSize > 5242880) { // ako je velicina fajla veca od 5MB
				echo "ERROR: Your file was larger than 5 Megabytes in size.";
				unlink($fileTmpLoc); // Ukloni fajl iz PHP temp foldera
				exit();
			} else if (!preg_match("/.(gif|jpg|png)$/i", $fileName) ) {
				 // Ogranicavamo na odredjene tipove slika jpg, gif i png   
				 echo "ERROR: Your image was not .gif, .jpg, or .png.";
				 unlink($fileTmpLoc); // Ukloni fajl iz PHP temp foldera
				 exit();
			} else if ($fileErrorMsg == 1) { // ako je greska uploadovanja jednaka 1
				echo "ERROR: An error occured while processing the file. Try again.";
				exit();
			}
			// END PHP Upload Slike u zavisnosti od gresaka - Error Handling ------------------------
			$photo = $first_value."-".$vreme.".".$fileExt;

			// Postavljamo sliku u "uploads" folder koristeci move_uploaded_file() funkciju, ali pre toga proveravamo da li folder postoji
			if (!is_dir('../img/gallery')) {
				mkdir('../img/gallery');
			}


			// ------------- START Resizing i Croping funkcije za sliku ----------------
			$target_file = $fileTmpLoc;
			$resized_file = "../img/gallery/".$first_value."-".$vreme.".".$fileExt;
			$wmax = 1000;
			$hmax = 800;
			ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);
			$target_file = $fileTmpLoc;
			$temp_file = "../img/gallery/mid_".$first_value."-".$vreme.".".$fileExt;
			$resized_file = "../img/gallery/thumb_".$first_value."-".$vreme.".".$fileExt;
			if($ph_type==1){
				$wmax = 360;
				$hmax = 360;
			}elseif($ph_type==2){
				$wmax = 551;
				$hmax = 551;
			}elseif($ph_type==3){
				$wmax = 720;
				$hmax = 360;
			}
			create_nimage($target_file, $temp_file, $resized_file, $wmax, $hmax, $fileExt);
			if(file_exists($target_file)) unlink($target_file);
			if(file_exists($temp_file)) unlink($temp_file);

			// -------------- End Resizing i Croping funkcije za sliku -----------------


			// Prikazujemo rezultate da bi smo mogli videti i testirati sta se desilo
			//echo "The file named <strong>$fileName</strong> uploaded successfuly.<br /><br />";
			//echo "It is <strong>$fileSize</strong> bytes in size.<br /><br />";
			//echo "It is an <strong>$fileType</strong> type of file.<br /><br />";
			//echo "The file extension is <strong>$fileExt</strong><br /><br />";
			//echo "The Error Message output for this upload is: $fileErrorMsg";
							
						}else{
							$photo='none';
						}
						// Kraj obrade u uploada slike
						
			
			
				// Unosimo novu kategoriju u bazu
				$DB = new db();
				$SQL = "INSERT INTO gallery (
				    ph_name,
				    ph_info,
					photo,
					ph_show,
					ph_datum,
					ph_type
				) VALUES( 
				    '".$DB->c($ph_name)."', 
				    '".$DB->c($ph_info)."', 
				    '".$DB->c($photo)."', 
				    '".$DB->c($ph_show)."', 
				    '".$DB->c($ph_date)."', 
				    '".$DB->c($ph_type)."'
				)";

				$result = $DB -> query($SQL);


				$DB -> close();
				$result=true;
				if ($result){
					$poruka = "image uploaded successfully!";
				}else{
					$poruka = "Error, Image is not uploaded, please try again";
				}
			
		}else{
			$poruka = "Unauthorized direct access to the page!";
		}
		header("Location: gallery2.php?message=$poruka"); 

	}
?>
