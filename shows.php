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

<?php
//ako je $_GET['id_show'] setovan, onda je potrebno izvrsiti izmenu nastupa
if(isset($_GET['id_show'])){
	$id_show = $request -> get['id_show'];
	$DB = new db();
	$SQL = "SELECT * FROM shows WHERE id_show='".$DB->c($id_show)."'";
	$DB -> query($SQL);
	$row = $DB -> fetch_assoc();
	$place_name	= $row['place'];
	$show_time	= $row['show_time'];
	$start_date	= date('d-m-Y',strtotime($show_time));
	$start_hour		= date('H',strtotime($show_time));
	$start_minute	= date('i',strtotime($show_time));
	$place_loc		= $row['gps_loc'];
	$DB -> close();
?>
<!-- Page Header -->
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">
                Live Shows <small>change.</small>
            </h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li>Live Shows</li>
                <li><a class="link-effect" href="shows.php?id_show=<?php echo $id_show;?>">Change</a></li>
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
                    <form class="js-validation-material form-horizontal push-10-t" action="shows_edit_save.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                         <div class="form-group">
                            <div class="col-xs-12">
                                <div class="form-material floating">
                                    <input class="form-control" type="text" id="place_name" name="place_name" value="<?php echo $place_name;?>">
                                    <label for="place_name">Place</label>
                                </div>
                            </div>
                        </div>
					
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="form-material floating">
                                    <input class="form-control" type="text" id="place_loc" name="place_loc" value="<?php echo $place_loc;?>">
                                    <label for="place_loc">GPS Location</label>
                                </div>
                            </div>
                        </div>
						
                        <div class="form-group">
                            <div class="col-xs-4">
                                <div class="form-material floating">
                                    <input class="js-datepicker form-control" type="text" id="show_date" name="show_date" data-date-format="dd-mm-yyyy"  value="<?php echo $start_date;?>">
                                    <label for="show_date">Pick a date</label>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-material floating">
                                    <select class="form-control" type="text" id="show_hour" name="show_hour" size="1">
									<option selected="selected" value="<?php echo $start_hour;?>"><?php echo $start_hour;?></option>
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
									<option selected="selected" value="<?php echo $start_minute;?>"><?php echo $start_minute;?></option>
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
							<input type="hidden" id="id_show" name="id_show" value="<?php echo $id_show;?>">
                                <button class="btn btn-sm btn-primary" type="submit" name="submit" id="submit">Change</button>
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
}else{
?>
<!-- Page Header -->
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">
                Live Shows <small>List of musical performances.</small>  <button class="btn btn-minw btn-primary" type="button" onclick="location.href='shows_add.php';">Add New Show</button>
            </h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li>Live Shows</li>
                <li><a class="link-effect" href="categories.php">List</a></li>
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
                                <th>Place</th>
                                <th class="hidden-xs"><i class="si si-pointer"></i></th>
                                <th class="text-center" style="width: 15%;"><i class="si si-calendar"></i></th>
                                <th class="text-center" class="hidden-xs" style="width: 15%;"><i class="si si-clock"></i></th>
                                <th class="text-center" style="width: 100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
$DB = new db();
$SQL = "SELECT * FROM shows WHERE show_time >= CURDATE() ORDER BY show_time ASC";
$DB -> query($SQL);
while($row = $DB -> fetch_assoc()){
	$id_show		= $row['id_show'];
	$place_name	= $row['place'];
	$show_date	= date('jS M Y',strtotime($row['show_time']));
	$show_time	= date('g:i A',strtotime($row['show_time']));
	$place_loc		= $row['gps_loc'];
	if($place_loc!=""){
		$place_loc = "YES";
	}else{
		$place_loc = "NO";
	}
	
	
	echo'
	                     <tr>
                                <td class="text-center">'.$id_show.'</td>
                                <td>'.$place_name.'</td>
                                <td class="hidden-xs">
                                    '.$place_loc.'
                                </td>
                                <td class="text-center">
                                    '.$show_date.'
                                </td>
								<td class="text-center" class="hidden-xs">
								 '.$show_time.'
								</label>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Change" onclick="location.href=\'shows.php?id_show='.$id_show.'\';"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Delete" onclick="sure('.$id_show.')"><i class="fa fa-times"></i></button>
                                    </div>
                                </td>
                            </tr>
						 
	';
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
<?php 
}

if(isset($_GET['message'])) 
	echo('<script>alert("'.$_GET['message'].'")</script>');
?>

<?php require 'inc/views/base_footer.php'; ?>
<?php require 'inc/views/template_footer_start.php'; ?>
<script>
function sure(id)
{
var agree=confirm("Attention!\nDelete? Are you sure?\n");
if (agree)
	window.location.href = "shows_del.php?id_show="+id;
else
	return false ;
}
</script>

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