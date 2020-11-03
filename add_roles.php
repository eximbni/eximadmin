<?php
$message='';
if(isset($_POST['submit'])){
	include("config.php");
	$roles = $_POST['roles'];

	$sql = "insert into admin_user_roles(role_name,status) values('$roles','1')";
	$res = mysqli_query($conn,$sql);
	if($res){
		$message = "Roles Added Successfully";
	}
	else{
		$message = "Error adding roles";
		echo mysqli_error($conn);
	}
}
include('config.php');
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
					  <div class="col-sm-12">
						<ol class="breadcrumb float-sm-left">
						  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						  <li class="breadcrumb-item"><a href="">Admin User Module</a></li>
						  <li class="breadcrumb-item active">Roles</li>
						</ol>
					  </div>
					</div>
					<div class="row mb-2">
					  <div class="col-sm-12">
						<h4 style="text-align:center;"><b>Add Roles</b></h4>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->
	
				</section>
				
				<h4><?php echo $message; ?></h4>
				<section class="container">
				<div class="row"> 	
				<div class="card col-12">
				<div class="container">
					<form role="form" action="<?php echo $_SERVER['PHP-SELF']; ?>" method="POST">
						<div class="form-group">
							<label for="">Role</label>
							<input type="text" class="form-control" id="roles" name="roles" placeholder="Enter Roles" required="">
						</div>

	  				    <div class="box-footer text-right" >
							<input type="submit" class="btn btn-outline-primary" name="submit" value="Submit">
						</div>
					 </form>
					 
				</div>
				</div>
				
				</div>	
				</section>
				<section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body"> 
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
        						<?php
        						$sql_chk = "SELECT * FROM `admin_user_roles`";
        						//echo $sql_chk;
        						$query_chkres = mysqli_query($conn,$sql_chk);
        						if(mysqli_num_rows($query_chkres)>0){
        						$srno = 1;	
        							while($rows1 = mysqli_fetch_array($query_chkres)){
        							    if($rows1['status'] =='1'){
        							        $status ="Active";
        							    }else{
        							        $status= "Inactive";
        							    }        							    
        						?>	
        						   	<tr>
        							  <td align="center"><?= $srno; ?></td>
        							  <td align="left"><?= $rows1['role_name']; ?></td>
        							  <td align="center"><?= $status; ?></td>
        							</tr>
        						<?php
        							$srno++;
        							}
        						}
        						else{
        
        						}
        						?>
        						</tbody>
                            </table>
                        </div>  
                </div>
            </div>
        </div>
    </section> 
			</div>
</div>
 </body>
 </html>