<?php
if(isset($_POST['submit']))
{
include("config.php");
echo $title = $_POST['title'];
echo $start_date = $_POST['start_date'];
echo $end_date = $_POST['end_date'];
echo $country = $_POST['country'];
$target_path = "uploads/banner/";
$target_path = $target_path . basename( $_FILES['doc']['name']);
 
if(move_uploaded_file($_FILES['doc']['tmp_name'], $target_path)) {
	echo $sql_banner = "INSERT INTO `banner`(`banner_title`, `banner_image`, `start_date`, `end_date`) VALUES ('$title','$target_path','$start_date','$end_date')";
	$res_banner = mysqli_query($conn,$sql_banner);
	if($res_banner)
	{
		echo "Banner Uploaded.";
		$last_id = mysqli_insert_id($conn);
		$count = sizeof($country);
		for($i=0;$i<$count;$i++)
		{
			$sql_dis_coutry = "INSERT INTO `banner_display_countries`(`banner_id`, `countries`) VALUES ('$last_id','$country[$i]')";
			$res_dis_country = mysqli_query($conn,$sql_dis_coutry);
		}
	}
	else
	{
		echo "Failed to upload banner";
		echo mysqli_error($conn);
	}
}
else
{
	echo "Image not moved";
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
						<h4>Upload Banner</h4>
					  </div>
					  <div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
						  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						  <li class="breadcrumb-item active">Upload Banner</li>
						</ol>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->
				</section>
				<section>
				<div class="card p-3">
				<div class="container">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
						<div class="form-group">
						  <label for="">Title</label>
						  <input type="text" class="form-control" id="" placeholder="Add Title" name="title">
						</div>
						
						<div class="form-group">
							<label for="exampleInputFile">Upload File</label>
							<div class="input-group">
							  <div class="custom-file">
								<input type="file" class="custom-file-input" id="exampleInputFile" name="doc">
								<label class="custom-file-label" for="exampleInputFile">Choose file</label>
							  </div>
							  <div class="input-group-append">
								<span class="input-group-text" id="">Upload</span>
							  </div>
							</div>
						</div>
						
						<div class="form-group">
						  <label for="">Start Date</label>
						  <input type="date" class="form-control" id="" placeholder="Start Date" name="start_date">
						</div>
						
						<div class="form-group">
						  <label for="">End Date</label>
						  <input type="date" class="form-control" id="" placeholder="End Date" name="end_date">
						</div>
						
						<div class="form-group">
						  <label>Select Country</label>
						  <select class="select2" multiple="multiple" name="country[]" data-placeholder="Select Countries" style="width: 100%;">
							<option>Select</option>
							<?php include("config.php");
							$get = "select * from countries";
							$res = mysqli_query($conn,$get);
							if ($res){
								while($row=mysqli_fetch_assoc($res)){
							?>
								<option value="<?php echo $row['country_id'];?>"><?php echo $row['name'];?></option>
							
							<?php }} ?>
						  </select>
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
<script>
 $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
 });
</script>
 </body>
 </html>