<?php
$message="";
date_default_timezone_set("Asia/Calcutta");
$date = date('Y-m-d h:m:s');
if(isset($_POST['submit']))
{
	include("config.php");
	$countries = $_POST['country'];
	$chapters = $_POST['chapters'];
	$description = $_POST['description'];
	$count = sizeof($countries);
	$count1 = sizeof($chapters);
	for($i=0;$i<$count;$i++)
	{
		for($j=0;$j<$count1;$j++)
		{
			$sql_insert = "INSERT INTO `notifications`(`country_id`, `chapters_id`, `description`, `posted_date`, `status`) VALUES ('$countries[$i]','$chapters[$j]','$description','$date','1')";
			$res_insert = mysqli_query($conn,$sql_insert);
		}
		if($res_insert)
		{
			$message= "<div class='alert alert-success'>Notification inserted Successfully.</div>";
		}
		else
		{
			$message= "<div class='alert alert-danger'>Failed To Insert Notification.</div>";
		}
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
						<h4 class="m-0 text-dark">Notification</h4>
					  </div>
					  <div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
						  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						  <li class="breadcrumb-item active">Notification</li>
						</ol>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->
				</section>
				<section>
				<div class="card">
					<?php echo $message; ?>
				<div class="container">	
				  <div class="box-body">
				  <div class="row">
					<div class="col-md-12">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
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
				<div class="form-group">
					<label>Select Chapters</label>
					<select class="select2" multiple="multiple" name="chapters[]" data-placeholder="Select Chapters" style="width: 100%;">
						<?php include("config.php");
							$get = "select * from chapters";
							$res = mysqli_query($conn,$get);
							if($res){
								while($row=mysqli_fetch_assoc($res)){
							?>
								<option value="<?php echo $row['id'];?>"><?php echo $row['chapter_name'];?></option>
						<?php }} ?>
					</select>
				</div>
						
					<div class="form-group">
						<label>Description</label>
						<textarea class="form-control" rows="3" name="description" placeholder="Description ..."></textarea>
					 </div>	
					  <!-- /.box-body -->

				  <div class="box-footer text-right mb-3" >
					<input type="submit" class="btn btn-outline-primary" name="submit" value="submit">
				  </div>		
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