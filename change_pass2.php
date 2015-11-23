<?php
session_start();
if($_SESSION['login']!=true) header("Location: index.php?message=Log in"); 
else {
	require 'inc/loader.php';
	include("inc/funkcije.php");
	 ?>
<?php require 'inc/views/template_head_start.php'; ?>
<?php require 'inc/views/template_head_end.php'; ?>
<?php require 'inc/views/base_head.php'; ?>

<!-- Page Header -->
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">
                Change password <small>New password for you.</small>
            </h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a class="link-effect" href="change_pass.php">Change Password</a></li>
            </ol>
        </div>
    </div>
</div>
<!-- END Page Header -->

<!-- Page Content -->
<div class="content">
    <!-- <h2 class="content-heading">Your content</h2> -->
	<div class="col-sm-6 col-sm-offset-3">
            <div class="block block-themed">
<?php
$workdata = $request->post;
$DB = new db();
foreach($workdata AS $name => $value){
		$workdata[$name] = $DB->c($value);
}
$old_pass		= md5($workdata['old_pass']);
$new_pass		= md5($workdata['new_pass']);
$cnew_pass	= md5($workdata['cnew_pass']);

if($new_pass==$cnew_pass){
		// Upisujemo novu sifru na mesto gde je bila stara ako je dobro uneta stara sifra
		$SQL = "UPDATE korisnik SET pass='".$new_pass."' WHERE (idko='".$_SESSION['sidko']."' AND pass='".$old_pass."')";
		$DB = new db();
		$DB->query($SQL);
		// Proveravamo dal je nova sifra upisana , ako jeste onda je stara bila ok.
		$SQL = "SELECT * FROM korisnik WHERE (idko='".$_SESSION['sidko']."' AND pass='".$new_pass."')";
		$DB -> query($SQL);
		$num = $DB->num_rows();
		$DB -> close();
		
		if($num != 1){
				echo '
                <div class="block-header bg-danger">
                    <h3 class="block-title">Error</h3>
                </div>
                <div class="block-content">
                    <p>Wrong password...</p>
			     <button class="btn btn-danger push-5-r push-10" type="button" onclick="location.href=\'change_pass.php\'"><i class="fa fa-undo"></i> Try again...</button>
                </div>
				';
			}else{
				echo'
                <div class="block-header bg-success">
                    <h3 class="block-title">Success</h3>
                </div>
                <div class="block-content">
                    <p>Congratulations! New Password is set.</p>
				<button class="btn btn-success push-5-r push-10" type="button" onclick="location.href=\'index.php\'"><i class="glyphicon glyphicon-log-in"></i> Login with new password</button>
                </div>
				';
				session_destroy();
			}
	} else   {
		echo '
                <div class="block-header bg-warning">
                    <h3 class="block-title">Warning</h3>
                </div>
                <div class="block-content">
                    <p>New Password and Confirm New Pasword are diferent.</p>
				<button class="btn btn-warning push-5-r push-10" type="button" onclick="location.href=\'change_pass.php\'"><i class="fa fa-undo"></i> Try again...</button>
                </div>
				';
	}
	
?>
            </div>
        </div>
</div>
<!-- END Page Content -->

<?php require 'inc/views/base_footer.php'; ?>
<?php require 'inc/views/template_footer_start.php'; ?>

<!-- Page JS Plugins -->
<script src="<?php echo $one->assets_folder; ?>/js/plugins/jquery-validation/jquery.validate.min.js"></script>

<!-- Page JS Code -->
<script src="<?php echo $one->assets_folder; ?>/js/pages/syrenna_validation.js"></script>

<?php require 'inc/views/template_footer_end.php'; ?>
<?php } ?>