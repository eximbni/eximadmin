<?php
$message='';
if(isset($_POST['submit'])){
	include("config.php");
	$title=$_POST['title'];
	$chapters=$_POST['chapters'];
	$agenda=$_POST['agenda'];
	$meeting_date = $_POST['meeting_date'];
	$meeting_time = $_POST['meeting_time'];
	$created_date = date("Y-m-d");
	foreach($chapters As $value)
	{
		$sql = "INSERT INTO `meeting`(`title`, `agenda`, `meeting_date`, `meeting_time`, `chapters`, `created_date`, `status`) values('$title','$agenda','$meeting_date,','$meeting_time','$value','$created_date','1')";
		$res = mysqli_query($conn,$sql);
	}
	if($res){
		$message = "Meeting Added Successfully";
	}
	else{
		$message = "Failed To Add Meeting";
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
						<h4 class="m-0 text-dark">Add Meeting</h4>
					  </div>
					  <div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
						  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						  <li class="breadcrumb-item active">Add Meeting</li>
						</ol>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->
				</section>
				<section>
				<h2 style="color:red"><?php echo $message; ?></h2>
				<div class="card p-3">
				<div class="container">
					<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
							
						<div class="box-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									  <label for="">Meeting Title</label>
									  <input type="text" name="title" class="form-control" id="" placeholder="Meeting Title">
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
									  <label for="">Meeting Date</label>
									  <input type="date" name="meeting_date" onkeydown="return event.keyCode != 69" class="form-control" id="">
									</div>
									
										
									
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Meeting Agenda</label>
										<textarea class="form-control" rows="5" name="agenda" placeholder="Meeting Agenda ..."></textarea>
									 </div>
									 <div class="form-group">
									  <label for="">Meeting Time</label>
									  <input type="time" name="meeting_time" onkeydown="return event.keyCode != 69" class="form-control" id="">
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