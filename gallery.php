<?php
$message="";
if(isset($_POST['submit']))
{
	include("config.php");
	$webinar = $_POST['webinar'];
	$video_link = $_POST['video_link'];
	
	$sql_gallery = "INSERT INTO `webinar_gallery`(`webinar_id`, `youtube_frame`) VALUES ('$webinar','$video_link')";
	$res_sql_gallery = mysqli_query($conn,$sql_gallery);
	if($res_sql_gallery)
	{
		//echo "video link inserted.";
		$message = "Video Link Added Successfully";
	}
	else
	{
		//echo "Failed to insert video link";
		$message = "Failed to insert video link";
		//echo mysqli_error($conn);
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

			<?php include("header.php")?>
		  <!-- /.navbar -->

		  <!-- Main Sidebar Container -->
		  <aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<?php include("sidemenu.php");?>
		  </aside>
			<div class="content-wrapper">
				 <section class="content-header">
				  <div class="container-fluid">
					<div class="row mb-2">
					  <div class="col-sm-6">
						<h4>Gallery</h4>
					  </div>
					  <div class="col-sm-6">
					  <h2 style="color:red;margin-left: -50%;"><?php echo $message; ?></h2>
						<ol class="breadcrumb float-sm-right">
						  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						  <li class="breadcrumb-item active">Gallery</li>
						</ol>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->
				</section>
				<section>
				<div class="card p-3">
				<div class="container">
					<form role="form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
				<div class="form-group">
                  <label>Select Webinar</label>
                  <select class="form-control" name="webinar" data-placeholder="Select Webinar" style="width: 100%;">
                    <option>Select</option>
					<?php include("config.php");
					$get = "select * from webinar";
					$res = mysqli_query($conn,$get);
					if ($res){
						while($row=mysqli_fetch_assoc($res)){
					?>
						<option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option>
					
					<?php }} ?>
                  </select>
                </div>
				<div class="form-group">
				  <label for="">Video Link</label>
				  <input type="text" class="form-control" id="" name="video_link" placeholder="Video Link">
				</div>
		
			  <div class="box-footer text-right">
				<!--button type="submit" class="btn btn-outline-primary">Submit</button-->
				<input type="submit" class="btn btn-outline-primary" name="submit" value="submit">
			  </div>
			</form>
					 
				</div>
				</div>
				</section>
			</div>
</div>
 </body>
 </html>