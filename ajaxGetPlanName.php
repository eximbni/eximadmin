<?php
include ("config.php");

$country_id = $_POST['countryid'];

$sql_chk = "select id,plan_name from subscriptions where country_id ='$country_id'and status='1' ";
$query_chkres = mysqli_query($conn,$sql_chk);
if(mysqli_num_rows($query_chkres)>0){

	echo $dropdownlist = '<option value=""> --Select Plan-- </option>';
	while($row = mysqli_fetch_array($query_chkres)){

		echo $dropdownlist = '<option value="'.$row['id'].'"> '.$row['plan_name'].'</option>';
	}
}else{
	echo $dropdownlist = '<option value=""> --Select Plan-- </option>';
}	

?>