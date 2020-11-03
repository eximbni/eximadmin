<?php 
session_start();
$country_id = $_SESSION['country'];
include("config.php");
include "header.php";


$message ="";
if(isset($_POST['search'])){
	$country_id = $country_id;
	$lead_type = $_POST['lead_type'];

}else{
	$country_id = '';
	$lead_type = '';
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
						<h1>Lead Income</h1>
					  </div>
					  <div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
						  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						  <li class="breadcrumb-item">Accounts</li>
						  <li class="breadcrumb-item active">Lead Income</li>
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
						<div class="col-md-3" style="display:none">
							<div class="form-group">
							  <label>Select Country</label>
					            <input type="hidden" value="<?php echo $country_id ?>" name="country_id" id ="country_id">
							  <select class="form-control" name="country_id" id="country_id" onchange="get_plandetail(this.value)">
								<option value="">Select Country</option>
								<?php
								echo $sql_countries ="SELECT country_id,name FROM `countries`";
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
						<div class="col-md-10">
							<div class="form-group">
				                <label for="exampletenant_plotno">Select Lead Type</label>
				                <select name="lead_type" id="lead_type" class="form-control">
				                  <option value="">Select Type</option>.
				                  <option value="Buy"> Buy </option>
				                  <option value="Sell"> Sell </option> 
				                </select>
							</div>

						</div>
						<div class="col-md-2">
						    <label>&nbsp;</label>
						    <button type="submit" name="search" id="search" class="btn btn-success btn-block" onclick="return checkValidation()">Search</button>
						</div>
								
				</div>
					  <!-- /.box-body -->

				 
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
						  <th>User Name</th>
						  <th>Contact No</th>
						  <th>Lead Type</th>
						  <th>Lead Cost</th>
						  <th>Posted Date</th>
						  <th>Expiry Date</th>
						  <th>Income Amount</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$total_income = '0.00';
						$srno = 0;	
						if($country_id <> ''){

						$sql_purchaseLead ='SELECT * FROM `purchased_leads` ORDER BY `id` DESC';
						$query_purchaseLead = mysqli_query($conn, $sql_purchaseLead);
						$count_purchaseLead = mysqli_num_rows($query_purchaseLead);
	 					if($count_purchaseLead > 0){
	 					while($row_purchaseLead = mysqli_fetch_array($query_purchaseLead)) {
	 						
	 						$srno ++;	
	 						$user_id = $row_purchaseLead['user_id'];
	 						$lead_id = $row_purchaseLead['lead_id'];
	 						$reference_id = $row_purchaseLead['reference_id'];
	 						
	 						$sql_chk = "SELECT * FROM users WHERE country_id = '$country_id' and id = '$user_id' and status <>'99'"; 
	 						$query_chkres = mysqli_query($conn,$sql_chk);
	 						$count_chkres = mysqli_num_rows($query_chkres);
	 						if($count_chkres > 0){
							$row = mysqli_fetch_array($query_chkres);
	 						$name=$row['name'];
							$mobile=$row['mobile'];

							if($lead_type ==''){
								$sql_leads = "SELECT * FROM leads WHERE country_id = '$country_id' and id = '$lead_id' and status <>'99'";
							}else{
								$sql_leads = "SELECT * FROM leads WHERE country_id = '$country_id' and lead_type = '$lead_type' and id = '$lead_id' and status <>'99'";
							}
							
	 						$query_leadsres = mysqli_query($conn,$sql_leads);
	 						$count_leadsres = mysqli_num_rows($query_leadsres);
	 						if($count_leadsres > 0){

	 						$row_leadsres = mysqli_fetch_array($query_leadsres);
	 						$leads_type=$row_leadsres['lead_type'];
							$lead_cost=$row_leadsres['lead_cost'];	
							$posted_date=$row_leadsres['posted_date'];
							$expiry_date = $row_leadsres['expiry_date'];


							$deduct_amt = ($lead_cost * 55)/100;
							$income_amt = $lead_cost - $deduct_amt;

							$total_income = $total_income + $income_amt;														
								

						?>	
						   	<tr>
							  <td align="center"><?= $srno; ?></td>
							  <td align="left"><?= $name; ?></td>
							  <td align="center"><?= $mobile; ?></td>
							  <td align="center"><?= $leads_type;?></td>
							  <td align="right"><?= number_format($lead_cost,'2');?></td>
							  <td align="center"><?= $posted_date;?></td>
							  <td align="center"><?= $expiry_date;?></td>
							  <td align="right"><?= number_format($income_amt,'2');?></td>
							  
							</tr>
						<?php
								} //leads count > 0

								} //users count > 0

			 					}
								}
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
	var lead_type = $("#lead_type").val();
	

if(lead_type ==''){
		alert("Please Select Lead Type");
		$("#lead_type").focus();
		return false;
	}
}	

</script>
</body>
</html>

