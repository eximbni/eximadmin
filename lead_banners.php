<?php 
session_start();
$country_id = $_SESSION['country'];
include("config.php");

?>

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
						<h1>Lead Banner</h1>
					  </div>
					  <div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
						  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						  <li class="breadcrumb-item active">Lead Banner</li>
						</ol>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->
				</section>
				
			<section class="content">
    
				  <div class="card">
				
           
			   <div class="card-body">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>ID</th>
						  <th>Posted By</th>
						  <th>Chapter</th>
						  <th>Image</th>
						  <th>Start Date</th>
						  <th>End Date</th>
						</tr>
						</thead>
						<tbody>
						    <?php 
						    $i=1;
						    include("config.php");
						    $sql_banner = "SELECT b.*,u.name as username,c.name as country FROM post_banners b, users u, countries c where b.posted_by=u.id and b.country_id=c.country_id and b.country_id = $country_id";
						    $res_banner = mysqli_query($conn,$sql_banner);
						    while($row_banner = mysqli_fetch_array($res_banner))
						    {
						    ?>
					   <tr>
					      <td><?php echo $i; ?>
						  <td><?php echo $row_banner['username']; ?></td>
						  <td><?php echo "CH".$row_banner['chapter_id']; ?></td>
						  <td><?php echo "<img src='".$row_banner['banner_image']."' class='img-circle' width='50' height='50'>"; ?></td>
						  <td><?php echo $row_banner['start_date']; ?></td>
						  <td><?php echo $row_banner['end_date']; ?></td>
						</tr>
						<?php $i++; } ?>
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
</body>
</html>
