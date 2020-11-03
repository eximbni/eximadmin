<?php
session_start();
include('config.php');
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
						Subscibed User List
						  </h3>
					  </div>
					  <div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
						  <li class="breadcrumb-item"><a href="#">Home</a></li>
						  <li class="breadcrumb-item active">Subscibed User List</li>
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
                  <th>Country</th>
                  <th>Subscribed Package</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                </tr>
                </thead>
                <tbody>
				<?php
				include("config.php");
				$sql_users = "SELECT u.*,cr.name as cntrname, sub.plan_name as plan_name FROM users u, countries cr, subscriptions sub where u.country_id=cr.country_id and u.subscription_id=sub.id and u.country_id = $country_id  and  u.subscription_id IS NOT NULL group by u.id order by u.id desc";
				$res_users = mysqli_query($conn,$sql_users);
				while($row_users=mysqli_fetch_array($res_users))
				{
				?>
                <tr>
                  <td><?php echo $row_users['id']; ?></td>
                  <td><?php echo $row_users['name']; ?></td>
                  <td><?php echo $row_users['mobile']; ?></td>
                  <td><?php echo $row_users['email']; ?></td>
                  <td><?php echo $row_users['cntrname']; ?></td>
                  <td><?php echo $row_users['plan_name']; ?></td>
                  <td><?php echo $row_users['subscription_start']; ?></td>
                  <td><?php echo $row_users['subscription_end']; ?></td>
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