<?php
$message='';
if(isset($_POST['submit'])){
	include("config.php");
	$username=$_POST['username'];
	$mobile=$_POST['mobile'];
	$email=$_POST['email'];
	$password=md5($_POST['password']);
    $role = $_POST['role'];
    $designation = $_POST['designation'];
	$join_date = $_POST['join_date'];
	$aleternate_number = $_POST['aleternate_number'];
	$chk = "select * from admin_users where email='$email'";
	$chkres = mysqli_query($conn,$chk);
	if(mysqli_num_rows($chkres)>0){
		$message="User Already exists";
	}
	else{
	$sql = "insert into admin_users(name,mobile,email,password,role,designation,joining,aleternate_number) values('$username','$mobile','$email','$password','$role','$designation','$join_date','$aleternate_number')";
	$res = mysqli_query($conn,$sql);
	if($res){
		$message = "User Added Successfully";
	}
	else{
		$message = "Error adding User";
		echo mysqli_error($conn);
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
						<h4>Create User</h4>
					  </div>
					  <div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
						  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						  <li class="breadcrumb-item active">Create User</li>
						</ol>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->
				</section>
				<section>
				<h2 style="color:red"><?php echo $message; ?></h2>
				<div class="card p-3">
				<div class="container">
					<form role="form" action="<?php echo $_SERVER['PHP-SELF']; ?>" method="POST">
									
									<div class="form-group">
									  <label for="">Username </label>
									  <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
									</div>
									<div class="form-group">
									  <label for="">Mobile No </label>
									  <input type="number" class="form-control" id="" name="mobile" placeholder="Mobile No" required>
									</div>
									<div class="form-group">
									  <label for="">Email </label>
									  <input type="email" class="form-control" id="" name="email" placeholder="Email" required>
									</div>
									<div class="form-group">
									  <label for="">Password </label>
									  <input type="password" class="form-control" name="password" id="" placeholder="******" required>
									</div>
									<div class="form-group">
									  <label>Role</label>
									  <select class="form-control" name="role">
									  <option>Select Role</option>
										<option>Super Admin</option>
										<option>Admin</option>
										<option>User</option>
									  </select>
									</div>
									<div class="form-group">
									  <label for="">User Designation</label>
									  <input type="text" class="form-control" id="" name="designation" placeholder="User Designation" required>
									</div>
									<div class="form-group">
									  <label for="">Joining Date</label>
									  <input type="date" class="form-control" id="" data-date-format="YYYY-MM-DD" name="join_date" placeholder="Join Date" required>
									</div>
									<div class="form-group">
									  <label for="">Alternate No </label>
									  <input type="number" class="form-control" id="" name="aleternate_number" placeholder="Alternate Number"required>
									</div>
									
								  <div class="box-footer text-right " >
									<input type="submit" class="btn btn-outline-primary" name="submit" value="Submit">
								  </div>
					 </form>
					 
				</div>
				</div>
				</section>
			</div>
</div>
 </body>
 </html>