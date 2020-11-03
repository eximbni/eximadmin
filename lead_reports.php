  

			<?php include "header.php"?>
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
						<h1>Lead Reports</h1>
					  </div>
					  <div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
						  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						  <li class="breadcrumb-item active">Lead Reports</li>
						</ol>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->
				</section>
				
			<section class="content">
				<div class="card">
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					<div class="card-body">
					<div class="row">
						<div class="col-5">
						<label>Select Type</label>
						<select class="form-control" name="type" id="type">
							<option value="">Select Type</option>
							<option value="Buy">Buy</option>
							<option value="Sell">Sell</option>
						</select>
						</div>
						<div class="col-5">
						<label>Select Country</label>
						
						<select class="form-control" name="country" id="country">
							<option value=''>Select Country</option>
							<?php
							include("config.php");
							$get_country = "SELECT * FROM `countries`";
							$res_country = mysqli_query($conn,$get_country);
							while($row_country=mysqli_fetch_array($res_country))
							{
								echo "<option value=".$row_country['country_id'].">".$row_country['name']."</option>";
							} 
							?>
						</select>
						</div>
						<div class="col-2" style="margin-top:3%">
							<button type="submit" class="btn btn-outline-primary" name="search">Search</button>
						</div>
				</form>
					</div>
					</div>
				</div>
				
				  <div class="card">
				
           
			   <div class="card-body">
					  
					  <table id="example2" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>ID</th>
						  <th>HSN Code</th>
						  <th>Chapter</th>
						  <th>Category</th>
						  <th>Product</th>
						  <th>Uom</th>
						  <th>Quantity</th>
						  <th>Description</th>
						  <th>Posted Date</th>
						  <th>Expiry Date</th>
						  <th>Lead Status</th>
						 
						 
						</tr>
						</thead>
						<tbody id="lead_report">
							<?php
							if(isset($_POST['search']))
							{
								include("config.php");
								$lead_type=$_POST['type'];
								$country_id=$_POST['country'];
								$sql_leads = "select * from leads where lead_type='$lead_type' and country_id='$country_id'";
								$res_leads = mysqli_query($conn,$sql_leads);
								$row_count = mysqli_num_rows($res_leads);
								$id=1;
								if($row_count>0)
								{
								while($row_leads=mysqli_fetch_array($res_leads))
								{
									$hsn_id = $row_leads['hsn_id'];
									$sql_hsn = "select * from hsncodes where id='$hsn_id'";
									$res_hsn = mysqli_query($conn,$sql_hsn);
									$rows_hsn = mysqli_fetch_array($res_hsn);
									$hsncode = $rows_hsn['hsncode'];
									
									$chapter_id = $row_leads['chapter_id'];
									$sql_chapter = "select * from chapters where id='$chapter_id'";
									$res_chapter = mysqli_query($conn,$sql_chapter);
									$rows_chapter = mysqli_fetch_array($res_chapter);
									$chapter_name = $rows_chapter['chapter_name'];
									
									$categories_id = $row_leads['categories_id'];
									$sql_categories = "select * from categories where id='$categories_id'";
									$res_categories = mysqli_query($conn,$sql_categories);
									$rows_categories = mysqli_fetch_array($res_categories);
									$category_name = $rows_categories['category_name'];
									
									$product_id = $row_leads['product_id'];
									$sql_products = "select * from products where id='$product_id'";
									$res_products = mysqli_query($conn,$sql_products);
									$rows_products = mysqli_fetch_array($res_products);
									$product_name = $rows_products['product'];
									
									$uom_id = $row_leads['uom_id'];
									$sql_uoms = "select * from uoms where id='$uom_id'";
									$res_uoms = mysqli_query($conn,$sql_uoms);
									$rows_uoms = mysqli_fetch_array($res_uoms);
									$uom = $rows_uoms['uom'];
									
									$quantity = $row_leads['quantity'];
									$description = trim($row_leads['description']);
									$posted_date = $row_leads['posted_date'];
									$expiry_date = $row_leads['expiry_date'];
									$status = $row_leads['status'];
									if($status==0)
									{
										$status="Pending";
									}
									elseif($status==1)
									{
										$status="Approved";
									}
									elseif($status==99)
									{
										$status="Rejected";
									}
									else
									{
										$status="Pending";
									}
									
									echo $data = "<tr><td>$id</td><td>$hsncode</td><td>$chapter_name</td><td>$category_name</td><td>$product_name</td><td>$uom</td><td>$quantity</td><td>$description</td><td>$posted_date</td><td>$expiry_date</td><td>$status</td></tr>";
									$id++;
								}
								}
								else
								{
									echo "<tr><td colspan='11' align='center'>No Leads For This Country</td></tr>";
								}
							}
							?>
						</tbody>
						
					  </table>
					</div>
				 
			</div>
			</section>
			</div>


<!-- DataTables -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->

<script>
  $(function () {
    $("#example1").DataTable({
		"paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
	});
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
  });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
/* $('#country').on('change', function() {
  var country = $('#country').val();
  var type = $('#type').val();
  $.ajax({
		type:"post",
		url:"get_leads.php",
		data:{
			country:country,
			type:type
		},
		//dataType:'json',
		success:function(response)
		{
			//alert(response);
			$("#lead_report").empty();
			$("#lead_report").append(response);
		},
		error:function(error)
		{
			alert(error);
		},
	});
}); */
</script>
</body>
</html>
