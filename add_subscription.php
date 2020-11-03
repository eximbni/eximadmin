<?php
include("config.php");
$message='';

if(isset($_POST['submit'])){
	$country_id=$_POST['country_id'];
	$plan_name=$_POST['plan_name'];
	$plan_duration=$_POST['plan_duration'];
	$chapters = $_POST['chapters'];
	$banners = $_POST['banners'];
	$inbox = $_POST['inbox'];
	$notifications = $_POST['notifications'];
	$credits = $_POST['credits'];
	$webinar = $_POST['webinar'];
	$leadpost = $_POST['leadpost'];
	$chat = $_POST['chat'];
	$plan_cost = $_POST['plan_cost'];
	$plan_description = $_POST['plan_description'];	

	$created_date = date("Y-m-d");

	$chk = "select * from subscriptions where country_id='$country_id' and plan_name='$plan_name' ";
	$chkres = mysqli_query($conn,$chk);
	if(mysqli_num_rows($chkres)>0){
		$message="<span style='color:red'>Subscriptions Already exists in this continent</span>";
	}
	else{
		$sql_insert_subscriptions = "insert into subscriptions(country_id,plan_name,plan_duration,chapters,banners,inbox,notifications,credits,webinar,leadpost,chat,plan_description,status,plan_cost) values('$country_id','$plan_name','$plan_duration','$chapters','$banners','$inbox','$notifications','$credits','$webinar','$leadpost','$chat','$plan_description','1','$plan_cost')";
		$res_subscriptions = mysqli_query($conn,$sql_insert_subscriptions);
		if($res_subscriptions){
			$message = "<span style='color:green'>Subscriptions Added Successfully</span>";
		}
		else{
			$message = "<span style='color:red'>Error adding Subscriptions</span>";
		}

	}
}

?>
<!DOCTYPE html>
<html>
<head>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
			
			<?php include("header.php")?>
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
						<h4 class="m-0 text-dark">Add Subscription</h4>
					  </div>
					  <div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
						  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						  <li class="breadcrumb-item">Accounts</li>
						  <li class="breadcrumb-item active">Add Subscription</li>
						</ol>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->
				</section>
				<section class="content">
				<div class="card">
				<h4 ><?php echo $message ?></h4>	
				<div class="container">
				<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >			
				  <div class="box-body">
				  <div class="row">
					<div class="col-md-6">
						<div class="form-group">
						  <label>Select Country</label>
						  <select class="form-control" name="country_id" id="country_id">
							<option value="">Select</option>
							<?php
							$sql_countries ="SELECT country_id, iso,name FROM `countries`";
							$query_countries = mysqli_query($conn, $sql_countries);
							while($res_countries = mysqli_fetch_array($query_countries)){
							?>
							<option value="<?= $res_countries['country_id']?>">	<?= $res_countries['name']?></option>
							<?php
							}
							?>
							
						  </select>
						</div>
						<div class="form-group">
						  <label for="">Plan Name</label>
						  <input type="text" class="form-control" id="plan_name" name="plan_name" placeholder="Plan name">
						</div>
						<div class="form-group">
						  <label for="">Plan Cost</label>
						  <input type="number" class="form-control" id="plan_cost" name="plan_cost" placeholder="Plan Cost">
						</div>
						<div class="form-group">
						  <label for="">Plan Duration in Days</label>
						  <input type="text" class="form-control" id="plan_duration" name="plan_duration" placeholder="Plan duration" value="" maxlength="3">
						</div>
						<div class="form-group">
						  <label for="">No of Chapters </label>
						  <input type="number" class="form-control" id="chapters" name="chapters" placeholder="No of Chapters">
						</div>
						<div class="form-group">
						  <label>Banners</label>
						  <input type="number" class="form-control" id="banners" name="banners" placeholder="No of Banners">
						</div>
						<div class="form-group">
						  <label>Inbox</label>
						  <select class="form-control" id="inbox" name="inbox" >
							<option value="">Select</option>
							<option value="1">YSE</option>
							<option value="0">NO</option>
						  </select>
						</div>
						</div>
						<div class="col-md-6">
						<div class="form-group">
						  <label>Notification</label>
						  <select class="form-control" id="notifications" name="notifications" >
							<option value="">Select</option>
							<option value="1">YSE</option>
							<option value="0">NO</option>
						  </select>
						</div>
						<div class="form-group">
						  <label>Credits</label>
						   <input type="number" class="form-control" id="credits" name="credits" placeholder="No of Credits">
						</div>
						<div class="form-group">
						  <label>Webinar</label>
						  <select class="form-control" id="webinar" name="webinar" >
							<option value="">Select</option>
							<option value="1">YSE</option>
							<option value="0">NO</option>
						  </select>
						</div>
						<div class="form-group">
						  <label>Lead Post</label>
						   <input type="number" class="form-control" id="leadpost" name="leadpost" placeholder="No of Lead Post">
						</div>
						<div class="form-group">
						  <label>Chat</label>
						  <select class="form-control" id="chat" name="chat" >
							<option value="">Select</option>
							<option value="1">YSE</option>
							<option value="0">NO</option>
						  </select>
						</div>						
					<div class="form-group">
						<label>Description</label>
						<textarea class="form-control" rows="3" id="plan_description" name="plan_description" placeholder="Description ..."></textarea>
					 </div>
						
					</div>
								
					  </div>
					  <!-- /.box-body -->

				  <div class="box-footer text-right mb-3" >
					<button type="submit" name="submit" id="submit" class="btn btn-outline-primary" onclick="return checkValidation()">Submit</button>
				  </div>
		 </form>
		 
		 
	</div>
	</div>
	</section>
</div>
</div>
<script type="text/javascript">
function checkValidation(){
	var country_id = $("#country_id").val();
	var plan_name = $("#plan_name").val();
	var plan_cost = $("#plan_cost").val();
	var plan_duration = $("#plan_duration").val();
	var chapters = $("#chapters").val();
	var banners = $("#banners").val();
	var inbox = $("#inbox").val();
	var notifications = $("#notifications").val();
	var credits = $("#credits").val();
	var webinar = $("#webinar").val();
	var leadpost = $("#leadpost").val();
	var chat = $("#chat").val();
	var plan_description = $("#plan_description").val();

	if(country_id ==''){
		alert("Please select Country");
		$("#country_id").focus();
		return false;
	}

	if(plan_name ==''){
		alert("Please Enter Plan Name");
		$("#plan_name").focus();
		return false;
	}
	if(plan_cost ==''){
		alert("Please Enter Plan Cost");
		$("#plan_cost").focus();
		return false;
	}
	
	if(inbox ==''){
		alert("Please Select Inbox");
		$("#inbox").focus();
		return false;
	}	

	if(notifications ==''){
		alert("Please Select Notifications");
		$("#notifications").focus();
		return false;
	}

	if(webinar ==''){
		alert("Please Select Webinar");
		$("#webinar").focus();
		return false;
	}	

	if(chat ==''){
		alert("Please Select Chat");
		$("#chat").focus();
		return false;
	} 
	
}	

</script>
 </body>
 </html>