<?php
function arr2csv($a) {
	$s='';
	$n=count($a);
	foreach($a as $ertek) {
		$s.='"'.str_replace('"','""',$ertek).'"';
		$n--;
		if($n>0) $s.=',';
	}
	return ($s);
}

function show_session(){
	echo '<pre>';
	print_r($_SESSION);
	echo '</pre>';
}


// -------------- RESIZE FUNCTION -------------
// Function for resizing any jpg, gif, or png image files
function ak_img_resize($target, $newcopy, $w, $h, $ext) {
    list($w_orig, $h_orig) = getimagesize($target);
    $scale_ratio = $w_orig / $h_orig;
    if (($w / $h) > $scale_ratio) {
           $w = $h * $scale_ratio;
    } else {
           $h = $w / $scale_ratio;
    }
    $img = "";
    $ext = strtolower($ext);
    if ($ext == "gif"){ 
    $img = imagecreatefromgif($target);
    } else if($ext =="png"){ 
    $img = imagecreatefrompng($target);
    } else { 
    $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor($w, $h);
    // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
    imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
    if ($ext == "gif"){ 
        imagegif($tci, $newcopy);
    } else if($ext =="png"){ 
        imagepng($tci, $newcopy);
    } else { 
        imagejpeg($tci, $newcopy, 100);
    }
}
// ------------- THUMBNAIL (CROP) FUNCTION -------------
// Function for creating a true thumbnail cropping from any jpg, gif, or png image files
function ak_img_thumb1($target, $newcopy, $w, $h, $ext) {
    list($w_orig, $h_orig) = getimagesize($target);
    $src_x = -(($w_orig / 2) - ($w / 2));
    $src_y = -(($h_orig / 2) - ($h / 2));
    $ext = strtolower($ext);
    $img = "";
    if ($ext == "gif"){ 
    $img = imagecreatefromgif($target);
    } else if($ext =="png"){ 
    $img = imagecreatefrompng($target);
    } else { 
    $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor($w, $h);
	$bg = imagecolorallocate ( $tci, 255, 255, 255 );
                imagefill ( $tci, 0, 0, $bg );
    imagecopyresampled($tci, $img, $src_x, $src_y, 0, 0, $w_orig, $h_orig, $w_orig, $h_orig);
    if ($ext == "gif"){ 
        imagegif($tci, $newcopy);
    } else if($ext =="png"){ 
        imagepng($tci, $newcopy);
    } else { 
        imagejpeg($tci, $newcopy, 100);
    }
}

// ------------- THUMBNAIL (CROP) FUNCTION -------------
// Function for creating a true thumbnail cropping from any jpg, gif, or png image files
function ak_img_thumb($target, $newcopy, $w, $h, $ext) {
    list($w_orig, $h_orig) = getimagesize($target);
    $src_x = ($w_orig / 2) - ($w / 2);
    $src_y = ($h_orig / 2) - ($h / 2);
    $ext = strtolower($ext);
    $img = "";
    if ($ext == "gif"){ 
    $img = imagecreatefromgif($target);
    } else if($ext =="png"){ 
    $img = imagecreatefrompng($target);
    } else { 
    $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor($w, $h);
    imagecopyresampled($tci, $img, 0, 0, $src_x, $src_y, $w, $h, $w, $h);
    if ($ext == "gif"){ 
        imagegif($tci, $newcopy);
    } else if($ext =="png"){ 
        imagepng($tci, $newcopy);
    } else { 
        imagejpeg($tci, $newcopy, 100);
    }
}


// --------------------- SECENJE SLIKE BEZ PRAZNINE ----------------------
function create_nimage($target, $tempcopy, $newcopy, $w, $h, $ext){
	list($w_orig, $h_orig) = getimagesize($target);
    $scale_ratio = $w_orig / $h_orig;
    if (($w / $h) > $scale_ratio) {	
	
		$hon = $w / $scale_ratio;
		$won = $w;
		
    } else {
		
           $hon = $h;
           $won = $h * $scale_ratio;
    }
	
	$img = "";
	$ext = strtolower($ext);
	if ($ext == "gif"){ 
		$img = imagecreatefromgif($target);
	} else if($ext =="png"){ 
		$img = imagecreatefrompng($target);
	} else { 
		$img = imagecreatefromjpeg($target);
	}
	$tci = imagecreatetruecolor($won, $hon);
	// imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
	imagecopyresampled($tci, $img, 0, 0, 0, 0, $won, $hon, $w_orig, $h_orig);
	if ($ext == "gif"){ 
		imagegif($tci, $tempcopy);
	} else if($ext =="png"){ 
		imagepng($tci, $tempcopy);
	} else { 
		imagejpeg($tci, $tempcopy, 100);
	}
	
	
	$src_x = ($won / 2) - ($w / 2);
	$src_y = ($hon / 2) - ($h / 2);
	$img = "";
	if ($ext == "gif"){ 
		$img = imagecreatefromgif($tempcopy);
	} else if($ext =="png"){ 
		$img = imagecreatefrompng($tempcopy);
	} else { 
		$img = imagecreatefromjpeg($tempcopy);
	}
	$tci = imagecreatetruecolor($w, $h);
	imagecopyresampled($tci, $img, 0, 0, $src_x, $src_y, $w, $h, $w, $h);
	if ($ext == "gif"){ 
		imagegif($tci, $newcopy);
	} else if($ext =="png"){ 
		imagepng($tci, $newcopy);
	} else { 
		imagejpeg($tci, $newcopy, 100);
	}
}


function set_thumb($file, $photos_dir='../images/bilbordi',$thumbs_dir='../images/bilbordi', $square_size=400, $quality=100) {
        //check if thumb exists
      
                //get image info
                list($width, $height, $type, $attr) = getimagesize($photos_dir."/".$file);
                
                //set dimensions
                if($width> $height) {
                        $width_t=$square_size;
                        //respect the ratio
                        $height_t=round($height/$width*$square_size);
                        //set the offset
                        $off_y=ceil(($width_t-$height_t)/2);
                        $off_x=0;
                } elseif($height> $width) {
                        $height_t=$square_size;
                        $width_t=round($width/$height*$square_size);
                        $off_x=ceil(($height_t-$width_t)/2);
                        $off_y=0;
                }
                else {
                        $width_t=$height_t=$square_size;
                        $off_x=$off_y=0;
                }
                                
                $thumb=imagecreatefromjpeg($photos_dir."/".$file);
                $thumb_p = imagecreatetruecolor($square_size, $square_size);
                //default background is black
                $bg = imagecolorallocate ( $thumb_p, 255, 255, 255 );
                imagefill ( $thumb_p, 0, 0, $bg );
                imagecopyresampled($thumb_p, $thumb, $off_x, $off_y, 0, 0, $width_t, $height_t, $width, $height);
				imagejpeg($thumb_p,$thumbs_dir."/large_".$file,$quality);
				$thumb=imagecreatefromjpeg($thumbs_dir."/large_".$file);
				$thumb_r = imagecreatetruecolor('600', '400');
				$bg = imagecolorallocate ( $thumb_r, 255, 255, 255 );
                imagefill ( $thumb_r, 0, 0, $bg );
                imagecopyresampled($thumb_r, $thumb, 100, 0, 0, 0, $square_size, $square_size, $square_size, $square_size);
                imagejpeg($thumb_r,$thumbs_dir."/large_".$file,$quality);
              
}

function upload_slike($target, $newcopy, $ext) {
    list($w_orig, $h_orig) = getimagesize($target);
	if($h_orig<150){
		$height_t=150;
		$width_t=$w_orig;
		$off_y=ceil(($height_t-$h_orig)/2);
		$off_x=0;
	}
	elseif($w_orig<150) {
		$height_t=$h_orig;
		$width_t=150;
		$off_x=ceil(($width_t-$w_orig)/2);
		$off_y=0;
	}else{
		$width_t=$w_orig;
		$height_t=$h_orig;
		$off_x=$off_y=0;
		}
    $ext = strtolower($ext);
    $img = "";
    if ($ext == "gif"){ 
    $img = imagecreatefromgif($target);
    } else if($ext =="png"){ 
    $img = imagecreatefrompng($target);
    } else { 
    $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor(150, 150);
	$bg = imagecolorallocate ( $tci, 255, 255, 255 );
                imagefill ( $tci, 0, 0, $bg );
    imagecopyresampled($tci, $img, $off_x, $off_y, 0, 0, $w_orig, $h_orig, $w_orig, $h_orig);
    if ($ext == "gif"){ 
        imagegif($tci, $newcopy);
    } else if($ext =="png"){ 
        imagepng($tci, $newcopy);
    } else { 
        imagejpeg($tci, $newcopy, 100);
    }
}

function upload_slike2($target, $newcopy, $ext) {
    list($w_orig, $h_orig) = getimagesize($target);
	if($h_orig<200){
		$height_t=200;
		$width_t=$w_orig;
		$off_y=ceil(($height_t-$h_orig)/2);
		$off_x=0;
	}
	elseif($w_orig<300) {
		$height_t=$h_orig;
		$width_t=300;
		$off_x=ceil(($width_t-$w_orig)/2);
		$off_y=0;
	}else{
		$width_t=$w_orig;
		$height_t=$h_orig;
		$off_x=$off_y=0;
		}
    $ext = strtolower($ext);
    $img = "";
    if ($ext == "gif"){ 
    $img = imagecreatefromgif($target);
    } else if($ext =="png"){ 
    $img = imagecreatefrompng($target);
    } else { 
    $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor(300, 200);
	$bg = imagecolorallocate ( $tci, 255, 255, 255 );
                imagefill ( $tci, 0, 0, $bg );
    imagecopyresampled($tci, $img, $off_x, $off_y, 0, 0, $w_orig, $h_orig, $w_orig, $h_orig);
    if ($ext == "gif"){ 
        imagegif($tci, $newcopy);
    } else if($ext =="png"){ 
        imagepng($tci, $newcopy);
    } else { 
        imagejpeg($tci, $newcopy, 100);
    }
}


function makeSeoTitle($title)

{

$divider = '-';
$title = trim($title);
$title = manEncode($title);
$title = str_replace(" ","-",$title);
$title = str_replace("/","-",$title);
$title = str_replace("&","-",$title);
$title = str_replace("'","-",$title);
$title = str_replace('"',"-",$title);
$title = str_replace("?","-",$title);
$title = str_replace("!","-",$title);
$title = str_replace("[","",$title);
$title = str_replace("]","",$title);
$title = str_replace("\\","-",$title);
$title = str_replace("%","",$title);
$title = str_replace(".","",$title);
/*
if(count($bad_words)>0)
{
$reg_expr = create_reg($bad_words);
$title = preg_replace($reg_expr,' ',$title);
}
$title = preg_replace("/(^|&\S+;)|(<[^>]*>)/U","",$title);
$title = strtolower(preg_replace('/[\s\-]+/', $divider, trim(preg_replace('/[^\w\s\-]/', '', $title))));
$title = preg_replace("/[^A-Za-z0-9\-]/","",$title);*/

return $title;
}


function manEncode($str) {

	$letters = array ("č","ć");
	$str= str_replace($letters,"c",$str);
	$letters = array ("Č","Ć");
	$str= str_replace($letters,"c",$str);
	$str= str_replace("š","s",$str);
	$str= str_replace("ž","z",$str);
	$str= str_replace("đ","dj",$str);
	$str= str_replace("Š","s",$str);
	$str= str_replace("Ž","z",$str);
	$str= str_replace("Đ","dj",$str);
	$str= str_replace("Đ","dj",$str);
	$str= str_replace("ü","u",$str);
	$str= str_replace("Ü","ü",$str);
	$str= str_replace("ä","a",$str);
	$str= str_replace("Ä","a",$str);
	$str= str_replace("ö","o",$str);
	$str= str_replace("Ö","o",$str);
	$str= str_replace("ß","ss",$str);
	return $str;
}

function p($data){
      // Za lepsi prikaz array-a kod debug-a
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function human_filesize($bytes, $decimals = 2) {
  $sz = 'BKMGTP';
  $factor = floor((strlen($bytes) - 1) / 3);
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . ' '.@$sz[$factor];
}

function trundacefile($file){
    //open file to write
    $fp = fopen(DIR_LOGS."/".$file, "r+");
    // clear content to 0 bits
    ftruncate($fp, 0);
    //close file
    fclose($fp);
}

function getCityName($id,$DB){
	$SQL="SELECT name FROM cities WHERE id_cit = '".$DB->c($id)."' LIMIT 1";
	$DB->query($SQL);
	while($row = $DB -> fetch_assoc()){
		$name = $row['name'];
	}
	return $name;
}
function getPostData($id,$DB){
	$SQL="SELECT name,plz FROM bezirks WHERE id = '".$DB->c($id)."' LIMIT 1";
	$DB->query($SQL);
	while($row = $DB -> fetch_assoc()){
		$name = $row['plz'].' '.$row['name'];
	}
	return $name;
}

function getCarName($id,$DB){
	$SQL="SELECT veh_name FROM vehicle WHERE id_veh = '".$DB->c($id)."' LIMIT 1";
	$DB->query($SQL);
	while($row = $DB -> fetch_assoc()){
		$name = $row['veh_name'];
	}
	return $name;
}

function getPlaneNumber($id,$DB){
    $SQL="SELECT flight_number FROM flights WHERE id = '".$DB->c($id)."' LIMIT 1";
    $DB->query($SQL);
    while($row = $DB -> fetch_assoc()){
        $flight_number = $row['flight_number'];
    }
    return $flight_number;
}

function getCityFrom($id,$DB){
    $SQL="SELECT name FROM flightcities WHERE id = '".$DB->c($id)."' LIMIT 1";
    $DB->query($SQL);
    while($row = $DB -> fetch_assoc()){
        $name = $row['name'];
    }
    return $name;
}

function getDriverName($id,$DB){
    $SQL="SELECT ime FROM korisnik WHERE idko = '".$DB->c($id)."' LIMIT 1";
    $DB->query($SQL);
    while($row = $DB -> fetch_assoc()){
        $name = $row['ime'];
    }
    return $name;
}
function getDriverData($id,$DB){
    $SQL="SELECT * FROM korisnik WHERE idko = '".$DB->c($id)."' LIMIT 1";
    $DB->query($SQL);
    $row = $DB -> fetch_assoc();
    //while($row = $DB -> fetch_assoc()){
    //    $name = $row['ime'];

   // }
    return $row;
}



//Funkcija za prikaz segmenata u listi
function seg_list($folder,$swork_name,$work,$swork_mpic){ ?>

	<!-- Page Header -->
	<div class="content bg-gray-lighter">
		<div class="row items-push">
			<div class="col-sm-7">
				<h1 class="page-heading">
				   Radovi <small>Lista segmenata za rad: </small> <?php echo $swork_name; ?> <img class="img-avatar img-avatar48" src="<?php echo $swork_mpic; ?>" alt="<?php echo $swork_name; ?>"> <button class="btn btn-minw btn-primary" type="button" onclick="location.href='works.php?loc=3&work=<?php echo $work; ?>';">Dodaj novi segment</button>
				</h1>
			</div>
			<div class="col-sm-5 text-right hidden-xs">
				<ol class="breadcrumb push-10-t">
					 <li>Radovi</li>
					<li><a class="link-effect" href="works.php">Lista</a></li>
					<li><a class="link-effect" href="works.php?loc=2&work=<?php echo $work; ?>">Segmenti</a></li>
				</ol>
			</div>
		</div>
	</div>
	<!-- END Page Header -->

	<!-- Page Content -->
	<div class="content">
		<!-- <h2 class="content-heading">Your content</h2> -->
		 <!-- Striped Table -->
				<div class="block">
					<div class="block-content">
						<table class="table table-striped  table-vcenter">
							<thead>
								<tr>
									<th class="text-center" style="width: 50px;">#</th>
									<th>Naziv</th>
									<th class="hidden-xs" style="width: 15%;">Tip</th>
									<th class="hidden-xs" style="width: 15%;">Prikaži</th>
									<th class="text-center" style="width: 100px;">Akcija</th>
								</tr>
							</thead>
							<tbody>
	<?php
	$DB = new db();
	$SQL = "SELECT 
					segments.id_seg AS id_seg,
					segments.id_work AS id_work,
					segments.seg_name AS seg_name,
					segments.seg_tekst AS seg_tekst,
					segments.seg_photo_1 AS seg_photo_1,
					segments.seg_photo_2 AS seg_photo_2,
					segments.seg_date AS seg_date,
					segments.seg_type AS seg_type,
					segments.seg_show AS seg_show,
					works.work_name AS work_name
				FROM segments
				LEFT JOIN works ON(works.id_work=segments.id_work)
				WHERE segments.id_work='".$DB->c($work)."'
				ORDER BY segments.id_seg ASC";
	$DB -> query($SQL);
	while($row = $DB -> fetch_assoc()){
		$id_seg_l		= $row['id_seg'];
		$id_work_l		= $row['id_work'];
		$seg_name		= $row['seg_name'];
		$seg_photo_1 = '../images/work/thumb_'.$row['seg_photo_1'];
			// Proveravam dal slika postoji ili ne , ako nepostoji ucitavamo onu noimage i menjamo boju reda.
				if(file_exists($seg_photo_1)){
				$seg_photo_1 = $seg_photo_1;
			}else{
				$seg_photo_1 = $folder . '/img/avatars/avatar3.jpg';
			}
		$seg_photo_2 = '../images/work/thumb_'.$row['seg_photo_2'];
			// Proveravam dal slika postoji ili ne , ako nepostoji ucitavamo onu noimage i menjamo boju reda.
				if(file_exists($seg_photo_2)){
				$seg_photo_2 = $seg_photo_2;
			}else{
				$seg_photo_2 = $folder . '/img/avatars/avatar3.jpg';
			}
		$seg_type		= $row['seg_type'];
		if($seg_type==1){
			$seg_type = "Full tekst";
			$photos = '';
		}elseif($seg_type==2){
			$seg_type = "Full slika";
			$photos = '<img class="img-avatar img-avatar48" src="'.$seg_photo_1.'" alt="">';
		}elseif($seg_type==3){
			$seg_type = "Slika levo";
			$photos = '<img class="img-avatar img-avatar48" src="'.$seg_photo_1.'" alt=""> <img class="img-avatar img-avatar48" src="'.$seg_photo_2.'" alt="">';
		}elseif($seg_type==4){
			$seg_type = "Slika desno";
			$photos = '<img class="img-avatar img-avatar48" src="'.$seg_photo_2.'" alt=""> <img class="img-avatar img-avatar48" src="'.$seg_photo_1.'" alt="">';
		}elseif($seg_type==5){
			$seg_type = "Dve slike";
			$photos = '<img class="img-avatar img-avatar48" src="'.$seg_photo_1.'" alt=""> <img class="img-avatar img-avatar48" src="'.$seg_photo_2.'" alt="">';
		}
		$work_name_l	= $row['work_name'];
		$seg_show		= $row['seg_show'];
		if($seg_show=='Y'){
			$seg_show = ' checked';
		}else{
			$seg_show = '';
		}
	?>
								<tr>
									<td class="text-center"><?php echo $id_seg_l; ?> </td>
									<td><?php echo $seg_name; ?> <?php echo $photos; ?></td>
									<td class="hidden-xs">
										<?php echo $seg_type; ?>
									</td>
							  <td class="hidden-xs">
									<label class="css-input switch switch-sm switch-primary">
										<input type="checkbox" <?php echo $seg_show; ?> onchange="toggleCheckbox(this,<?php echo $id_seg_l;?>)" ><span></span>
									</label>
									</td>
									<td class="text-center">
										<div class="btn-group">
											<button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Izmeni segment" onclick="location.href='works.php?loc=4&seg_id=<?php echo $id_seg_l;?>';"><i class="fa fa-pencil"></i></button>
											<button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Ukloni segment" onclick="sure(<?php echo $id_seg_l;?>)"><i class="fa fa-times"></i></button>
										</div>
									</td>
								</tr>
	<?php	
	}
	$DB -> close();
	?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- END Striped Table -->
	</div>
	<!-- END Page Content -->
<script>
function toggleCheckbox(element,id_seg)
 {
  var state = element.checked ? 'Y' : 'N'; 
   $.ajax({
		type: 'get',
		url: "ajax/ajax.php?action=show_seg&id_seg="+id_seg+"&state="+state,
		cache: false,
		success: function(result){
			var detail = jQuery.parseJSON(result);
			//alert(detail.show_seg);
			//alert("#show_cat"+id);
			//$("#show_seg"+id).html(detail.show_seg);
		}
	});
 }
</script>
<script>
function sure(id)
{
var agree=confirm("Attention!\nDa li si siguran da želiš da ukloniš ovaj segment?\n (sa komplernim sadržajem)");
if (agree)
	window.location.href = "segments_del.php?id_seg="+id;
else
	return false ;
}
</script>

	<?php
	}
	
	
function add_seg($swork_name,$work,$swork_mpic){
	?>
	  

<script>
window.onload = function() {
cell1 = document.getElementById("cell1");
cell1.style.display = "none";
cell2 = document.getElementById("cell2");
cell2.style.display = "none";
cell3 = document.getElementById("cell3");
cell3.style.display = "none";
document.getElementById('vrdob1').onchange = disablefield;
document.getElementById('vrdob2').onchange = disablefield;
document.getElementById('vrdob3').onchange = disablefield;
document.getElementById('vrdob4').onchange = disablefield;
document.getElementById('vrdob5').onchange = disablefield;
}

function disablefield()
{
if ( document.getElementById('vrdob1').checked == true ){
cell1 = document.getElementById("cell1");
cell1.style.display = "block";
cell2 = document.getElementById("cell2");
cell2.style.display = "none";
cell3 = document.getElementById("cell3");
cell3.style.display = "none";}
else if (document.getElementById('vrdob2').checked == true ){
cell1 = document.getElementById("cell1");
cell1.style.display = "none";
cell2 = document.getElementById("cell2");
cell2.style.display = "block";
cell3 = document.getElementById("cell3");
cell3.style.display = "none";}
else if (document.getElementById('vrdob3').checked == true ){
cell1 = document.getElementById("cell1");
cell1.style.display = "block";
cell2 = document.getElementById("cell2");
cell2.style.display = "block";
cell3 = document.getElementById("cell3");
cell3.style.display = "none";}
else if (document.getElementById('vrdob4').checked == true ){
cell1 = document.getElementById("cell1");
cell1.style.display = "block";
cell2 = document.getElementById("cell2");
cell2.style.display = "block";
cell3 = document.getElementById("cell3");
cell3.style.display = "none";}
else if (document.getElementById('vrdob5').checked == true ){
cell1 = document.getElementById("cell1");
cell1.style.display = "none";
cell2 = document.getElementById("cell2");
cell2.style.display = "block";
cell3 = document.getElementById("cell3");
cell3.style.display = "block";}
}

</script>
<!-- Page Header -->
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">
                Radovi <small>Dodavanje novog segmenta.</small> <?php echo $swork_name; ?> <img class="img-avatar img-avatar48" src="<?php echo $swork_mpic; ?>" alt="<?php echo $swork_name; ?>">
            </h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li>Radovi</li>
                <li><a class="link-effect" href="works.php">Lista</a></li>
                <li><a class="link-effect" href="works.php?loc=2&work=<?php echo $work; ?>">Segmenti</a></li>
                <li><a class="link-effect" href="works.php?loc=3&work=<?php echo $work; ?>">Dodaj novi segment</a></li>
            </ol>
        </div>
    </div>
</div>
<!-- END Page Header -->

<!-- Page Content -->
<div class="content">
    <!-- <h2 class="content-heading">Your content</h2> -->
    <div class="col-sm-6 col-sm-offset-3">
            <!-- Floating Labels -->
            <div class="block">
                <div class="block-content block-content-narrow">
                    <form class="js-validation-material form-horizontal push-10-t" action="segments_add_save.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                        <div class="form-group has-info">
                            <div class="col-xs-12">
                                <div class="form-material floating">
                                    <input class="form-control" type="text" id="seg_name" name="seg_name">
                                    <label for="seg_name">Naziv segmenta</label>
                                </div>
                            </div>
					</div>
					<div class="form-group has-info">
                                <label class="col-xs-12">Prikaz</label>
                            <div class="col-xs-12">
                                <label class="radio-inline" for="vrdob1">
                                    <input type="radio" id="vrdob1" name="vrdob" value="1"> Full Tekst
                                </label>
                                <label class="radio-inline" for="vrdob2">
                                    <input type="radio" id="vrdob2" name="vrdob" value="2"> Full Slika
                                </label>
                                <label class="radio-inline" for="vrdob3">
                                    <input type="radio" id="vrdob3" name="vrdob" value="3"> Slika Levo
                                </label>
                                <label class="radio-inline" for="vrdob4">
                                    <input type="radio" id="vrdob4" name="vrdob" value="4"> Slika Desno
                                </label>
                                <label class="radio-inline" for="vrdob5">
                                    <input type="radio" id="vrdob5" name="vrdob" value="5"> Dve slike
                                </label>
                            </div>
					</div>
					<div class="form-group has-info"  id="cell1">
                            <div class="col-xs-12">
                                <div class="form-material floating">
                                    <textarea id="js-ckeditor" name="seg_tekst" id="seg_tekst"></textarea>

                                </div>
                            </div>
					</div>
					<div class="form-group has-info"  id="cell2">
					  <label class="col-xs-12" for="seg_file1">Slika</label>
                            <div class="col-xs-12">
                                <div class="form-material floating">
                                       <input type="file" id="seg_file1" name="seg_file1">
                                   </div>
                                </div>
					</div>
					<div class="form-group has-info"  id="cell3">
					  <label class="col-xs-12" for="seg_file2">Druga slika</label>
                            <div class="col-xs-12">
                                <div class="form-material floating">
                                       <input type="file" id="seg_file2" name="seg_file2">
                                   </div>
                                </div>
					</div>
					<div class="form-group has-info">
                            <div class="col-xs-12">
						<label class="css-input switch switch-sm switch-primary">
							<input type="checkbox" checked name="seg_show" id="seg_show"><span></span> Prikaži u sadržaju
						</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-9">
                                <input type="hidden" name="id_work" id="id_work" value="<?php echo $work; ?>">
                                <button class="btn btn-sm btn-primary" type="submit">Dodaj</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Floating Labels -->
        </div>
</div>
<!-- END Page Content -->
<?php
}



function change_seg($folder,$id_seg){

$sDB = new db();
$sSQL = "SELECT
				segments.id_work AS id_work,
				segments.seg_name AS seg_name,
				segments.seg_tekst AS seg_tekst,
				segments.seg_photo_1 AS seg_photo_1,
				segments.seg_photo_2 AS seg_photo_2,
				segments.seg_date AS seg_date,
				segments.seg_type AS seg_type,
				segments.seg_show AS seg_show,
				works.work_name AS work_name,
				works.work_mpic AS work_mpic
			FROM segments
			LEFT JOIN works ON(segments.id_work=works.id_work)
			WHERE segments.id_seg='".$sDB->c($id_seg)."' LIMIT 1";
$sDB -> query($sSQL);
$srow = $sDB -> fetch_assoc();
$s_id_work		= $srow['id_work'];
$seg_name		= $srow['seg_name'];
$seg_tekst		= $srow['seg_tekst'];
$seg_photo_1 = '../images/work/thumb_'.$srow['seg_photo_1'];
	// Proveravam dal slika postoji ili ne , ako nepostoji ucitavamo onu noimage i menjamo boju reda.
		if(file_exists($seg_photo_1)){
		$seg_photo_1 = $seg_photo_1;
		$seg_photo_1r = $srow['seg_photo_1'];
	}else{
		$seg_photo_1 = $folder . '/img/avatars/avatar3.jpg';
		$seg_photo_1r = 'nema.jpg';
	}
$seg_photo_2 = '../images/work/thumb_'.$srow['seg_photo_2'];
	// Proveravam dal slika postoji ili ne , ako nepostoji ucitavamo onu noimage i menjamo boju reda.
		if(file_exists($seg_photo_2)){
		$seg_photo_2 = $seg_photo_2;
		$seg_photo_2r = $srow['seg_photo_2'];
	}else{
		$seg_photo_2 = $folder . '/img/avatars/avatar3.jpg';
		$seg_photo_2r = 'nema.jpg';
	}
$seg_date		= $srow['seg_date'];
$seg_type		= $srow['seg_type'];
if($seg_type==1){
	$cell1 = ' style="display:block;"';
	$cell2 = ' style="display:none;"';
	$cell3 = ' style="display:none;"';
}elseif($seg_type==2){
	$cell1 = ' style="display:none;"';
	$cell2 = ' style="display:block;"';
	$cell3 = ' style="display:none;"';		
}elseif($seg_type==3){
	$cell1 = ' style="display:block;"';
	$cell2 = ' style="display:block;"';
	$cell3 = ' style="display:none;"';	
}elseif($seg_type==4){
	$cell1 = ' style="display:block;"';
	$cell2 = ' style="display:block;"';
	$cell3 = ' style="display:none;"';	
}elseif($seg_type==5){
	$cell1 = ' style="display:none;"';
	$cell2 = ' style="display:block;"';
	$cell3 = ' style="display:block;"';	
}
$seg_show		= $srow['seg_show'];
$work_name	= $srow['work_name'];
$work_mpic		= '../images/work/thumb_'.$srow['work_mpic'];
	// Proveravam dal slika postoji ili ne , ako nepostoji ucitavamo onu noimage i menjamo boju reda.
		if(file_exists($work_mpic)){
		$work_mpic = $work_mpic;
		$work_mpicr = $srow['work_mpic'];
	}else{
		$work_mpic = $folder . '/img/avatars/avatar3.jpg';
		$work_mpicr = 'nema.jpg';
	}
$sDB -> close();
?>
<!-- Page Header -->
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">
                Radovi <small>Izmena postojeceg segmenta za rad.</small> <?php echo $work_name; ?> <img class="img-avatar img-avatar48" src="<?php echo $work_mpic; ?>" alt="<?php echo $work_name; ?>">
            </h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li>Radovi</li>
                <li><a class="link-effect" href="works.php">Lista</a></li>
                <li><a class="link-effect" href="works.php?loc=2&work=<?php echo $s_id_work; ?>">Segmenti</a></li>
                <li><a class="link-effect" href="works.php?loc=4&seg_id=<?php echo $id_seg; ?>">Izmeni segment</a></li>
            </ol>
        </div>
    </div>
</div>
<!-- END Page Header -->

<!-- Page Content -->
<div class="content">
    <!-- <h2 class="content-heading">Your content</h2> -->
    <div class="col-sm-6 col-sm-offset-3">
            <!-- Floating Labels -->
            <div class="block">
                <div class="block-content block-content-narrow">
                    <form class="js-validation-material form-horizontal push-10-t" action="segments_edit_save.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                        <div class="form-group has-info">
                            <div class="col-xs-12">
                                <div class="form-material floating">
                                    <input class="form-control" type="text" id="seg_name" name="seg_name" value="<?php echo $seg_name; ?>">
                                    <label for="seg_name">Naziv segmenta</label>
                                </div>
                            </div>
					</div>
					<div class="form-group has-info" id="cell1" <?php echo $cell1; ?>>
                            <div class="col-xs-12">
                                <div class="form-material floating">
                                    <textarea id="js-ckeditor" name="seg_tekst" id="seg_tekst"><?php echo $seg_tekst; ?></textarea>

                                </div>
                            </div>
					</div>
					<div class="form-group has-info"  id="cell2" <?php echo $cell2; ?>>
					  <label class="col-xs-12" for="seg_file1">Slika</label>
                            <div class="col-xs-12">
							<img src="<?php echo $seg_photo_1; ?>" border="0" />
                                <div class="form-material floating">
                                       <input type="file" id="seg_file1" name="seg_file1">
								<input type="hidden" name="seg_file1r" id="seg_file1r" value="<?php echo $seg_photo_1r; ?>" />
                                   </div>
                                </div>
					</div>
					<div class="form-group has-info"  id="cell3" <?php echo $cell3; ?>>
					  <label class="col-xs-12" for="seg_file2">Druga slika</label>
                             <div class="col-xs-12">
							<img src="<?php echo $seg_photo_2; ?>" border="0" />
                                <div class="form-material floating">
                                       <input type="file" id="seg_file2" name="seg_file2">
								<input type="hidden" name="seg_file2r" id="seg_file2r" value="<?php echo $seg_photo_2r; ?>" />
                                   </div>
                                </div>
					</div>
                        <div class="form-group">
                            <div class="col-sm-9">
                                <input type="hidden" name="id_work" id="id_work" value="<?php echo $s_id_work; ?>">
                                <input type="hidden" name="id_seg" id="id_seg" value="<?php echo $id_seg; ?>">
                                <input type="hidden" name="seg_type" id="seg_type" value="<?php echo $seg_type; ?>">
                                <button class="btn btn-sm btn-primary" type="submit">Izmeni</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Floating Labels -->
        </div>
</div>
<!-- END Page Content -->
<?php
}



function work_list($folder){
?> 
<!-- Page Header -->
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">
                Radovi <small>Spisak ilustracija, dizajna, fotografija.</small>
            </h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li>Radovi</li>
                <li><a class="link-effect" href="works.php">Lista</a></li>
            </ol>
        </div>
    </div>
</div>
<!-- END Page Header -->

<!-- Page Content -->
<div class="content content-boxed">
    <!-- <h2 class="content-heading">Your content</h2> -->
   <!-- Table Sections (.js-table-sections class is initialized in App() -> uiHelperTableToolsSections()) -->
    <div class="block">
        <div class="block-header">
         <div class="block-content">
            <!--
            Separate your table content with multiple tbody sections. Add one row and add the class .js-table-sections-header to a
            tbody section to make it clickable. It will then toggle the next tbody section which can have multiple rows. Eg:

            <tbody class="js-table-sections-header">One row</tbody>
            <tbody>Multiple rows</tbody>
            <tbody class="js-table-sections-header">One row</tbody>
            <tbody>Multiple rows</tbody>
            <tbody class="js-table-sections-header">One row</tbody>
            <tbody>Multiple rows</tbody>

            You can also add the class .open in your tbody.js-table-sections-header to make the next tbody section visible by default
            -->
            <table class="js-table-sections table table-hover  table-vcenter">
                <thead>
                    <tr>
                        <th style="width: 30px;"></th>
                        <th class="text-center" style="width: 100px;"><i class="si si-grid"></i></th>
                        <th>Naslov</th>
                        <th style="width: 15%;" class="hidden-xs text-center">Kategorija/boja</th>
                        <th class="hidden-xs" style="width: 15%;">Datum</th>
                        <th class="text-center" style="width: 100px;">Akcija</th>
                    </tr>
                </thead>

<?php
$DB = new db();
$SQL = "SELECT 
				works.id_work AS id_work,
				works.id_cat AS id_cat,
				works.work_name AS work_name,
				works.work_desc AS work_desc,
				works.work_color AS work_color,
				works.work_date AS work_date,
				works.work_mpic AS work_mpic,
				works.work_show AS work_show,
				categories.cat_name AS cat_name
			FROM works
			LEFT JOIN categories ON(works.id_cat=categories.id_cat)
			ORDER BY works.id_work DESC";
$DB -> query($SQL);
while($row = $DB -> fetch_assoc()){
	$id_work		= $row['id_work'];
	$id_cat			= $row['id_cat'];
	$work_name	= $row['work_name'];
	$work_desc	= $row['work_desc'];
	if($work_desc!=""){
		$work_desc='<span class="label label-success">Da</span>';
	}else{
		$work_desc='<span class="label label-danger">Ne</span>';
	}
	$work_color	= $row['work_color'];
	$work_date		= $row['work_date'];
	$work_mpic = '../images/work/thumb_'.$row['work_mpic'];
		// Proveravam dal slika postoji ili ne , ako nepostoji ucitavamo onu noimage i menjamo boju reda.
			if(file_exists($work_mpic)){
			$work_mpic = $work_mpic;
		}else{
			$work_mpic = $folder . '/img/avatars/avatar3.jpg';
		}
	$work_ipic		= $row['work_ipic'];
	$work_show	= $row['work_show'];
	$cat_name		= $row['cat_name'];
	
	$DB2 = new db();
	$SQL = "SELECT count(*) AS koliko FROM segments WHERE id_work ='".$DB2->c($id_work)."' GROUP BY id_work";
	$DB2 -> query($SQL);
	$koliko=0;
	while($row2 = $DB2->fetch_assoc()){
		$koliko = $row2['koliko'];
	}
	$DB2 -> close();

?>
                <tbody class="js-table-sections-header">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right"></i>
                        </td>
                        <td class="text-center"><img class="img-avatar img-avatar48" src="<?php echo $work_mpic; ?>" alt=""></td>
                        <td class="font-w600"><?php echo $work_name; ?></td>
                        <td class="hidden-xs text-center">
                            <?php echo $cat_name; ?> <span style="background:<?php echo $work_color; ?>; color:<?php echo $work_color; ?>;">00</span>
                        </td>
                        <td class="hidden-xs">
                            <em class="text-muted"><?php echo $work_date; ?></em>
                        </td>
                        <td>
						<div class="btn-group">
							<button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Izmeni rad" onclick="location.href='works.php?loc=1&work=<?php echo $id_work; ?>';"><i class="fa fa-pencil"></i></button>
<?php
	if($koliko==0){
?>
							<button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Ukloni rad" onclick="sure(<?php echo $id_work; ?>)"><i class="fa fa-times"></i></button>
<?php
	}
?>
						</div>						
					</td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td class="text-center"></td>
                        <td class="font-w600">Podnaslov</td>
                        <td>
                            <?php echo $work_desc; ?>
                        </td>
					<td class="hidden-xs">
                        </td>
                        <td class="hidden-xs">
                        </td>
					<td>
                        </td>
                    </tr>
				<tr>
                        <td class="text-center"></td>
                        <td class="font-w600">Broj segmenata</td>
                        <td>
                            <span class="badge badge-info"><?php echo $koliko; ?></span>
					    <div class="btn-group">
							<button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Dodaj segment" onclick="location.href='works.php?loc=3&work=<?php echo $id_work; ?>';"><i class="fa fa-plus-circle"></i></button>
							<button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Vidi segmente" onclick="location.href='works.php?loc=2&work=<?php echo $id_work; ?>';"><i class="fa fa-eye"></i></button>
						</div>
                        </td>
					<td class="hidden-xs">
                        </td>
                        <td class="hidden-xs">
                        </td>
					<td>
                        </td>
                    </tr>
                </tbody>
<?php	
}
$DB -> close();
?>				
            </table>
        </div>
    </div>
	</div>
    <!-- END Table Sections -->
</div>
<!-- END Page Content -->
<script>
function sure(id)
{
var agree=confirm("Attention!\nDa li si siguran da želiš da ukloniš ovaj rad?\n (sa komplernim sadržajem)");
if (agree)
	window.location.href = "works_del.php?id_work="+id;
else
	return false ;
}
</script>
<?php
}


function change_work($swork_name,$work,$swork_desc,$swork_cat,$swork_cat_n,$swork_color,$swork_date,$swork_mpic,$swork_mpicr,$swork_ipic,$swork_ipicr,$swork_show){
	  
$DB = new db();
?>
<!-- Page Header -->
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">
                Radovi <small>Izmena postojećeg rada.</small> <?php echo $swork_name; ?> <img class="img-avatar img-avatar48" src="<?php echo $swork_mpic; ?>" alt="<?php echo $swork_name; ?>">
            </h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li>Radovi</li>
                <li><a class="link-effect" href="works.php?loc=1&work=<?php echo $work; ?>">Izmeni</a></li>
            </ol>
        </div>
    </div>
</div>
<!-- END Page Header -->

<!-- Page Content -->
<div class="content">
    <!-- <h2 class="content-heading">Your content</h2> -->
    <div class="col-sm-6 col-sm-offset-3">
            <!-- Floating Labels -->
            <div class="block">
                <div class="block-content block-content-narrow">
                    <form class="js-validation-material form-horizontal push-10-t" action="works_edit_save.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                        <div class="form-group has-info">
                            <div class="col-xs-12">
                                <div class="form-material floating">
                                    <input class="form-control" type="text" id="work_name" name="work_name" value="<?php echo $swork_name; ?>">
                                    <label for="work_name">Naziv rada</label>
                                </div>
                            </div>
					</div>
					<div class="form-group has-info">
                            <div class="col-xs-12">
                                <div class="form-material floating">
                                    <input class="form-control" type="text" id="work_opis" name="work_opis" value="<?php echo $swork_desc; ?>">
                                    <label for="work_opis">Kratak opis</label>
                                </div>
                            </div>
					</div>
					<div class="form-group has-info">
                            <div class="col-xs-12">
                                <div class="form-material floating">
                                    <select class="form-control" id="work_cat" name="work_cat" size="1">
									<option value="<?php echo $swork_cat; ?>" selected="selected"><?php echo $swork_cat_n; ?></option>
									<?php echo $cat_name_act; ?>
<?php
$SQL = "SELECT id_cat, cat_name FROM categories ORDER BY cat_name ASC";
$DB -> query($SQL);
while($row = $DB -> fetch_assoc()){
	$id_cat		= $row['id_cat'];
	$cat_name	= $row['cat_name'];
	
	echo'
                                        <option value="'.$id_cat.'">'.$cat_name.'</option>';
}
$DB -> close();
?>
                                    </select>
                                    <label for="work_cat">Kategorija</label>
                                </div>
                            </div>
					</div>
					<div class="form-group has-info">
                            <div class="col-xs-12">
                                   <div class="form-material floating">
                                       <input class="js-colorpicker form-control" type="text" id="work_color" name="work_color" value="<?php echo $swork_color; ?>">
                                       <label for="work_color">Odaberi boju</label>
                                   </div>
                            </div>
					</div>
					<div class="form-group has-info">
                            <div class="col-xs-12">
                                <div class="form-material floating">
                                    <input class="js-datepicker form-control" type="text" id="work_date" name="work_date" data-date-format="dd-mm-yyyy" value="<?php echo $swork_date; ?>">
                                    <label for="work_date">Odaberi datum</label>
                                </div>
                            </div>
					</div>
					<div class="form-group has-info">
					  <label class="col-xs-12" for="swork_file1">Slika za naslovnu stranu (273 x 273)</label>
                            <div class="col-xs-12">
							<img src="<?php echo $swork_mpic; ?>" border="0" />
                                <div class="form-material floating">
                                       <input type="file" id="swork_file1" name="swork_file1">
								<input type="hidden" name="work_mpicr" id="work_mpicr" value="<?php echo $swork_mpicr; ?>" />
                                   </div>
                                </div>
					</div>
					<div class="form-group has-info">
					  <label class="col-xs-12" for="swork_file2">Slika za unutrašnju stranu (480 x 260)</label>
                            <div class="col-xs-12">
							<img src="<?php echo $swork_ipic; ?>" border="0" />
                                <div class="form-material floating">
                                       <input type="file" id="swork_file2" name="swork_file2">
								<input type="hidden" name="work_ipicr" id="work_ipicr" value="<?php echo $swork_ipicr; ?>" />
                                   </div>
                                </div>
					</div>
					<div class="form-group has-info">
                            <div class="col-xs-12">
						<label class="css-input switch switch-sm switch-primary">
							<input type="checkbox"  id="work_show" name="work_show" <?php echo $swork_show; ?>><span></span> Prikaži u sadržaju
						</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-9">
							<input type="hidden" name="id_work" id="id_work" value="<?php echo $work; ?>" />
                                <button class="btn btn-sm btn-primary" type="submit" name="submit" id="submit">Izmeni</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Floating Labels -->
        </div>
</div>
<!-- END Page Content -->

<?php

}

?>
