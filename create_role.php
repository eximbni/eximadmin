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
						<h4>Create Role</h4>
					  </div>
					  <div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
						  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						  <li class="breadcrumb-item active">Create Role</li>
						</ol>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->
				</section>
				<section>
				<div class="card p-3">
				<div class="container">
					<form role="form" >
									<div class="form-group">
									  <label for="">Admin Name</label>
									  <input type="text" class="form-control" id="" placeholder="Admin Name">
									</div>
									<div class="form-group">
									  <label>Select Role Name</label>
									  <select class="form-control">
										<option>select</option>
										<option>option 1</option>
										<option>option 2</option>
									  </select>
									</div>
									
									
							
								
								  <div class="box-footer text-right">
									<button type="submit" class="btn btn-outline-primary">Submit</button>
								  </div>
					 </form>
					 
				</div>
				</div>
				</section>
			</div>
</div>
 </body>
 </html>