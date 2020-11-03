<?php
$message='';
if(isset($_POST['submit'])){
	include("config.php");
	$expo_name=$_POST['expo_name'];
	$address=$_POST['address'];
	$expo_date = $_POST['expo_date'];
	$expo_time = $_POST['expo_time'];
	$created_date = date("Y-m-d");
	$sql = "INSERT INTO `schedule_expo`(`expo_name`, `expo_date`, `expo_time`, `venue_address`, `created_date`, `status`)values('$expo_name','$expo_date,','$expo_time','$address','$created_date','1')";
	$res = mysqli_query($conn,$sql);
	if($res){
		$message = "Expo Added Successfully";
	}
	else{
		$message = "Failed To Add Expo";
		echo mysqli_error($conn);
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
						<h4 class="m-0 text-dark">Add Expo</h4>
					  </div>
					  <div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
						  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						  <li class="breadcrumb-item active">Add Expo</li>
						</ol>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->
				</section>
				<section>
				<h2 style="color:red"><?php echo $message; ?></h2>
				<div class="card p-3">
				<div class="container">
					<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
							
						<div class="box-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									  <label for="">Expo Name</label>
									  <input type="text" name="expo_name" class="form-control" id="" placeholder="Expo Name">
									</div>
								
									<div class="form-group">
									  <label for="">Expo Date</label>
									  <input type="date" name="expo_date" onkeydown="return event.keyCode != 69" class="form-control" id="">
									</div>
									
									<div class="form-group">
									  <label for="">Expo Time</label>
									  <input type="time" name="expo_time" onkeydown="return event.keyCode != 69" class="form-control" id="">
									</div>	
									
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Venue Address</label>
										<textarea class="form-control" rows="5" name="address" placeholder="Expo Address..."></textarea>
									 </div>
									
								</div>
								</div>
									 <div class="box-footer text-right">
									<input type="submit" name="submit" class="btn btn-outline-primary" value="submit">
								  </div>
									
								  </div>
								  <!-- /.box-body -->

								 
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