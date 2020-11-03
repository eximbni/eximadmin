<?php
$message='';
if(isset($_POST['submit'])){
	include("config.php");
	$webinar_title=$_POST['webinar_title'];
	$webinar_duration=$_POST['webinar_duration'];
	$link=$_POST['link'];
	$webinar_date = $_POST['schedule_date'];
	$webinar_time = $_POST['schedule_time'];
	$created_date = date("Y-m-d");
	$sql = "INSERT INTO `webinar`(`title`, `webinar_link`, `webinar_date`, `webinar_time`, `duration`, `status`)values('$webinar_title','$link','$webinar_date','$webinar_time','$webinar_duration','0')";
	$res = mysqli_query($conn,$sql);
	if($res){
		$message = "Webinar Added Successfully";
	}
	else{
		$message = "Failed To Add Webinar";
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
						<h4 class="m-0 text-dark">Add Webinar Schedule</h4>
					  </div>
					  <div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
						  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						  <li class="breadcrumb-item active">Add Webinar Schedule</li>
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
									  <label for="">Webinar Title</label>
									  <input type="text" name="webinar_title" class="form-control" id="" placeholder="Webinar Title">
									</div>
								
									<div class="form-group">
									  <label for="">Schedule Date</label>
									  <input type="date" name="schedule_date" onkeydown="return event.keyCode != 69" class="form-control" id="">
									</div>
									
                                    <div class="form-group">
									  <label for="">Webinar Link</label>
									  <input type="text" name="link" class="form-control" id="" placeholder="Webinar Link">
									</div>							
									
								</div>
								<div class="col-md-6">
									<div class="form-group">
									  <label for="">Webinar Duration</label>
									  <input type="number" name="webinar_duration" onkeydown="return event.keyCode != 69" class="form-control" id="" placeholder="Webinar Duration">
									</div>
									<div class="form-group">
									  <label for="">Schedule Time</label>
									  <input type="time" name="schedule_time" onkeydown="return event.keyCode != 69" class="form-control" id="">
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