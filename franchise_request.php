<?php 
session_start();
$country_id = $_SESSION['country']; 
$message='';
	include("config.php");
	if(isset($_POST['approve']))
	{
		$id = $_POST['approve_id'];
		$commission = $_POST['commission'];
		$sql_accept = "update franchise_request set status='1', commission='$commission' where id='$id'";
		$res_accept = mysqli_query($conn,$sql_accept);
		if($res_accept)
		{
		    $sql_franch1 = "SELECT fr.*,frt.franchise,frt.code,u.name,u.mobile,u.email,u.id as user_id,c.name as country, s.name as state FROM  franchise_request fr, franchise_type frt , users u, countries c,state s WHERE  fr.franchise_type_id=frt.id and fr.user_id=u.id and fr.country_id=c.country_id and fr.state_id=s.zone_id and fr.id='$id'";
							$res_franch1 = mysqli_query($conn,$sql_franch1);
							while($row=mysqli_fetch_array($res_franch1))
							{
							  $name=$row["name"];
							  $mobile = $row["mobile"];
							  $email = $row["email"];
							  $commission =$row["commission"];
							  $franchise_type = $row["franchise"];
							  $country_id = $row["country_id"];
							  $state_id =$row["state_id"];
							  $chapter = $row["chapter"];
							  $code = $row["code"];
							  $user_id = $row["user_id"];
							  $frcode = $code.$country_id.$state_id.$chapter;
							}
		    $ins = "insert into franchise_users (name,mobile,email,franchise_type,country_id,state_id,chapter_id,commission,amount,frcode,status) values('$name','$mobile','$email','$code','$country_id','$state_id','$chapter','$commission','100','$frcode','1')";
		    $resins = mysqli_query($conn,$ins);
		    if($resins){
		        $upduser = "update users set isfranchise=1 where id='$user_id'";
		        $resupd = mysqli_query($conn,$upduser);
		        	$message="<div class='alert alert-success'>Franchise Approved</div>";
			echo "franchise approved";
		    }
		
		}
		else
		{
			$message="<div class='alert alert-danger'>Failed to approve franchise </div>";
			echo "Failed to approve franchise";
			echo mysqli_error($conn);
		}
	}
	
	if(isset($_POST['reject']))
	{
		$id = $_POST['reject_id'];
		$reason = $_POST['reason'];
		$sql_reject = "update franchise_request set status='99', reason='$reason' where id='$id'";
		$res_reject = mysqli_query($conn,$sql_reject);
		if($res_reject)
		{
			echo "franchise rejected";
			$message="<div class='alert alert-success'>Franchise rejected</div>";
		}
		else
		{
			$message="<div class='alert alert-danger'>Failed to reject franchise </div>";
			echo "Failed to reject franchise";
			echo mysqli_error($conn);
		}
	}
