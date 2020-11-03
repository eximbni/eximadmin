<?php 
session_start();
$country_id = $_SESSION['country'];
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$message='';
	include("config.php");
	if(isset($_POST['approve_lead']))
	{
		//echo "hi";
		$lead_id = $_POST['approve_lead_id'];
		$lead_cost = $_POST['lead_cost'];
		$sql_accept = "update leads set status='1', lead_cost='$lead_cost' where id='$lead_id'";
		$res_accept = mysqli_query($conn,$sql_accept);
		if($res_accept)
		{
			$sql_postedby = "select u.email from leads l, users u where l.posted_by=u.id and l.id='$lead_id'";
			$res_postedby = mysqli_query($conn,$sql_postedby);
			$row_postedby = mysqli_fetch_array($res_postedby);
			$uemail = $row_postedby['email'];
			//email sending
			require 'Mailer/src/PHPMailer.php';
			require 'Mailer/src/SMTP.php';

			$email = 'patilvrushabh1008@gmail.com';
			$password = 'patil28vrushabh';
			$to_id = $uemail;
			$message='<html>
			<body style="margin:0;">
			<table cellpadding="0" cellspacing="2" border="0" width="800px" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; border:1px solid #cacaca;">
			<tr>
				<td style="background:#82ae46; color:#FFFFFF; font-size:12px;">
					<table width="100%" border="0" cellspacing="5" cellpadding="0">
					 <tr>
						<td>+91 97059 99345</td>
						<td>&nbsp;</td>
						<td style="text-align:right">dailyandfreshly@gmail.com</td>
					  </tr>
					</table>
						</td>
			<tr>
				<td>
					<a href="http://dailyandfreshly.com" target="_blank"><img width="100%" src="https://vibrantfresh.com/media/wysiwyg/slider-banners-12-grocery_1.jpg" /></a>
				</td>
			</tr>
			<tr>
				<td style="text-align:center">
					<h2 style="color:#82ae46">Welcome To Exim BNI</h2>
					<p>Your lead has been approved.</p>
				</td>
			</tr>
			</tr>
			<td style="background:#82ae46; color:#FFFFFF; font-size:12px;">
					<table width="100%" border="0" cellspacing="4" cellpadding="5">
					 <tr>
						<td>+91 97059 99345</td>
						<td>&nbsp;</td>
						<td style="text-align:right">dailyandfreshly@gmail.com</td>
					  </tr>
					</table>
						</td>
			</table>
			</body>
			</html>';
			echo $message;
			$subject = 'Welcome To EXIM BNI';
			$mail = new PHPMailer();
			$mail->setFrom('patilvrushabh1008@gmail.com', 'Mailer');
			/* $mail->isSMTP();
			$mail->Host = 'mail.dailyandfreshly.com';
			$mail->Port = 25;
			$mail->SMTPSecure = 'none';
			$mail->SMTPAuth = true;
			$mail->Username = $email;
			$mail->Password = $password;
			$mail->addAddress($to_id);
			$mail->Subject = $subject;
			$mail->msgHTML($message); */
			
			
			$mail = new PHPMailer;
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = 587;
			$mail->SMTPSecure = 'tls';
			$mail->SMTPAuth = true;
			$mail->Username = $email;
			$mail->Password = $password;
			$mail->addAddress($to_id);
			$mail->Subject = $subject;
			$mail->msgHTML($message);

			if (!$mail->send()) {
			$error = "Mailer Error: " . $mail->ErrorInfo;
			echo '<p id="para">'.$error.'</p>';
			echo '<p id="para">'.$to_id.'</p>';
			echo "<script type='text/javascript'>alert('Failed To Send Mail.');</script>";
			
			}
			else {
			echo "<script type='text/javascript'>alert('Mail Send Successfully.');</script>";
			
			}
			//email sending
			
			$message="<div class='alert alert-success'>Lead Approved</div>";
			//echo "lead approved";
		}
		else
		{
			$message="<div class='alert alert-danger'>Failed to approve lead </div>";
			//echo "Failed to approve lead";
			//echo mysqli_error($conn);
		}
	}
	
	if(isset($_POST['reject_lead']))
	{
		$lead_id = $_POST['reject_lead_id'];
		$reason = $_POST['reason'];
		$sql_reject = "update leads set status='99', reason='$reason' where id='$lead_id'";
		$res_reject = mysqli_query($conn,$sql_reject);
		if($res_reject)
		{
			//echo "lead rejected";
			$message="<div class='alert alert-success'>Lead rejected</div>";
		}
		else
		{
			$message="<div class='alert alert-danger'>Failed to reject lead </div>";
			//echo "Failed to reject lead";
			//echo mysqli_error($conn);
		}
	}
