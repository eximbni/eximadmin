  <style>
  .di{ margin-right:38px;padding:6px;text-align:center;}
  </style>

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
						<h1>Apporve</h1>
					  </div>
					  <div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
						  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						  <li class="breadcrumb-item active">Apporve</li>
						</ol>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->
				</section>
				<section>
				<div class="row p-2">
					<div class="col-md-2 di" id="p">Pendding
					</div>
					<div id="a" class="col-md-2 di ">Approved
					</div>
					<div class="col-md-2 di" id="r">Rejected
					</div>
				</div>
				 
  
				</section>
			<section class="content" id="pendding">
    
				  <div class="card">
				
           
			   <div class="card-body">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>ID</th>
						  <th>Franch Type</th>
						  <th>User Id</th>
						  <th>Country Id</th>
						  <th>State Id</th>
						  <th>Chapter</th>
						 
						</tr>
						</thead>
						<tbody>
					   <tr>
						  <td>Trident</td>
						  <td>Internet</td>
						  <td>Internet</td>
						  <td>Internet</td>
						  <td>Internet</td>
						  <td>Internet</td>
						</tr>
						  
						</tbody>
						
						
					  </table>
					</div>
				 
			</div>
			</section>
			<section class="content" id="approve">
    
				  <div class="card">
				
           
			   <div class="card-body">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>ID</th>
						  <th>Franch Type</th>
						  <th>User Id</th>
						  <th>Country Id</th>
						  <th>State Id</th>
						  <th>Chapter</th>
						 
						</tr>
						</thead>
						<tbody>
					   <tr>
						  <td>Trident</td>
						  <td>Internet</td>
						  <td>Internet</td>
						  <td>Internet</td>
						  <td>Internet</td>
						  <td>Internet</td>
						</tr>
						  
						</tbody>
						
						
					  </table>
					</div>
				 
			</div>
			</section>
			<section class="content" id="rejected">
    
				  <div class="card">
				
           
			   <div class="card-body">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>ID</th>
						  <th>Franch Type</th>
						  <th>User Id</th>
						  <th>Country Id</th>
						  <th>State Id</th>
						  <th>Chapter</th>
						 
						</tr>
						</thead>
						<tbody>
					   <tr>
						  <td>Trident</td>
						  <td>Internet</td>
						  <td>Internet</td>
						  <td>Internet</td>
						  <td>Internet</td>
						  <td>Internet</td>
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
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
<script>
$(document).ready(function(){
	 
	  $("#approve").hide();
	  $("#rejected").hide();
	  $("#p").css("background", "yellow");
  $("#p").click(function(){
    $("#pendding").show();
	$("#p").css("background", "yellow");
	$("#a").css("background", "none");
		$("#r").css("background", "none");
	$("#approve").hide();
	  $("#rejected").hide();
  });
  $("#a").click(function(){
    $("#approve").show();
	
		$("#p").css("background", "none");
		$("#r").css("background", "none");
		$("#a").css("background", "yellow");
	$("#pendding").hide();
	 
	  $("#rejected").hide();
  });
  $("#r").click(function(){
    $("#rejected").show();
	
		$("#r").css("background", "yellow");
		$("#p").css("background", "none");
		$("#a").css("background", "none");
		
	$("#pendding").hide();
	  $("#approve").hide();
  });
});
</script>
</body>
</html>
