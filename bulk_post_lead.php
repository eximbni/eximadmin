<?php
$message="";
//$conn = mysqli_connect("localhost", "root", "", "test");
include("config.php");
if(isset($_POST['import'])) 
{

date_default_timezone_set("Asia/Calcutta");
$date = date('Y-m-d');
    $fileName = $_FILES["file"]["name"];
    $fileName1 = str_replace(' ', '_', $fileName);
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        //Insert File Name
        
        $date_time = date('Y-m-d h:i:s');
        echo $file = $fileName1.$date_time;
        echo $add_file = "insert into bulk_lead_file(`user_id`, `country_id`, `file_name`, `created`, `status`) values ('admin','99','$file','$date_time','1')";
        $res_file = mysqli_query($conn,$add_file);
        if($res_file)
        {
            echo "file uploaded";
        }
        //Insert File Name
        
        
        
fgetcsv($file, 10000, ","); 

        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {


$lead_type=$column[0];
if($lead_type=="Buy"){
	$ext = "B";
	}
else{
	$ext="S";
}

$country = '';
$country_id = $column[1];
$category_id = $column[2];
$chapter_id= $column[3];
$hsn_code = $column[4];
$uom = $column[5];
$quantity = $column[6];
$lead_cost = $column[7];
$desc = $column[9];
$last_date = date('Y-m-d', strtotime($column[8]));   

	    $getrefid = "select * from leads where lead_type='$lead_type' and country_id='$country_id' and chapter_id='$chapter_id' order by id desc limit 1";
	    $resref = mysqli_query($conn,$getrefid);
	    if(mysqli_num_rows($resref)>0){
	        while($row=mysqli_fetch_assoc($resref)){
	            $sno = $row["sno"];
	            }
	            $nsno = $sno+1;
	            
	    }
	    else{
	        $nsno = 1;
	    }


$getcountry_code = "select iso_code_3 from countries where country_id='$country_id'";
$rescountry_code = mysqli_query($conn,$getcountry_code);
if($rescountry_code){
	while($row_country=mysqli_fetch_assoc($rescountry_code)){
		$country_code = $row_country["iso_code_3"];
	}
}

 $leadref_id = $ext."-".$country_code."-".$chapter_id."-".mt_rand(11111111,99999999);
//echo $leadref_id = $ext.$value.$chapter_id;
$sql_lead = "INSERT INTO `leads`(`leadref_id`, `lead_type`, `lead_cost`, `posted_by`, `hsn_id`, `chapter_id`, `categories_id`, `uom_id`, `country_id`, `quantity`, `description`, `posted_date`, `expiry_date`, `bulk_lead`, `status`, `sno`) VALUES 
('$leadref_id','$lead_type','$lead_cost','5','$hsn_code','$chapter_id','$category_id','$uom','$country_id','$quantity','$desc','$date','$last_date','1','1','$nsno')";
$res_lead = mysqli_query($conn,$sql_lead);

if($res_lead)
{
/*	$getlead_id = "select id from leads where posted_by=5 order by id desc limit 1;";
	$reslead = mysqli_query($conn,$getlead_id);
	while($row= mysqli_fetch_assoc($reslead)){
	$lead_id = $row["id"];
	}
	foreach($country As $value)
	{
	$inscountry = "insert into lead_display_countries (lead_id, country_id) values('$lead_id','$value')";
	$rescountry = mysqli_query($conn,$inscountry);
	if($rescountry){
		$message= "<div class='alert alert-success'>Lead inserted Successfully.</div>";
	}*/
	$type = "success";
	$message= "<div class='alert alert-success'>Lead inserted Successfully.</div>";
}else{
	$type = "error";
	$message= "<div class='alert alert-danger'>Problem in Importing CSV Lead Post.</div>";
}


        }
       
    }
    
}
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
	<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<?php include("header.php")?>
		  <!-- /.navbar -->

		  <!-- Main Sidebar Container -->
	<aside class="main-sidebar sidebar-dark-primary elevation-4"> <?php include("sidemenu.php");?>  </aside>
	<div class="content-wrapper">

	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-12" id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
				<ol class="breadcrumb float-sm-left">
				  	<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				  	<li class="breadcrumb-item"><a href="">Lead Module</a></li>
				  	<li class="breadcrumb-item active">Bulk Lead Post</li>
					</ol>
					<?php echo $message; ?>
			  	</div>
			</div>
			<div class="row mb-2">
			  <div class="col-sm-12">
				<h4 style="text-align:center;"><b>Bulk Lead Post </b></h4>
			  </div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
				
		
	<section class="content">
    
		<div class="card p-3">
								
			<div class="container">

				<form class="form-horizontal" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">

				  	<div class="box-body">

					    <div class="row">

							<div class="col-md-6">
								
								<div class="form-group">
								  	<label>Select Category</label>
								  	<select class="form-control" name="category" id="category" >
										<option>select</option>
										<?php 
											$get = "select * from categories";
											$res = mysqli_query($conn,$get);
											if($res){
												while($row=mysqli_fetch_assoc($res)){
											?>
												<option value="<?php echo $row['id'];?>"><?php echo $row['id']." || ".$row['category_name'];?></option>
										<?php }} ?>					
								  	</select>
								</div>

								<div class="form-group">
									  <label>Select HSN Code</label>
									  <select class="form-control" name="hsn_code" id="hsn_code" >
										<!--option>select</option>
										<option>option 1</option>
										<option>option 2</option-->
									  </select>
								</div>

								<div class="form-group">
									  <label>Lead Source Country</label>
									  <select class="form-control" name="lead_country" >
										<option>select</option>
										<?php include("config.php");
											$get = "select * from countries";
											$res = mysqli_query($conn,$get);
											if($res){
												while($row=mysqli_fetch_assoc($res)){
											?>
												<option value="<?php echo $row['country_id'];?>"><?php echo $row['country_id']." || ".$row['name'];?></option>
										<?php }} ?>
									  </select>
								</div>


							</div>

							<div class="col-md-6">

								<div class="form-group">
									  <label>Select Chapter</label>
									  <select class="form-control" id="chapter" name="chapter" > </select>
								</div>

								<div class="form-group">
									  <label>Select UOM</label>
									  <select class="form-control" name="uom" >
										<option>select</option>
										<?php include("config.php");
											$get = "select * from uoms";
											$res = mysqli_query($conn,$get);
											if($res){
												while($row=mysqli_fetch_assoc($res)){
											?>
												<option value="<?php echo $row['id'];?>"><?php echo $row['id']." || ".$row['uom'];?></option>
										<?php }} ?>
									  </select>
								</div>
								

								<div class="form-group">
									<label>Choose CSV File <span class="text-danger">*</span></label> 
									Click here to download <label><a href="postLeadCSV.csv" target="_blank"> CSV Format</a></label>
									
									<div >
										<input type="file" name="file" id="file" accept=".csv" required>
									 	<button type="submit" id="submit" name="import" class="btn btn-outline-success pull-right" >Import</button>
									</div>
								</div>

						  	</div>

					  <!-- /.box-body -->
						</div>

					</div>	

				</form>

			</div>

		</div>

	</section>

	</div>

</div>

<script type="text/javascript">
$(document).ready(function() {
    $("#frmCSVImport").on("submit", function () {

	    $("#response").attr("class", "");
        $("#response").html("");
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#file").val().toLowerCase())) {
        	    $("#response").addClass("error");
        	    $("#response").addClass("display-block");
            $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
            return false;
        }
        return true;
    });
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