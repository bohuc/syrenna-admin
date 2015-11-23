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
                Backup <small>Export/Import of Database.</small>
            </h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a class="link-effect" href="backup.php">Backup</a></li>
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
                <div class="block-content">
				<button class="btn btn-success push-5-r push-10" type="button" onclick="location.href='getbackup.php'"><i class="si si-refresh"></i> Make New Backup</button>
                </div>
                <div class="block-content">
<?php

if(isset($_POST['Submit'])){
	
if($_POST['Submit']=="Rollback"){
	$target_path = "backup/import.sql";
	$poruka ="";

	if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
    	$poruka .= "File ".  basename( $_FILES['file']['name']);
    	$poruka .="<br /><br /> upload OK ...  <br />";
		$poruka .= Restore($target_path);
	} else{
    	$poruka .= "<br />Upload GREŠKA ... <br />";
    }
	
	// Rezultat uploada i restore
		echo ' <table><tr>
        <td height="40" valign="top" bgcolor="#F4F4F4">
		<p align="center"><BR><center>';	
		echo $poruka;
	    echo '	</center></td></tr></table>';
	// Kraj 
	
	}

}	
if(isset($_REQUEST['restore']) && isset($_REQUEST['file'])){
	if($_REQUEST['restore']=='true' && $_REQUEST['file']!=""){
			$target_path = "backup/".$_REQUEST['file'].".sql";
			$poruka ="File koji se učitava : ".$_REQUEST['file'].".sql<br />";
			$poruka .= Restore($target_path);	
		// Rezultat restore
			echo ' <table><tr>
			<td height="40" valign="top" bgcolor="#F4F4F4">
			<p align="center"><BR><center>';	
			echo $poruka;
			echo '	</center></td></tr></table>';
		// Kraj 	
	}
}
?>

<?php
//define the path as relative
$path = "backup";
//using the opendir function
$dir_handle = @opendir($path) or die("Unable to open $path");
list_dir($dir_handle,$path);
?>


	
      <p><form name="backup" method="post" action="backup.php" enctype="multipart/form-data">
        Choose Database file for Backup: 
          <input name="file" type="file" id="file" />
        <input type="submit" name="Submit" value="Rollback" id="Submit"/>
      </form></p>
                </div>
            </div>
        </div>
</div>
<!-- END Page Content -->

<?php require 'inc/views/base_footer.php'; ?>
<?php require 'inc/views/template_footer_start.php'; ?>
<?php require 'inc/views/template_footer_end.php'; ?>
<?php }

function Restore($target_path){
	$DB = new db();
	$handle = fopen($target_path, "rt");
		if($handle)
		{
			$poruka = "<BR>Start import...<BR>";
			while($strSQL = fgets($handle))
			{
				$strSQL = rtrim($strSQL); 
				while(substr($strSQL, -1, 1) != ";")
				{
					$strNextLine = fgets($handle);
					$strNextLine = rtrim($strNextLine);
					$strSQL .= $strNextLine; 
				}
				if(strlen($strSQL) > 1 && substr($strSQL, 0, 3) != "-- " && substr($strSQL, 0, 1) != "#")
				{
					$DB -> query($strSQL);
				}
			}
			$poruka .= "<br />Import ended...OK.<br />";		
			fclose($handle);
			return $poruka;
			}
		$DB -> close();	
	}	

function list_dir($dir_handle,$path)
{
	$i = 1;
    echo '
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th>Name</th>
                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>';
    while (false !== ($file = readdir($dir_handle))) {
        $dir =$path.'/'.$file;
        if(is_dir($dir) && $file != '.' && $file !='..' && $file != 'import.sql' && $file != 'index.html' )
        {
			
            $handle = @opendir($dir) or die("undable to open file $file");
            echo '<tr>
                                <td class="text-center">'.$i.'</td>
								<td><a href="getbackup.php?file='.substr($file,0,-4).'&download=true" title="Save backup '.substr($file,0,-4).'">'.substr($file,0,-4).'</a></td>
								<td class="text-center">
                                    <div class="btn-group">
                                        <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Rollback" onclick="location.href=\'backup.php?file='.substr($file,0,-4).'&restore=true\'"><i class="fa fa-refresh"></i></button>
                                        <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remove" onclick="location.href=\'backup_del.php?file='.substr($file,0,-4).'\'"><i class="fa fa-times"></i></button>
                                    </div>
                                </td>
							</tr>
								';
            list_dir($handle, $dir);
        }elseif($file != '.' && $file !='..' && $file != 'import.sql' && $file != 'index.html')
        {
               echo '<tr>
                                <td class="text-center">'.$i.'</td>
								 <td><a href="getbackup.php?file='.substr($file,0,-4).'&download=true" title="Save backup '.substr($file,0,-4).'">'.substr($file,0,-4).'</a></td>
								 <td class="text-center">
                                    <div class="btn-group">
                                        <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Rollback" onclick="location.href=\'backup.php?file='.substr($file,0,-4).'&restore=true\'"><i class="fa fa-refresh"></i></button>
                                        <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remove" onclick="location.href=\'backup_del.php?file='.substr($file,0,-4).'\'"><i class="fa fa-times"></i></button>
                                    </div>
                                </td>
							</tr>
								';
        }
		$i++;
    }
   
    echo '
                        </tbody>
                    </table>';

    //closing the directory
    closedir($dir_handle);
   
}

 ?>