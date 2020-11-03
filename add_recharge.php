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
						<h4 class="m-0 text-dark">Add Recharge</h4>
					  </div>
					  <div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
						  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						  <li class="breadcrumb-item active">Add Recharge</li>
						</ol>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->
				</section>
				<section>
				<div class="card p-3">
		
				<div class="container">
						<form role="form" >
							
								  <div class="box-body">
								  <div class="row">
									<div class="col-md-6">
										<div class="form-group">
										  <label>Select Recharge Plan</label>
										  <select class="form-control">
											<option>option 1</option>
											<option>option 2</option>
										  </select>
										</div>
										<div class="form-group">
										  <label>Select Ammount</label>
										  <select class="form-control">
											<option>option 1</option>
											<option>option 2</option>
										  </select>
										</div>
										<div class="form-group">
										  <label>Select Country</label>
										  <select class="form-control">
											<option>option 1</option>
											<option>option 2</option>
										  </select>
										</div>
										
								
										<div class="form-group">
										  <label for="">Commission</label>
										  <input type="number" class="form-control" onkeydown="return event.keyCode != 69" id="" placeholder="Commission">
										</div>
									
									</div>
								</div>
									 <div class="box-footer text-right">
									<button type="submit" class="btn btn-outline-primary">Submit</button>
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