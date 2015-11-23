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

<?php require 'inc/views/template_head_end.php'; ?>
<?php require 'inc/views/base_head.php'; ?>

<!-- Page Header -->
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">
                Live Shows <small>Add new performance.</small>
            </h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li>Live Shows</li>
                <li><a class="link-effect" href="cshows_add.php">Add</a></li>
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
                    <form class="js-validation-material form-horizontal push-10-t" action="shows_add_save.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="form-material floating">
                                    <input class="form-control" type="text" id="place_name" name="place_name">
                                    <label for="place_name">Place</label>
                                </div>
                            </div>
                        </div>
					
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="form-material floating">
                                    <input class="form-control" type="text" id="place_loc" name="place_loc">
                                    <label for="place_loc">GPS Location</label>
                                </div>
                            </div>
                        </div>
						
                        <div class="form-group">
                            <div class="col-xs-4">
                                <div class="form-material floating">
                                    <input class="js-datepicker form-control" type="text" id="show_date" name="show_date" data-date-format="dd-mm-yyyy">
                                    <label for="show_date">Pick a date</label>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-material floating">
                                    <select class="form-control" type="text" id="show_hour" name="show_hour" size="1">
                                        <?php
								$i = 0;
								while($i<24){
									$d = ($i<10)?"0".$i:$i;
									echo '<option value="'.$d.'">'.$d.'</option>';
									$i = $i+1;
								}
						  ?>
                                    </select>
                                    <label for="show_hour">Hours</label>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-material floating">
                                    <select class="form-control" type="text" id="show_mins" name="show_mins" size="1">
                                       <?php
								$i = 0;
								while($i<60){
									$d = ($i<10)?"0".$i:$i;
									echo '<option value="'.$d.'">'.$d.'</option>';
									$i = $i+5;
								}
						  ?>
                                    </select>
                                    <label for="show_mins">Minutes</label>
                                </div>
                            </div>
                        </div>
                        	
					<div class="form-group">
                            <div class="col-sm-9">
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
<script src="<?php echo $one->assets_folder; ?>/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $one->assets_folder; ?>/js/plugins/jquery-validation/jquery.validate.min.js"></script>

<!-- Page JS Code -->
<script src="<?php echo $one->assets_folder; ?>/js/pages/syrenna_validation.js"></script>
<script>
    $(function(){
        // Init page helpers (BS Datepicker + BS Colorpicker + Select2 + Masked Input + Tags Inputs plugins)
        App.initHelpers(['datepicker']);
    });
</script>

<?php require 'inc/views/template_footer_end.php'; ?>
<?php } ?>