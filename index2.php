<?php
session_start();
//Ucitavamo mysql klasu
require 'inc/loader.php';
include("inc/funkcije.php");
if($_SESSION['login']!=true) {
$workdata = $request->post;
$DB = new db();
foreach($workdata AS $name => $value){
		$workdata[$name] = $DB->c($value);
}
$user = $workdata['username'];
$pass = md5($workdata['password']);
//echo $user."<br />".$pass;

$SQL = "SELECT * FROM korisnik WHERE user = '".$user."' AND pass = '".$pass."' LIMIT 0,1";
$DB -> query ($SQL);
//$row = $DB->fetch_assoc();
//$user2 = $row['user'];
//$pass2 = $row['pass'];
//echo '<br /><br />'.$user2."<br />".$pass2;
$num = $DB->num_rows(); // Broji koliko ima rezultata ako je 1 onda postoji korisnik sa tom sifrom

if($num != 1){
$DB -> close();
 header("Location: index.php?message=Wrong username and password combination."); 
// Belezimo greske u fajl
//$log->File("login.log");
//$log->write("Error login user: ".$_POST['username']."");
	echo "Error";
 }
else { 
// Belezimo uspesno logovanje
//$log->File("login.log");
//$log->write("Login OK for user ".$_POST['username']."");
//Postavljamo sesije
while($row = $DB->fetch_assoc()){
	$_SESSION['sidko'] = $row['idko'];
	$_SESSION['sime'] = $row['ime'];
	$_SESSION['suser'] = $row['user'];
	$_SESSION['smail'] = $row['mail'];
	$_SESSION['sfunkcija'] = $row['tip'];
	$_SESSION['login'] = true;
	}
$DB -> close();
header("Location: index2.php"); 
}
}else{

?>
<?php require 'inc/views/template_head_start.php'; ?>

<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="<?php echo $one->assets_folder; ?>/js/plugins/slick/slick.min.css">
<link rel="stylesheet" href="<?php echo $one->assets_folder; ?>/js/plugins/slick/slick-theme.min.css">

<?php require 'inc/views/template_head_end.php'; ?>
<?php require 'inc/views/base_head.php'; ?>

<!-- Page Header -->
<div class="content bg-image overflow-hidden" style="background-image: url('<?php echo $one->assets_folder; ?>/img/photos/photo15@2x.jpg');">
    <div class="push-50-t push-15">
        <h1 class="h2 text-white animated zoomIn">Dashboard</h1>
        <h2 class="h5 text-white-op animated zoomIn">Welcome Syrenna</h2>
    </div>
</div>
<!-- END Page Header -->

<!-- Background Colored Tiles -->
<div class="content">
    <div class="row">
        <div class="col-sm-6 col-lg-4">
            <a class="block block-link-hover1 text-center" href="shows.php">
                <div class="block-content block-content-full bg-info">
                    <i class="si si-list fa-5x text-white"></i>
                </div>
                <div class="block-content block-content-full block-content-mini">
                    <strong>Live Shows</strong> list
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-4">
            <a class="block block-link-hover1 text-center" href="shows_add.php">
                <div class="block-content block-content-full bg-primary">
                    <i class="si si-plus fa-5x text-white"></i>
                </div>
                <div class="block-content block-content-full block-content-mini">
                    <strong>Add</strong> Show
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-4">
            <a class="block block-link-hover1 text-center" href="gallery2.php">
                <div class="block-content block-content-full bg-modern-dark">
                    <i class="si si-grid fa-5x text-white"></i>
                </div>
                <div class="block-content block-content-full block-content-mini">
                    <strong>Gallery</strong> list
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-4">
            <a class="block block-link-hover1 text-center" href="gallery2_add.php">
                <div class="block-content block-content-full bg-danger">
                    <i class="si si-plus fa-5x text-white"></i>
                </div>
                <div class="block-content block-content-full block-content-mini">
                    <strong>Add</strong> Photo
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-4">
            <a class="block block-link-hover1 text-center" href="change_pass.php">
                <div class="block-content block-content-full bg-modern">
                    <i class="si si-lock fa-5x text-white"></i>
                </div>
                <div class="block-content block-content-full block-content-mini">
                    <strong>Change</strong> Password
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-4">
            <a class="block block-link-hover1 text-center" href="backup.php">
                <div class="block-content block-content-full bg-success">
                    <i class="si si-refresh fa-5x text-white"></i>
                </div>
                <div class="block-content block-content-full block-content-mini">
                    <strong>Backup</strong> Database
                </div>
            </a>
        </div>
    </div>
</div>
<!-- END Background Colored Tiles -->
	

<?php require 'inc/views/base_footer.php'; ?>
<?php require 'inc/views/template_footer_start.php'; ?>

<!-- Page Plugins -->
<script src="<?php echo $one->assets_folder; ?>/js/plugins/slick/slick.min.js"></script>
<script src="<?php echo $one->assets_folder; ?>/js/plugins/chartjs/Chart.min.js"></script>

<!-- Page JS Code -->
<script src="<?php echo $one->assets_folder; ?>/js/pages/base_pages_dashboard.js"></script>
<script>
    $(function(){
        // Init page helpers (Slick Slider plugin)
        App.initHelpers('slick');
    });
</script>

<?php require 'inc/views/template_footer_end.php'; ?>

<?php
}
?>