<?php
$message="";
if(isset($_POST['submit']))
{
include("config.php");
date_default_timezone_set("Asia/Calcutta");
$date = date('Y-m-d');
$leadref_id = $ext."-".$user_country."-".$chapter_id."-". date("Y-m-d h:i:s")."-".rand(111111-999999);
$lead_type=$_POST['lead_type'];
if($lead_type=="Buy"){
	$ext = "b";
}
else{
	$ext="s";
}
$category_id = $_POST['category'];
$chapter_id=$_POST['chapter'];
$hsn_code = $_POST['hsn_code'];
$product = $_POST['product'];
$uom = $_POST['uom'];
$continent = $_POST['continent'];
$country = $_POST['country'];
$quantity = $_POST['quantity'];
$mobile = $_POST['mobile'];
$last_date = $_POST['last_date'];
$lead_cost = $_POST['lead_cost'];
$desc = $_POST['desc'];
$targetDir = "docs/";
$fileName = basename($_FILES["doc"]["name"]);
$targetFilePath = $targetDir . $fileName;
$FilePath = "leaddocs/". $fileName;

$leadref_id = $ext."-".$country."-".$chapter_id."-". date("Y-m-d h:i:s")."-".rand(111111-999999);

$sql_lead = "INSERT INTO `leads`(`leadref_id`, `lead_type`, `posted_by`, `hsn_id`, `chapter_id`, `categories_id`, `product_id`, `uom_id`, `country_id`, `lead_cost`, `quantity`, `description`, `posted_date`, `expiry_date`, `status`) VALUES 
('$leadref_id','$lead_type','5','$hsn_code','$chapter_id','$category_id','$product','$uom','$country','$lead_cost','$quantity','$desc','$date','$last_date','0')";
$res_lead = mysqli_query($conn,$sql_lead);
if($res_lead)
{
	$message= "<div class='alert alert-success'>Lead inserted Successfully.</div>";
}
else
{
	//echo "Lead insert failed";
	$message= "<div class='alert alert-danger'>Failed to insert lead.</div>";
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
			  <div class="col-sm-12">
				<ol class="breadcrumb float-sm-left">
				  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
				  <li class="breadcrumb-item"><a href="">Lead Module</a></li>
				  <li class="breadcrumb-item active">Post Lead</li>
				</ol>
				<?php echo $message; ?>
			  </div>
			</div>
			<div class="row mb-2">
			  <div class="col-sm-9">
				<h4 style="text-align:center;"><b>Post Lead</b></h4>
			  </div>
			  <div class="col-sm-3">
			  	Click here to <a href="bulk_post_lead.php" target="_blank">Bluk Lead Post </a> 
			  </div>
			</div>
		  </div><!-- /.container-fluid -->

		</section>
				
			<?php echo $message; ?>
	<section class="content">
    
	  <div class="card">
							
	<div class="container">
	
	<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		  <div class="box-body">
		    <div class="row">
			<div class="col-md-6">
			<div class="form-group">
			  <label>Lead type</label>
			  <select class="form-control" name="lead_type">
				<option>select</option>
				<option>Sell</option>
				<option>Buy</option>
			  </select>
			</div>
			<div class="form-group">
			  <label>Select Category</label>
			  <select class="form-control" name="category" id="category" required>
				<option>select</option>
			<?php include("config.php");
				$get = "select * from categories";
				$res = mysqli_query($conn,$get);
				if($res){
					while($row=mysqli_fetch_assoc($res)){
				?>
					<option value="<?php echo $row['id'];?>"><?php echo $row['category_name'];?></option>
			<?php }} ?>	
				
			  </select>
			</div>
			<div class="form-group">
				  <label>Select Chapter</label>
				  <select class="form-control" id="chapter" name="chapter" required>
					<!--option>select</option>
					<option>option 1</option>
					<option>option 2</option-->
				  </select>
			</div>
			<div class="form-group">
				  <label>Select HSN Code</label>
				  <select class="form-control" name="hsn_code" id="hsn_code" required>
					<!--option>select</option>
					<option>option 1</option>
					<option>option 2</option-->
				  </select>
			</div>
			<div class="form-group">
				  <label>Select Product</label>
				  <select class="form-control" name="product" id="product" required>
					<!--option>select</option>
					<option>option 1</option>
					<option>option 2</option-->
				  </select>
			</div>
			<div class="form-group">
				  <label>Select UOM</label>
				  <select class="form-control" name="uom" required>
					<option>select</option>
					<?php include("config.php");
						$get = "select * from uoms";
						$res = mysqli_query($conn,$get);
						if($res){
							while($row=mysqli_fetch_assoc($res)){
						?>
							<option value="<?php echo $row['id'];?>"><?php echo $row['uom'];?></option>
					<?php }} ?>
				  </select>
			</div>
			<div class="form-group">
				  <label>Select Continent</label>
				  <select class="form-control" name="continent" id="continent" required>
					<option>select</option>
					<?php include("config.php");
						$get = "select * from continents";
						$res = mysqli_query($conn,$get);
						if($res){
							while($row=mysqli_fetch_assoc($res)){
						?>
							<option value="<?php echo $row['id'];?>"><?php echo $row['continent'];?></option>
					<?php }} ?>
				  </select>
			</div>
			
			</div>
			<div class="col-md-6">
			
			<!--div class="form-group">
				  <label>Posted by</label>
				  <select class="form-control" name="posted_by">
					<option>select</option>
					<option>option 1</option>
					<option>option 2</option>
				  </select>
			</div-->
			<div class="form-group">
				  <label>Select Country</label>
				  <select class="form-control select2" multiple="multiple" name="country[]" data-placeholder="Select Country" style="width: 100%;" required>
					<?php include("config.php");
						$get = "select * from countries";
						$res = mysqli_query($conn,$get);
						if($res){
							while($row=mysqli_fetch_assoc($res)){
						?>
							<option value="<?php echo $row['country_id'];?>"><?php echo $row['name'];?></option>
					<?php }} ?>

				  </select>
			</div>
			<div class="form-group">
			  <label for="">Lead Cost</label>
			  <input type="number" class="form-control" id="" placeholder="Lead Cost" name="lead_cost" required>
			</div>
			<div class="form-group">
			  <label for="">Quantity</label>
			  <input type="number" class="form-control" id="" placeholder="Quantity" name="quantity" required>
			</div>
			<div class="form-group">
			  <label for="">Mobile</label>
			  <input type="number" class="form-control" id="" placeholder="Mobile" name="mobile" required>
			</div>
			<div class="form-group">
			  <label for="">Last Date</label>
			  <input type="date" class="form-control" id="" placeholder="Last Date" name="last_date" required>
			</div>
			
			<div class="form-group">
                    <label for="exampleInputFile">Upload Document</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="doc">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                     
                    </div>
            </div>
			
			<div class="form-group">
			  <label for="exampleInputPassword1">Description</label>
				<textarea class="form-control" placeholder="Type Here" name="desc" required></textarea>
			</div>
			
			
			
		  </div>
		  <!-- /.box-body -->
		</div>
		  <div class="box-footer text-right mb-3" >
			<button type="submit" class="btn btn-outline-primary" name="submit">Submit</button>
		  </div>
	</form>

	
	</div>
</div>
</div>
</div>
<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script-->
<script>
$(document).ready(function() {
    $('.select2').select2()
});
</script>
<script>
$('#category').on('change', function() {
  var a = $('#category').val();
  $.ajax({
		type:"POST",
		url:"get_chapter.php",
		data:{
			id:a
		},
		dataType:'json',
		success:function(response)
		{
			//alert(response);
			$("#chapter").empty;
			$("#chapter").append(response);
		},
		error:function(error)
		{
			alert(error);
		},
	});
});

$('#chapter').on('change', function() {
  var a = $('#chapter').val();
  $.ajax({
		type:"POST",
		url:"get_hsncode.php",
		data:{
			id:a
		},
		dataType:'json',
		success:function(response)
		{
			alert(response);
			$("#hsn_code").empty;
			$("#hsn_code").append(response);
		},
		error:function(error)
		{
			alert(error);
		},
	});
});

$('#chapter').on('change', function() {
  var a = $('#chapter').val();
  $.ajax({
		type:"POST",
		url:"get_hsncode.php",
		data:{
			id:a
		},
		dataType:'json',
		success:function(response)
		{
			//alert(response);
			$("#hsn_code").empty;
			$("#hsn_code").append(response);
		},
		error:function(error)
		{
			alert(error);
		},
	});
});

$('#hsn_code').on('change', function() {
  var a = $('#hsn_code').val();
  $.ajax({
		type:"POST",
		url:"get_hsncode_desc.php",
		data:{
			id:a
		},
		dataType:'json',
		success:function(response)
		{
			//alert(response);
			$("#product").empty;
			$("#product").append(response);
		},
		error:function(error)
		{
			alert(error);
		},
	});
});

$('#continent').on('change', function() {
  var a = $('#continent').val();
  $.ajax({
		type:"POST",
		url:"get_countries.php",
		data:{
			id:a
		},
		dataType:'json',
		success:function(response)
		{
			//alert(response);
			$("#country").empty;
			$("#country").append(response);
		},
		error:function(error)
		{
			alert(error);
		},
	});
});
</script>
 </body>
 </html>