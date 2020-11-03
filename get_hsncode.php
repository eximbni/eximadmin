<?php 
	include("config.php");
	$id = $_POST['id'];
	$get_hsn = "SELECT * FROM `hsncodes` WHERE chapter_id = $id";
	$res_hsn = mysqli_query($conn,$get_hsn);
	$div = "<option value=''>Select HSN Code</option>";
	while($row_hsn=mysqli_fetch_array($res_hsn))
	{
		$div .= "<option value=".$row_hsn['id'].">".$row_hsn['hsncode']."</option>";
	} 
	echo json_encode($div);
?>