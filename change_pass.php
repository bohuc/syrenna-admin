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
            <!-- Floating Labels -->
            <div class="block">
                <div class="block-content block-content-narrow">
                    <form class="js-validation-material form-horizontal push-10-t" action="change_pass2.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="form-material floating">
                                    <input class="form-control" type="text" id="user_name" name="user_name" value="<?php echo $_SESSION['suser'];?>" disabled >
                                    <label for="user_name">Username</label>
                                </div>
                            </div>
                        </div>
					
                          <div class="form-group">
                            <div class="col-xs-12">
                                <div class="form-material floating">
                                    <input class="form-control" type="password" id="old_pass" name="old_pass">
                                    <label for="old_pass">Old Password</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="form-material floating">
                                    <input class="form-control" type="password" id="new_pass" name="new_pass">
                                    <label for="new_pass">New Password</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="form-material floating">
                                    <input class="form-control" type="password" id="cnew_pass" name="cnew_pass">
                                    <label for="cnew_pass">Confirm New Password</label>
                                </div>
                            </div>
                        </div>
                        	
					<div class="form-group">
                            <div class="col-xs-12">
                                <button class="btn btn-sm btn-primary" type="submit" name="submit" id="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Floating Labels -->
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