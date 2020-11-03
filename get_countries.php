<?php 
	include("config.php");
	$id = $_POST['id'];
	$get_country = "SELECT * FROM `countries` WHERE country_id = $id";
	$res_country = mysqli_query($conn,$get_country);
	$div = "<option value=''>Select Country</option>";
	while($row_country=mysqli_fetch_array($res_country))
	{
		$div .= "<option value=".$row_country['country_id'].">".$row_country['name']."</option>";
	} 
	echo json_encode($div);
?>