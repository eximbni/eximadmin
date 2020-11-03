<?php 
session_start();
$country_id = $_SESSION['country']; 
?>

			<?php include("header.php")?>
		  <!-- /.navbar -->

		  <!-- Main Sidebar Container -->
		  <aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<?php include("sidemenu.php");?>
		  </aside>
			<div class="content-wrapper">
				<div class="container-fluid">
				<section class="content-header">
				  <div class="container-fluid">
					<div class="row mb-2">
					  <div class="col-sm-6">
						<h3>
						Franchise List
						  </h3>
					  </div>
					  <div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
						  <li class="breadcrumb-item"><a href="#">Home</a></li>
						  <li class="breadcrumb-item active">Franchise List</li>
						</ol>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->
	
			</section>
			<section class="content">
			<div class="row">
			<div class="col-12">
			<div class="card">
         
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Mobile</th>
                  <th>Email</th>
                  <th>State</th>
                  <th>Franchise Type</th>
                </tr>
                </thead>
                <tbody>
				<?php
				include("config.php");
				$country_id = $_SESSION['country']; 
				$sql_franch = "SELECT f.*, s.name as state FROM franchise_users f, state s where f.state_id = s.zone_id  and f.country_id = $country_id and f.franchise_type = 'SF'";
				$res_franch = mysqli_query($conn,$sql_franch);
				while($row_franch=mysqli_fetch_array($res_franch))
				{
				?>
                <tr>
                  <td><?php echo $row_franch['id']; ?></td>
                  <td><?php echo $row_franch['name']; ?></td>
                  <td><?php echo $row_franch['mobile']; ?></td>
                  <td><?php echo $row_franch['email']; ?></td>
                  <td><?php echo $row_franch['state']; ?></td>
                  <td><?php echo $row_franch['franchise_type']; ?></td>
                </tr>
                <?php } ?>
         
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          </div>
          </div>
          </section>

				</div>
			</div>
</div>
 </body>

<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.js"></script>

 <script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
 </html>