?>  
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
						<h4><b>Franchise Request</b></h4>
					  </div>
					  <?php echo $message; ?>
					  <div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
						  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						  <li class="breadcrumb-item active">Request</li>
						</ol>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->
				</section>
				<section>
				<div class="row p-2">
					<div class="col-md-2 di" id="p">Pending
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
						  <th>User Name</th>
						  <th>Mobile</th>
						  <th>Email</th>
						  <th>State</th>
						  <th>Action</th>
						  <th>Action</th>
						 
						</tr>
						</thead>
						<tbody>
							<?php
								$srno=1;
								include("config.php");
								$country_id = $_SESSION['country'];
								//echo $sql_franch = "SELECT fr.*,frt.franchise,u.name,u.mobile,u.email,c.name as country, s.name as state FROM  franchise_request fr, franchise_type frt , users u, countries c,state s WHERE  fr.franchise_type_id=frt.id and fr.user_id=u.id and fr.country_id=c.country_id and fr.state_id=s.zone_id and fr.status='0'";
								$sql_franch = "select fr.*, t.franchise, u.name,u.mobile,u.email,s.name as state from franchise_request as fr, franchise_type as t, users as u, state s WHERE fr.country_id = $country_id and fr.status = 0 and fr.franchise_type_id = t.id and fr.user_id = u.id and fr.state_id=s.zone_id";
								$res_franch = mysqli_query($conn,$sql_franch);
								while($row_franch=mysqli_fetch_array($res_franch))
								{
								?>
								<tr>
								  <td><?php echo $srno; ?></td>
								  <td><?php echo $row_franch['franchise']; ?></td>
								  <td><?php echo $row_franch['name']; ?></td>
								  <td><?php echo $row_franch['mobile']; ?></td>
								  <td><?php echo $row_franch['email']; ?></td>
								  <td><?php echo $row_franch['state']; ?></td>
								  <td><button type="button" data-toggle="modal" data-target="#exampleModal" id="<?php echo $row_franch['id']; ?>" onclick="approve(this.id)" class="btn btn-outline-success bt">Apporve</button></td>
								<td><button type="button" data-toggle="modal" data-target="#exampleModal1" id="<?php echo $row_franch['id']; ?>" onclick="reject(this.id)" class="btn btn-outline-danger btt">  Reject</button> </td>
								</tr>
							<?php $srno++; } ?>
						  
						</tbody>
						
						
					  </table>
					</div>
				 
			</div>
			</section>
			<section class="content" id="approve">
    
				  <div class="card">
				
           
			   <div class="card-body">
					  <table id="example2" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>ID</th>
						  <th>Franch Type</th>
						  <th>User Id</th>
						  <th>State Id</th>
						 
						</tr>
						</thead>
						<tbody>
					   <?php
							$srno=1;
							include("config.php");
							$sql_franch = "select fr.*, t.franchise, u.name,u.mobile,u.email,s.name as state from franchise_request as fr, franchise_type as t, users as u, state s WHERE fr.country_id = $country_id and fr.status = 1 and fr.franchise_type_id = t.id and fr.user_id = u.id and fr.state_id=s.zone_id";
							$res_franch = mysqli_query($conn,$sql_franch);
							while($row_franch=mysqli_fetch_array($res_franch))
							{
							?>
							<tr>
							  <td><?php echo $srno; ?></td>
							  <td><?php echo $row_franch['franchise']; ?></td>
							  <td><?php echo $row_franch['name']; ?></td>
							  <td><?php echo $row_franch['state']; ?></td>
							</tr>
						<?php $srno++; } ?>
						  
						</tbody>
						
						
					  </table>
					</div>
				 
			</div>
			</section>
			<section class="content" id="rejected">
    
				  <div class="card">
				
           
			   <div class="card-body">
					  <table id="example3" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>ID</th>
						  <th>Franch Type</th>
						  <th>User</th>
						  <th>State Id</th>
						  
						</tr>
						</thead>
						<tbody>
						  <?php
							$srno=1;
							include("config.php");
							$sql_franch = "select fr.*, t.franchise, u.name,u.mobile,u.email,s.name as state from franchise_request as fr, franchise_type as t, users as u, state s WHERE fr.country_id = $country_id and fr.status = 99 and fr.franchise_type_id = t.id and fr.user_id = u.id and fr.state_id=s.zone_id";
							$res_franch = mysqli_query($conn,$sql_franch);
							while($row_franch=mysqli_fetch_array($res_franch))
							{
							?>
							<tr>
							  <td><?php echo $srno; ?></td>
							  <td><?php echo $row_franch['franchise']; ?></td>
							  <td><?php echo $row_franch['name']; ?></td>
							  <td><?php echo $row_franch['state']; ?></td>
							 </tr>
						  <?php $srno++; } ?>
						  
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
      <div class="modal-body">
	  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<input type="number" name="commission" onkeydown="return event.keyCode !=69" class="form-control" placeholder="Enter Commission">
		<input type="hidden" name="approve_id" id="approve_id" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <!--button type="button" class="btn btn-primary">Ok</button-->
		<input type="submit" name="approve" class="btn btn-primary" value="Ok">
		</form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Reason</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <div class="modal-body">
		<input type="text"  class="form-control" placeholder="Enter Reason" name="reason" required  size="10">
		<input type="hidden" name="reject_id" id="reject_id" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <!--button type="button" class="btn btn-primary">Ok</button-->
		<input type="submit" name="reject" class="btn btn-primary" value="Ok">
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
	 $('#example3').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
  });
</script>
<script>
$(document).ready(function(){
	 
	  $("#approve").hide();
	  $("#rejected").hide();
	  $("#p").css("background", "white");
  $("#p").click(function(){
    $("#pendding").show();
	$("#p").css("background", "white");
	$("#a").css("background", "none");
		$("#r").css("background", "none");
	$("#approve").hide();
	  $("#rejected").hide();
  });
  $("#a").click(function(){
    $("#approve").show();
	
		$("#p").css("background", "none");
		$("#r").css("background", "none");
		$("#a").css("background", "white");
	$("#pendding").hide();
	 
	  $("#rejected").hide();
  });
  $("#r").click(function(){
    $("#rejected").show();
	
		$("#r").css("background", "white");
		$("#p").css("background", "none");
		$("#a").css("background", "none");
		
	$("#pendding").hide();
	  $("#approve").hide();
  });
});
</script>
<script>
function approve(clicked_id)
{
	//alert(clicked_id);
	document.getElementById("approve_id").value=clicked_id;
}
function reject(clicked_id)
{
	//alert(clicked_id);
	document.getElementById("reject_id").value=clicked_id;
}
</script>
</body>
</html>
