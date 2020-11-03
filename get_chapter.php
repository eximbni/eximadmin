<?php 
	include("config.php");
	$id = $_POST['id'];
	//$id = $_GET['id'];
	$get_chapter = "SELECT * FROM `chapters` WHERE category_id = $id";
	$res_chapter = mysqli_query($conn,$get_chapter);
	$div = "<option value=''>Select Chapter</option>";
	while($row_chapter=mysqli_fetch_array($res_chapter))
	{
		$div .= "<option value=".$row_chapter['id'].">".$row_chapter['chapter_name']."</option>";
	} 
	echo json_encode($div);
?>