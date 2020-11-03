<?php
$message='';
if(isset($_POST['submit'])){
	include("config.php");
	$name=$_POST['name'];
	$mobile=$_POST['mobile'];
	$email=$_POST['email'];
	$continent_id = $_POST['continent_id'];
	$region_id = $_POST['region_id'];
	$country_id = $_POST['country_id'];
	$commission = $_POST['commission'];
	$amount = $_POST['amount'];
	$created_date = date("Y-m-d");
	$expiry_date = $_POST['expiry_date'];
	$frcode = "cf.".$country_id;
	$chk = "select * from franchise_users where frcode='$frcode'";
	$chkres = mysqli_query($conn,$chk);
	if(mysqli_num_rows($chkres)>0){
		$message="Franchise Already exists in this continent";
	}
	else{
	$sql = "insert into franchise_users(name,mobile,email,franchise_type,continent_id,region_id,country_id,created_date,expiry_date,commission,amount,frcode,status) values('$name','$mobile','$email,','cf','$continent_id','$region_id','$country_id','$created_date','$expiry_date','$commission','$amount','$frcode','1')";
	$res = mysqli_query($conn,$sql);
	if($res){
		$message = "Franchise Added Successfully";
	}
	else{
		$message = "Error Adding Franchise";
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
						<h4 class="m-0 text-dark">Add Country Franchise</h4>
					  </div>
					  <div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
						  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						  <li class="breadcrumb-item active">Add Country Franchise</li>
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
										  <label>Select Continent</label>
										  <select class="form-control" name="continent_id" required>
											<option> select</option>
										<?php include("config.php");
						$get = "select * from sevencontinents";
						$res = mysqli_query($conn,$get);
						if ($res){
							while($row=mysqli_fetch_assoc($res)){
						?>
										<option value="<?php echo $row['id'];?>"><?php echo $row['gcontinent'];?></option>
						<?php }} ?>	
										  </select>
										</div>
										<div class="form-group">
										  <label>Select Region</label>
										  <select class="form-control" name="region_id" required>
											<option> select</option>
										<?php include("config.php");
						$get = "select * from continents";
						$res = mysqli_query($conn,$get);
						if ($res){
							while($row=mysqli_fetch_assoc($res)){
						?>
										<option value="<?php echo $row['id'];?>"><?php echo $row['continent'];?></option>
						<?php }} ?>	
										  </select>
										</div>
										<div class="form-group">
										  <label>Select Country</label>
										  <select class="form-control" name="country_id" required>
											<option> select</option>
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
										  <label for="">Name</label>
										  <input type="text" name="name" onkeydown="return event.keyCode != 69"  class="form-control" id="" placeholder="Name" required>
										</div>
										<div class="form-group">
										  <label for="">mobile</label>
										  <input type="number" name="mobile" onkeydown="return event.keyCode != 69"  class="form-control" id="" placeholder="Mobile" required>
										</div>
									</div>
									<div class="col-md-6">
										
										
										<div class="form-group">
										  <label for="">email</label>
										  <input type="email" name="email" onkeydown="return event.keyCode != 69"  class="form-control" id="" placeholder="email" required>
										</div>
										<div class="form-group">
										  <label for="">Commission</label>
										  <input type="number" name="commission" onkeydown="return event.keyCode != 69"  class="form-control" id="" placeholder="Commission" required>
										</div>
										<div class="form-group">
										  <label for="">Franchise Amount</label>
										  <input type="number" name="amount" onkeydown="return event.keyCode != 69" class="form-control" id="" placeholder="Franchise Amount" required>
										</div>
										<div class="form-group">
										  <label for="">Franchise valid till</label>
										  <input type="date" name="expiry_date" onkeydown="return event.keyCode != 69" class="form-control" id=""  required>
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
 </body>
 </html>