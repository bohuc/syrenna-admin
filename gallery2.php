<?php
session_start();
if($_SESSION['login']!=true) header("Location: index.php?message=Log in."); 
else {
	require 'inc/loader.php'; 
	require 'inc/funkcije.php';
	?>
<?php require 'inc/views/template_head_start.php'; ?>

<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="<?php echo $one->assets_folder; ?>/js/plugins/magnific-popup/magnific-popup.min.css">

<?php require 'inc/views/template_head_end.php'; ?>
<?php require 'inc/views/base_head.php'; ?>


<?php
$loc	= $request -> get['loc']; 


switch($loc) { //Switch u zavisnosti koja je lokacija u pitanju
		
	// Izmeni sliku
	  case "1": change_img($swork_name,$work,$swork_desc,$swork_cat,$swork_cat_n,$swork_color,$swork_date,$swork_mpic,$swork_mpicr,$swork_ipic,$swork_ipicr,$swork_show);
	  break; // Kraj Izmeni sliku

	  
	  // Vidi radove
	  default: //gallery_list($one->assets_folder);
	  ?>
<!-- Page Header -->
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-8">
            <h1 class="page-heading">
                My Gallery <small>List of pictures in the album.</small>  <button class="btn btn-minw btn-primary" type="button" onclick="location.href='gallery2_add.php';">Add New Photo</button>
            </h1>
        </div>
        <div class="col-sm-4 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li>Gallery</li>
                <li><a class="link-effect" href="gallery2.php">List</a></li>
            </ol>
        </div>
    </div>
</div>
<!-- END Page Header -->

<!-- Page Content -->
<div class="content">
    <!-- Gallery (.js-gallery-advanced class is initialized in App() -> uiHelperMagnific()) -->
    <!-- For more info and examples you can check out http://dimsemenov.com/plugins/magnific-popup/ -->
    <div class="row items-push js-gallery-advanced">
<?php
$DB = new db();
$SQL = "SELECT * FROM gallery ORDER BY ph_datum DESC";
$DB -> query($SQL);
while($row = $DB -> fetch_assoc()){
	
	$id_ph		= $row['id_ph'];
	$ph_name	= $row['ph_name'];
	if($ph_name==""){
		$ph_name = "No name";
	}
	$ph_info		= $row['ph_info'];
	if($ph_info==""){
		$ph_info = "No info";
	}
	$photo = '../img/gallery/thumb_'.$row['photo'];
	$photo_l = '../img/gallery/'.$row['photo'];
	// Proveravam dal slika postoji ili ne , ako nepostoji ucitavamo onu noimage i menjamo boju reda.
		if(file_exists($photo)){
		$photo = $photo;
	}else{
		$photo = $one->assets_folder . '/img/logo1.png';
	}
	$ph_type	= $row['ph_type'];
	if($ph_type==1){
		$ph_type = "Small square";
	}elseif($ph_type==2){
		$ph_type = "Big square";
	}elseif($ph_type==3){
		$ph_type = "Wide";
	}
	$ph_datum	= $row['ph_datum'];
	$ph_show	= $row['ph_show'];
	if($ph_show=='Y'){
		$ph_show_css = "fa fa-eye-slash";
		$ph_show_js = "Hide";
	}elseif($ph_show=='N'){
		$ph_show_css = "fa fa-eye";
		$ph_show_js = "Show";
	}
	?>
        <div class="col-sm-2 col-md-4 col-lg-3 animated fadeIn">
            <div class="img-container fx-img-rotate-r thumbnail-sq">
                <img src="<?php echo $photo; ?>" alt="<?php echo $ph_name; ?>">
                <div class="img-options">
                    <div class="img-options-content">
                        <h3 class="font-w400 text-white push-5"><?php echo $ph_name; ?></h3>
                        <h4 class="h6 font-w400 text-white-op push-15"><?php echo $ph_info; ?>, <?php echo $ph_type; ?></h4>
                        <a class="btn btn-sm btn-default img-lightbox" href="<?php echo $photo_l; ?>">
                            <i class="fa fa-search-plus"></i> View
                        </a>
                        <div class="btn-group btn-group-sm"  id="show_ph<?php echo $id_ph;?>">
                            <!--<a class="btn btn-default" href="javascript:void(0)"><i class="fa fa-pencil"></i> Edit</a> -->
                            <a class="btn btn-default" onclick="show_hide('<?php echo $ph_show;?>',<?php echo $id_ph;?>)"><i class="<?php echo $ph_show_css;?>"></i> <?php echo $ph_show_js;?></a>
                            <a class="btn btn-default" onclick="sure(<?php echo $id_ph;?>)"><i class="fa fa-times"></i> Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php 
	} 
$DB -> close();

?>
    </div>
    <!-- END Gallery -->
</div>
<!-- END Page Content -->
	  
<?php
	  break; // Kraj Vidi radove
    }
	
if(isset($_GET['message'])) 
	echo('<script>alert("'.$_GET['message'].'")</script>');
?>




<?php require 'inc/views/base_footer.php'; ?>
<?php require 'inc/views/template_footer_start.php'; ?>

<!-- Page JS Plugins -->
<script src="<?php echo $one->assets_folder; ?>/js/plugins/magnific-popup/magnific-popup.min.js"></script>

<!-- Page JS Code -->
<script>
    $(function(){
        // Init page helpers (Magnific Popup plugin)
        App.initHelpers('magnific-popup');
    });
</script>
<script>
$(".thumbnail-sq").each(function(){
    // Uncomment the following if you need to make this dynamic
    //var refH = $(this).height();
    //var refW = $(this).width();
    //var refRatio = refW/refH;

    // Hard coded value...
    //var refRatio = 220/220;
	var refRatio = 1;

    var imgH = $(this).children("img").height();
    var imgW = $(this).children("img").width();
	
	//alert(imgH+'/'+imgW);

    if ( (imgW/imgH) < refRatio ) { 
        $(this).addClass("portrait");
    } else {
        $(this).addClass("landscape");
    }
})

function show_hide(element,id_ph)
 {
  //var state = element.checked ? 'Y' : 'N'; 
   $.ajax({
		type: 'get',
		url: "ajax/ajax.php?action=show_ph&id_ph="+id_ph+"&state="+element,
		cache: false,
		success: function(result){
			var detail = jQuery.parseJSON(result);
			//alert(detail.show_seg);
			//alert("#show_cat"+id);
			$("#show_ph"+id_ph).html(detail.show_ph);
		}
	});
 }

function sure(id)
{
var agree=confirm("Attention!\nAre you sure you want to delete?\n ");
if (agree)
	window.location.href = "gallery2_del.php?id_ph="+id;
else
	return false ;
}
</script>

<?php require 'inc/views/template_footer_end.php'; ?>
<?php 
 } ?>