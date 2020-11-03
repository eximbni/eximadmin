<?php 
include("config.php");
include "header.php";

$message ="";
if(isset($_POST['search'])){
	$countryid = $_POST['country_id'];
	$planid = $_POST['plan_id'];

}else{
	$countryid = '';
	$planid = '';
}
?>  


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
						<h1>Subscriptions Income</h1>
					  </div>
					  <div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
						  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						  <li class="breadcrumb-item">Accounts</li>
						  <li class="breadcrumb-item active">Subscriptions Income</li>
						</ol>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->
				</section>
				
				<section class="content">
				<div class="card">
				<h4 ><?php echo $message ?></h4>	
				<div class="card-body">
				<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >			
				  <div class="box-body">
				  <div class="row">
					<div class="col-md-6">
						<div class="form-group">
						  <label>Select Country</label>
						  <select class="form-control" name="country_id" id="country_id" onchange="get_plandetail(this.value)">
							<option value=""> --Select Country-- </option>
							<?php
							$sql_countries ="SELECT country_id, iso,name FROM `countries`";
							$query_countries = mysqli_query($conn, $sql_countries);
							while($res_countries = mysqli_fetch_array($query_countries)){
								if($countryid == $res_countries['country_id']){
									$status ="selected";
								}else{
									$status ="";
								}
							?>
							<option value="<?= $res_countries['country_id']?>" <?= $status;?>>	<?= $res_countries['name']?></option>
							<?php
							}
							?>
							
						  </select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
		                <label for="exampletenant_plotno">Select Plan Name</label>
		                <select name="plan_id" id="plan_id" class="form-control">
		                  <option value=""> --Select Plan-- </option> 
		                </select>

						</div>

					</div>
								
				</div>
					  <!-- /.box-body -->

				  <div class="box-footer text-right mb-3" >
					<button type="submit" name="search" id="search" class="btn btn-outline-primary" onclick="return checkValidation()">Search</button>
				  </div>
		 </form>
		 
		 
	</div>
	</div>
	</section>



			<section class="content">
    
				  <div class="card">
				
           
			   <div class="card-body">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>Sr.No</th>
						  <th>Subscribe Name</th>
						  <th>Mobile No</th>
						  <th>Plan Name</th>
						  <th>Plan Cost</th>
						  <th>Start Date</th>
						  <th>End Date</th>
						  <th>Income Amount</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$total_income = '0.00';
						if($countryid <> ''){
						if($planid ==''){

						$sql_chk = "SELECT * FROM `users` WHERE country_id = '$countryid' and subscription_id <>'' and status='1' ORDER BY `users`.`id` DESC ";

						}else{
							$sql_chk = "SELECT * FROM `users` WHERE country_id = '$countryid' and subscription_id = '$planid' and status='1' ORDER BY `users`.`id` DESC ";
						}
						//echo $sql_chk;
						$query_chkres = mysqli_query($conn,$sql_chk);
						if(mysqli_num_rows($query_chkres)>0){
						$srno = 0;	
							while($row = mysqli_fetch_array($query_chkres)){
								$srno++;
								$name=$row['name'];
								$mobile=$row['mobile'];
								$plan_id=$row['subscription_id'];
								$subscription_start=$row['subscription_start'];
								$subscription_end = $row['subscription_end'];	


								$sql_subscriptions ="SELECT plan_name,plan_cost FROM `subscriptions` WHERE country_id = '$countryid' and id = '$plan_id'";
								$query_subscriptions = mysqli_query($conn, $sql_subscriptions);
								$res_subscriptions = mysqli_fetch_array($query_subscriptions);
								$plan_name = $res_subscriptions['plan_name'];	
								$plan_cost= $res_subscriptions['plan_name'];	
								

								$deduct_amt = ($plan_cost * 55)/100;
								$income_amt = $plan_cost - $deduct_amt;

								$total_income = $total_income + $income_amt;
						?>	
						   	<tr>
							  <td align="center"><?= $srno; ?></td>
							  <td align="left"><?= $name; ?></td>
							  <td align="center"><?= $mobile; ?></td>
							  <td align="center"><?= $plan_name;?></td>
							  <td align="right"><?= number_format($plan_cost,'2');?></td>
							  <td align="center"><?= $subscription_start;?></td>
							  <td align="center"><?= $subscription_end;?></td>
							  <td align="right"><?= number_format($income_amt,'2');?></td>
							  
							</tr>
						<?php
							}
						}
						}else{

						}
						?>
						</tbody>
						<tfoot>
							<tr>
							  <th align="left" colspan="7"> Total Income </th>
							  <td align="right"><strong><?= number_format($total_income,'2');?></strong></td>
							</tr>
						</tfoot>

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

/*
function get_projectdetail(countryid){
  //alert(countryid);
  $.ajax({
    type:"post",
    url : "ajaxGetPlanName.php",
    data : {countryid : countryid },
    success: function(plandata){
      // alert(plandata);
       $('#plan_id').html(plandata);
    }
  }); 

} 
*/

function get_plandetail(countryid){
  //alert(countryid);
  $.ajax({
    type:"post",
    url : "ajaxGetPlanName.php",
    data : {countryid : countryid},
    success: function(plandata){
      // alert(plandata);
       $('#plan_id').html(plandata);
    }
  }); 

} 

function checkValidation(){
	var country_id = $("#country_id").val();
	
	if(country_id ==''){
		alert("Please Select Country");
		$("#country_id").focus();
		return false;
	}

}	

</script>
</body>
</html>
