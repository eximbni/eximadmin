<?php
	include("config.php");
	$lead_type=$_POST['type'];
	$country_id=$_POST['country'];
	$sql_leads = "select * from leads where lead_type='$lead_type' and country_id='$country_id'";
	$res_leads = mysqli_query($conn,$sql_leads);
	$row_count = mysqli_num_rows($res_leads);
	$id=1;
	if($row_count>0)
	{
	while($row_leads=mysqli_fetch_array($res_leads))
	{
		$hsn_id = $row_leads['hsn_id'];
		$sql_hsn = "select * from hsncodes where id='$hsn_id'";
		$res_hsn = mysqli_query($conn,$sql_hsn);
		$rows_hsn = mysqli_fetch_array($res_hsn);
		$hsncode = $rows_hsn['hsncode'];
		
		$chapter_id = $row_leads['chapter_id'];
		$sql_chapter = "select * from chapters where id='$chapter_id'";
		$res_chapter = mysqli_query($conn,$sql_chapter);
		$rows_chapter = mysqli_fetch_array($res_chapter);
		$chapter_name = $rows_chapter['chapter_name'];
		
		$categories_id = $row_leads['categories_id'];
		$sql_categories = "select * from categories where id='$categories_id'";
		$res_categories = mysqli_query($conn,$sql_categories);
		$rows_categories = mysqli_fetch_array($res_categories);
		$category_name = $rows_categories['category_name'];
		
		$product_id = $row_leads['product_id'];
		$sql_products = "select * from products where id='$product_id'";
		$res_products = mysqli_query($conn,$sql_products);
		$rows_products = mysqli_fetch_array($res_products);
		$product_name = $rows_products['product'];
		
		$uom_id = $row_leads['uom_id'];
		$sql_uoms = "select * from uoms where id='$uom_id'";
		$res_uoms = mysqli_query($conn,$sql_uoms);
		$rows_uoms = mysqli_fetch_array($res_uoms);
		$uom = $rows_uoms['uom'];
		
		$quantity = $row_leads['quantity'];
		$description = trim($row_leads['description']);
		$posted_date = $row_leads['posted_date'];
		$expiry_date = $row_leads['expiry_date'];
		$status = $row_leads['status'];
		if($status==0)
		{
			$status="Pending";
		}
		elseif($status==1)
		{
			$status="Approved";
		}
		elseif($status==99)
		{
			$status="Rejected";
		}
		else
		{
			$status="Pending";
		}
		
		echo $data = "<tr><td>$id</td><td>$hsncode</td><td>$chapter_name</td><td>$category_name</td><td>$product_name</td><td>$uom</td><td>$quantity</td><td>$description</td><td>$posted_date</td><td>$expiry_date</td><td>$status</td></tr>";
		$id++;
	}
	}
	else
	{
		echo "<tr><td colspan='11' align='center'>No Leads For This Country</td></tr>";
	}
	//echo json_encode($sql_leads);
?>