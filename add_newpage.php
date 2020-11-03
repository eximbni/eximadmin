<?php
if(isset($_POST['submit']))
{
include("config.php");
$title = $_POST['title'];
$editor1 = $_POST['editor1'];

echo $sql_page = "INSERT INTO `pages`(`title`, `description`) VALUES ('$title','$editor1')";
$res_page = mysqli_query($conn,$sql_page);
if($res_page)
{
	echo "Page data inserted.";
}
else
{
	echo "Failed To Insert page data.";
	echo mysqli_error($conn);
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
   <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>

<style>
	.ckeditor{
		
	}

</style>
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
		  
<div class="content-wrapper" id="ckeditor">
    <!-- Content Header (Page header) -->
 <section class="content-header">
				  <div class="container-fluid">
					<div class="row mb-2">
					  <div class="col-sm-6">
						<h1>Add New Page</h1>
					  </div>
					  <div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
						  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						  <li class="breadcrumb-item active">Add New Page</li>
						</ol>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->
</section>
      <section class="p-5">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<div class="form-group">
			  <label for="">Title</label>
			  <input type="text" class="form-control" id="" placeholder="Add Title" name="title">
			</div>
			
			<div class="form-group">
                <textarea name="editor1"></textarea>
                <script>
                        CKEDITOR.replace( 'editor1' );
                </script>
			</div>
			
			<div class="box-footer text-right">
				<!--button type="submit" class="btn btn-outline-primary">Submit</button-->
				<input type="submit" class="btn btn-outline-primary" name="submit" value="submit">
			</div>
		</form>	
	  </section>
			
</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="bower_components/ckeditor/ckeditor.js"></script>

<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
 </body>
 </html>