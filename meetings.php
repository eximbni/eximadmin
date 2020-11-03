  

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
						<h1>Meetings</h1>
					  </div>
					  <div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
						  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						  <li class="breadcrumb-item active">Meetings</li>
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
						  <th>Meeting Title</th>
						  <th>Meeting Agenda</th>
						  <th>Meeting Date</th>
						  <th>Meeting Time</th>
						  <th>Chapters</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$i=1;
						$Chapters = "";
						include("config.php");
						$sql_meeting = "select * from meeting group by title";
						$res_meeting = mysqli_query($conn,$sql_meeting);
						while($row_meeting = mysqli_fetch_array($res_meeting))
						{
							$title = $row_meeting['title'];
						
						$Chapters = "";
						$sql_meeting1 = "select chapters from meeting where title='$title'";
						$res_meeting1 = mysqli_query($conn,$sql_meeting1);
						while($row_meeting1 = mysqli_fetch_array($res_meeting1))
						{
							$chapter_id = $row_meeting1['chapters'];
							$sql_chapter = "select * from chapters where id='$chapter_id'";
							$res_chapter = mysqli_query($conn,$sql_chapter);
							$row_chapter = mysqli_fetch_array($res_chapter);
							$chaptername = $row_chapter['chapter_name'];
							$Chapters = $Chapters.", ".$chaptername;
							$Chapters = ltrim($Chapters,",");
						}
						?>
					   <tr>
						  <td><?php echo $i; ?></td>
						  <td><?php echo $row_meeting['title']; ?></td>
						  <td><?php echo $row_meeting['agenda']; ?></td>
						  <td><?php echo $row_meeting['meeting_date']; ?></td>
						  <td><?php echo $row_meeting['meeting_time']; ?></td>
						  <td><?php echo $Chapters; ?></td>
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
        <h5 class="modal-title" id="exampleModalLabel"><b>Reply</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<textarea class="form-control" placeholder="Reply Here.." name="desc"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Ok</button>
      </div>
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
</body>
</html>
