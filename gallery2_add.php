<?php
session_start();
if($_SESSION['login']!=true) header("Location: index.php?message=Log in."); 
else {
	require 'inc/loader.php';
	include("inc/funkcije.php");
	?>
<?php require 'inc/views/template_head_start.php'; ?>

<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="<?php echo $one->assets_folder; ?>/js/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css">
<link rel="stylesheet" href="<?php echo $one->assets_folder; ?>/js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
<link rel="stylesheet" href="<?php echo $one->assets_folder; ?>/js/plugins/select2/select2.min.css">
<link rel="stylesheet" href="<?php echo $one->assets_folder; ?>/js/plugins/select2/select2-bootstrap.min.css">
<link rel="stylesheet" href="<?php echo $one->assets_folder; ?>/js/plugins/dropzonejs/dropzone.min.css">
<link rel="stylesheet" href="<?php echo $one->assets_folder; ?>/js/plugins/jquery-tags-input/jquery.tagsinput.min.css">

<?php require 'inc/views/template_head_end.php'; ?>
<?php require 'inc/views/base_head.php'; ?>

<!-- Page Header -->
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">
               My Gallery <small>Add New Photo.</small> 
            </h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li>Gallery</li>
                <li><a class="link-effect" href="gallery2_add.php">New Photo</a></li>
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
                    <form class="js-validation-material form-horizontal push-10-t" action="gallery2_add_save.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                        <div class="form-group has-info">
                            <div class="col-xs-12">
                                <div class="form-material floating">
                                    <input class="form-control" type="text" id="ph_name" name="ph_name">
                                    <label for="ph_name">Name</label>
                                </div>
                            </div>
					</div>
					<div class="form-group has-info">
                            <div class="col-xs-12">
                                <div class="form-material floating">
                                    <input class="form-control" type="text" id="ph_info" name="ph_info">
                                    <label for="ph_info">Short description</label>
                                </div>
                            </div>
					</div>
					<div class="form-group has-info">
                                <label class="col-xs-12">Type</label>
                            <div class="col-xs-12">
                                <label class="radio-inline" for="vrdob1">
                                    <input type="radio" id="ph_type1" name="ph_type" value="1" checked="checked" > Small Square
                                </label>
                                <label class="radio-inline" for="vrdob2">
                                    <input type="radio" id="ph_type2" name="ph_type" value="2"> Big Square
                                </label>
                                <label class="radio-inline" for="vrdob3">
                                    <input type="radio" id="ph_type3" name="ph_type" value="3"> Wide
                                </label>
                            </div>
					</div>
					<div class="form-group has-info">
                            <div class="col-xs-12">
                                <div class="form-material floating">
                                    <input class="js-datepicker form-control" type="text" id="ph_date" name="ph_date" data-date-format="dd-mm-yyyy">
                                    <label for="ph_date">Pick a Date</label>
                                </div>
                            </div>
					</div>
					<div class="form-group has-info">
					  <label class="col-xs-12" for="photo_file">Choose a Photo</label>
                            <div class="col-xs-12">
                                <div class="form-material floating">
                                       <input type="file" id="photo_file" name="photo_file">
                                   </div>
                                </div>
					</div>
					<div class="form-group has-info">
                            <div class="col-xs-12">
						<label class="css-input switch switch-sm switch-primary">
							<input type="checkbox"  id="ph_show" name="ph_show" checked><span></span> Show it on Site
						</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-9">
                                <button class="btn btn-sm btn-primary" type="submit" name="submit" id="submit">Add</button>
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
<script src="<?php echo $one->assets_folder; ?>/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $one->assets_folder; ?>/js/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo $one->assets_folder; ?>/js/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo $one->assets_folder; ?>/js/plugins/masked-inputs/jquery.maskedinput.min.js"></script>
<script src="<?php echo $one->assets_folder; ?>/js/plugins/dropzonejs/dropzone.min.js"></script>
<script src="<?php echo $one->assets_folder; ?>/js/plugins/jquery-tags-input/jquery.tagsinput.min.js"></script>

<!-- Page JS Code -->
<script>
    $(function(){
        // Init page helpers (BS Datepicker + BS Colorpicker + Select2 + Masked Input + Tags Inputs plugins)
        App.initHelpers(['datepicker', 'colorpicker', 'select2', 'masked-inputs', 'tags-inputs']);
    });
</script>

<!-- Page JS Plugins -->
<script src="<?php echo $one->assets_folder; ?>/js/plugins/jquery-validation/jquery.validate.min.js"></script>

<!-- Page JS Code -->
<script src="<?php echo $one->assets_folder; ?>/js/pages/syrenna_validation.js"></script>

<?php require 'inc/views/template_footer_end.php'; ?>
<?php } ?>