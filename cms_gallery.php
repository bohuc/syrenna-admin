<?php
session_start();
if($_SESSION['login']!=true) header("Location: index.php?message=Log in."); 
else {
	require 'inc/loader.php';
	include("inc/funkcije.php");
	 ?>
<?php require 'inc/views/template_head_start.php'; ?>
<?php require 'inc/views/template_head_end.php'; ?>
<?php require 'inc/views/base_head.php'; ?>

<?php
//Treba mi id stranice koja se menja, BIO = 1, GALLERY = 2, CONTACT = 3 
	$id_page = 2;
	$DB = new db();
	$SQL = "SELECT * FROM pages WHERE id_page='".$DB->c($id_page)."'";
	$DB -> query($SQL);
	$row = $DB -> fetch_assoc();
	$content	= $row['content'];
	$DB -> close();
?>
<!-- Page Header -->
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">
                Content <small>change Gallery text.</small>
            </h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li>Content</li>
                <li><a class="link-effect" href="cms_gallery.php">Gallery</a></li>
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
                    <form class="js-validation-material form-horizontal push-10-t" action="cms_save.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
					<div class="form-group has-info">
                            <div class="col-xs-12">
                                    <textarea id="cms_text" name="cms_text" id="cms_text"><?php echo $content; ?></textarea>
                            </div>
					</div>
                        <div class="form-group">
                            <div class="col-sm-9">
                                <input type="hidden" name="id_page" id="id_page" value="<?php echo $id_page; ?>">
                                <button class="btn btn-sm btn-primary" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Striped Table -->
</div>
<!-- END Page Content -->
<?php 


if(isset($_GET['message'])) 
	echo('<script>alert("'.$_GET['message'].'")</script>');
?>

<?php require 'inc/views/base_footer.php'; ?>
<?php require 'inc/views/template_footer_start.php'; ?>

<script src="<?php echo $one->assets_folder; ?>/js/plugins/jquery-validation/jquery.validate.min.js"></script>
<!-- Page JS Code -->
<script src="<?php echo $one->assets_folder; ?>/js/pages/syrenna_validation.js"></script>

<!-- Page JS Plugins -->
<script src="<?php echo $one->assets_folder; ?>/js/plugins/ckeditor/ckeditor.js"></script>
<!-- Page JS Code -->
<script>
    $(function(){
        // Init page helpers (Summernote + CKEditor plugins)
        App.initHelpers(['ckeditor']);
    });
</script>
<script>
		CKEDITOR.replace( 'cms_text', {
			// Define the toolbar groups as it is a more accessible solution.
			toolbarGroups: [
				{"name":"basicstyles","groups":["basicstyles"]},
				{"name":"links","groups":["links"]},
				{"name":"paragraph","groups":["list","blocks"]},
				{"name":"document","groups":["mode"]},
				{"name":"about","groups":["about"]}
			],
			// Remove the redundant buttons from toolbar groups defined above.
			removeButtons: 'Underline,Strike,Blockquote,CreateDiv,Subscript,Superscript,Anchor,Styles,Specialchar'
		} );
</script>
<?php require 'inc/views/template_footer_end.php'; ?>
<?php } ?>