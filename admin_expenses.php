

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
						<h1>Admin Expenses</h1>
					  </div>
					  <div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
						  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						  <li class="breadcrumb-item active">Admin Expenses</li>
						</ol>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->
				</section>
				
			<section class="content">
    <label for="start">Select month:</label>

<input type="month" id="start" name="start"
       min="2018-03" value="2018-05">
				  <div class="card">
				
           
			   <div class="card-body">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>ID</th>
						  <th>Name</th>
						  <th>Amount</th>
						  <th>Due Amount</th>
						  <th>Payment Type</th>
						  <th>Payment Date</th>
						  <th>Payment Status</th>
						 
						 
						 
						</tr>
						</thead>
						<tbody>
					   <tr>
						  <td>Trident</td>
						  <td>Trident</td>
						  <td>Trident</td>  
						  <td>Trident</td>
						  <td>Trident</td>
						  <td>Trident</td>
						  <td>Trident</td>
						</tr>
						<tr>
						  <td>Trident</td>
						  <td>Trident</td>
						  <td>Trident</td>
						  <td>Trident</td>
						  <td>Trident</td>
						  <td>Trident</td>
						  <td>Trident</td>
						</tr>  
						<tr>
						  <td>Trident</td>
						  <td>Trident</td>
						  <td>Trident</td>
						  <td>Trident</td>
						  <td>Trident</td>
						  <td>Trident</td>
						  <td>Trident</td>
						</tr> 
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
</body>
</html>