?>
<style>
.bt{
    margin-bottom: 4px;}

  .di{ margin-right:38px;padding:6px;text-align:center;}

</style>
			<?php include "header.php"?>
		  <!-- /.navbar -->

		  <!-- Main Sidebar Container -->
		  <aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<?php include("sidemenu.php");?>
		  </aside>
			<div class="content-wrapper"   >
				 <section class="content-header"  >
					  <div class="container-fluid">
						<div class="row mb-2">
						  <div class="col-sm-6">
							<h4>Lead Request</h4>
						  </div>
						  <?php echo $message; ?>
						  <div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
							  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
							  <li class="breadcrumb-item active">Lead Request</li>
							</ol>
						  </div>
						</div>
					  </div>
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
				
		<section id="pendding">
			<div class="card" >
         
            <div class="card-body" style="overflow:scroll" >
				<table id="example1"  class="table table-bordered table-striped">
					<thead>
							<tr>
							  <th>ID</th>
							  <th>Lead Type</th>
							  <th>Ref ID</th>
							  <th>Posted By</th>
							  <th>HSN Code</th>
							  <th>Chapter</th>
							  <th>Category</th>
							  <th>Quantity</th>
							  <th>Uom</th>
							  <th>Description</th>
							  <th>Posted Date</th>
							  <th>Expiry Date</th>
							  <th>Action</th>
							
							</tr>
					</thead>
					<tbody>
					<?php 
					$i=1;
					include("config.php");
				    $sql_pend = "SELECT l.*, u.name, c.ch_description, ca.category_name, uo.uom from leads l, users u, chapters c, categories ca, uoms uo where uo.id =l.uom_id and l.chapter_id = ca.id and l.chapter_id = c.id and u.id = l.posted_by and l.status = 0 and l.country_id = $country_id";
					$res_pend = mysqli_query($conn,$sql_pend);
					while($row_pend=mysqli_fetch_array($res_pend)) { ?>
							<tr>
								<td><?php echo $i; ?></td>
							    <td><?php echo $row_pend['lead_type']?></td>
								<td><?php echo $row_pend['leadref_id']?></td>
								<td><?php echo $row_pend['name']?></td>
								<td><?php echo $row_pend['hsn_id']?></td>
								<td><?php echo $row_pend['ch_description']?></td>
								<td><?php echo $row_pend['category_name']?></td>
								<td><?php echo $row_pend['quantity']?></td>
								<td><?php echo $row_pend['uom']?></td>
								<td><?php echo $row_pend['description']?></td>
								<td><?php echo $row_pend['posted_date']?></td>
								<td><?php echo $row_pend['expiry_date']?></td>
							   	<td><button type="button" data-toggle="modal" data-target="#exampleModal" id="<?php echo $row_pend['id']; ?>" onclick="approve_lead(this.id)" class="btn btn-outline-success bt">Apporve</button></td>
								<td><button type="button" data-toggle="modal" data-target="#exampleModal1" id="<?php echo $row_pend['id']; ?>" onclick="reject_lead(this.id)" class="btn btn-outline-danger btt">  Reject</button> </td>
								
							</tr>
							
					<?php $i++; } ?>
					</tbody>
				</table>
			</div>
            <!-- /.card-body -->
			</div>
		</section>
		
		<section id="approve">
			<div class="card" >
         
            <div class="card-body"  >
				<table id="example1"  class="table table-bordered table-striped">
				<thead>
							<tr>
							  <th>ID</th>
							  <th>Lead Type</th>
							  <th>Ref ID</th>
							  <th>Posted By</th>
							  <th>HSN Code</th>
							  <th>Chapter</th>
							  <th>Category</th>
							  <th>Quantity</th>
							  <th>Uom</th>
							  <th>Description</th>
							  <th>Posted Date</th>
							  <th>Expiry Date</th>
							 
							
							</tr>
					</thead>
					<tbody>
					<?php 
					$i=1;
					include("config.php");
				    $sql_app = "SELECT l.*, u.name, c.ch_description, ca.category_name, uo.uom from leads l, users u, chapters c, categories ca, uoms uo where uo.id =l.uom_id and l.chapter_id = ca.id and l.chapter_id = c.id and u.id = l.posted_by and l.status = 1 and l.country_id = $country_id";
					$res_app = mysqli_query($conn,$sql_app);
					while($row_app=mysqli_fetch_array($res_app)) { ?>
							<tr>
								<td><?php echo $i; ?></td>
							    <td><?php echo $row_app['lead_type']?></td>
								<td><?php echo $row_app['leadref_id']?></td>
								<td><?php echo $row_app['name']?></td>
								<td><?php echo $row_app['hsn_id']?></td>
								<td><?php echo $row_app['ch_description']?></td>
								<td><?php echo $row_app['category_name']?></td>
								<td><?php echo $row_app['quantity']?></td>
								<td><?php echo $row_app['uom']?></td>
								<td><?php echo $row_app['description']?></td>
								<td><?php echo $row_app['posted_date']?></td>
								<td><?php echo $row_app['expiry_date']?></td>
								
							</tr>
							
					<?php $i++; } ?>
					</tbody>
				</table>
			</div>
            <!-- /.card-body -->
			</div>
		</section>
		<section id="rejected">
			<div class="card" >
         
            <div class="card-body" style="overflow:scroll" >
				<table  id="example1"  class="table table-bordered table-striped">
					<thead>
							<tr>
							  <th>ID</th>
							  <th>Lead Type</th>
							  <th>Ref ID</th>
							  <th>Posted By</th>
							  <th>HSN Code</th>
							  <th>Chapter</th>
							  <th>Category</th>
							  <th>Quantity</th>
							  <th>Uom</th>
							  <th>Description</th>
							  <th>Posted Date</th>
							  <th>Expiry Date</th>
							 
							
							</tr>
					</thead>
					<tbody>
					<?php 
					$i=1;
					include("config.php");
					$sql_rej = "SELECT l.*, u.name, c.ch_description, ca.category_name, uo.uom from leads l, users u, chapters c, categories ca, uoms uo where uo.id =l.uom_id and l.chapter_id = ca.id and l.chapter_id = c.id and u.id = l.posted_by and l.status = 99 and l.country_id = $country_id";
					$sql_rej = mysqli_query($conn,$sql_rej);
					while($row_rej=mysqli_fetch_array($sql_rej)) { ?>
							<tr>
								<td><?php echo $i; ?></td>
							    <td><?php echo $row_rej['lead_type']?></td>
								<td><?php echo $row_rej['leadref_id']?></td>
								<td><?php echo $row_rej['name']?></td>
								<td><?php echo $row_rej['hsn_id']?></td>
								<td><?php echo $row_rej['ch_description']?></td>
								<td><?php echo $row_rej['category_name']?></td>
								<td><?php echo $row_rej['quantity']?></td>
								<td><?php echo $row_rej['uom']?></td>
								<td><?php echo $row_rej['description']?></td>
								<td><?php echo $row_rej['posted_date']?></td>
								<td><?php echo $row_rej['expiry_date']?></td>
								
							</tr>
							
					<?php $i++; } ?>
					</tbody>
				</table>
			</div>
            <!-- /.card-body -->
			</div>
		</section>
				
<!--modal section-->
<section  >
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Lead Cost</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<input type="number" onkeydown="return event.keyCode !=69" class="form-control" name="lead_cost" placeholder="Enter Lead Cost">
		<input type="hidden" name="approve_lead_id" id="approve_lead_id" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <!--button type="submit" name="approve_lead" class="btn btn-primary" data-dismiss="modal">Ok</button-->
		<input type="submit" name="approve_lead" class="btn btn-primary" value="Ok">
      </div>
	  </form>
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
			<input type="text"  class="form-control" placeholder="Enter Reason" name="reason" required maxlength="8" size="10">
			<input type="hidden" name="reject_lead_id" id="reject_lead_id" class="form-control">
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			<!--button type="submit" name="reject_lead" class="btn btn-primary">Ok</button-->
			<input type="submit" name="reject_lead" class="btn btn-primary" value="Ok">
		  </div>
	  </form>
    </div>
  </div>
</div>

</section  >
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
function approve_lead(clicked_id)
{
	//alert(clicked_id);
	document.getElementById("approve_lead_id").value=clicked_id;
}
function reject_lead(clicked_id)
{
	//alert(clicked_id);
	document.getElementById("reject_lead_id").value=clicked_id;
}
</script>

</body>

</html>
