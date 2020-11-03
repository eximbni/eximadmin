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
						<h1>Feedback</h1>
					  </div>
					  <div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
						  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						  <li class="breadcrumb-item active">Feedback</li>
						</ol>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->
				</section>
				
			<section class="content">
    
				  <div class="card">
				<?php echo $message; ?>
           
			   <div class="card-body">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>ID</th>
						  <th>User Name</th>
						  <th>Subject</th>
						  <th>Message</th>
						  <th>Mobile</th>
						  <th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$i=1;
						include("config.php");
						$sql_feedback = "select * from notifications";
						$res_feedback = mysqli_query($conn,$sql_feedback);
						while($row_feedback=mysqli_fetch_array($res_feedback))
						{
							$user_id = $row_feedback['user_id'];
							$sql_user = "select * from users where id='$user_id'";
							$res_user = mysqli_query($conn,$sql_user);
							$row_user=mysqli_fetch_array($res_user);
							$username = $row_user['name'];
							$mobile = $row_user['mobile'];
						?>
					   <tr>
						  <td><?php echo $i; ?></td>
						  <td><?php echo $username; ?></td>
						  <td><?php echo $row_feedback['subject']; ?></td>
						  <td><?php echo $row_feedback['message']; ?></td>
						  <td><?php echo $mobile; ?></td>
						  <td><button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModal" id="<?php echo $row_feedback['id']; ?>" onclick="reply(this.id)">Reply</button></td>
						</tr>
						
						<?php $i++; } ?>
						
						</tbody>
					  </table>
					</div>
				 
			</div>
			</section>
			</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Commission</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form role="form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
      <div class="modal-body">
		<input type="text" name="message" class="form-control" placeholder="Enter Message">
		<input type="hidden" name="feedback_id" id="feedback_id" class="form-control" placeholder="Enter Message">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
		<input type="submit" class="btn btn-primary" name="submit" value="OK">
      </div>
	  </form>
    </div>
  </div>
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
function reply(clicked_id)
{
	//alert(clicked_id);
	document.getElementById("feedback_id").value=clicked_id;
}
</script>
</body>
</html>