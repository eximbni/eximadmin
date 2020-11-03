<?php 
	include("config.php");
	$id = $_POST['id'];
	$get_hsn = "SELECT * FROM `hsncodes` WHERE id = $id";
	$res_hsn = mysqli_query($conn,$get_hsn);
	$div = "<option value=''>Select Product</option>";
	while($row_hsn=mysqli_fetch_array($res_hsn))
	{
		$div .= "<option value=".$row_hsn['id'].">".$row_hsn['hsndescription']."</option>";
	} 
	echo json_encode($div);
?>