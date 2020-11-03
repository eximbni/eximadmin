<?php
$message='';
if(isset($_POST['submit'])){
	include("config.php");
	$subject = $_POST['subject'];
	$username=$_POST['username'];
	$desc= $_POST['description'];

	$sql = "insert into messages(user_id,subject,description,status) values('$username','$subject','$desc','1')";
	$res = mysqli_query($conn,$sql);
	if($res){
		$message = "Message Added Successfully";
	}
	else{
		$message = "Error adding Message";
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
				    <div class="col-md-12">
				  <div class="container-fluid">
					<div class="row mb-2">
					  <div class="col-sm-6">
						<h4>Message</h4>
					  </div>
					  <div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
						  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						  <li class="breadcrumb-item active">Message</li>
						</ol>
					  </div>
					</div>
				  </div>
				</section>
				<h2 style="color:red"><?php echo $message; ?></h2>
				<section class="col-md-12">
				<div class="card p-3">
				<div class="container">
					<form role="form" action="<?php echo $_SERVER['PHP-SELF']; ?>" method="POST">
									<div class="form-group">
									  <label> Select User</label>
									  <select class="form-control" name="username">
										<option>Select User</option>
										<?php
										include("config.php");
										$sql_user="select * from admin_users";
										$res_user=mysqli_query($conn,$sql_user);
										while($row_user=mysqli_fetch_array($res_user))
										{
										?>
										<option value="<?php echo $row_user['id'] ?>"><?php echo $row_user['name'] ?></option>
										<?php } ?>
									  </select>
									</div>
									<div class="form-group">
									  <label for="">Subject</label>
									  <input type="text" class="form-control" id="" name="subject" placeholder="Subject Here">
									</div>
									
									<div class="form-group">
									  <label for="exampleInputPassword1">Description </label>
									  <textarea placeholder="something Here" class="form-control" name="description"></textarea>
									</div>
												
								
								  <div class="box-footer text-right" >
									<input type="submit" class="btn btn-outline-primary" name="submit" value="Submit">
								  </div>
					 </form>
					 
				</div>
				</div>
				</div>
				</section>
			</div>
</div>
 </body>
 </html>