<?php
$message='';
if(isset($_POST['verify']))
{
include("config.php");

$email = $_POST['email'];
$otp = $_POST['otp'];
$sql="select * from franchise_users where email='$email' and status='1'";
$result = mysqli_query($conn,$sql);
$row_count = mysqli_num_rows($result);
if($row_count==1)
{
	$rows = mysqli_fetch_array($result);
	$mobile = $rows['mobile'];
	
	$check_otp = "select * from otp where mobile='$mobile' and otp='$otp'";
	$res_otp = mysqli_query($conn,$add_otp);
	$row_count1 = mysqli_num_rows($res_otp);
	if($row_count==1)
	{
		$delete_otp = "delete from otp where mobile='$mobile'";
		$res_delete_otp = mysqli_query($conn,$delete_otp);
		
		header("location: create_password.php");
	}
}
else
{
	$message="Please enter correct otp";
	echo mysqli_error($conn);
}
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index2.html"><b>Country</b>&nbsp; ADMIN</a>
  </div>
  <!-- /.login-logo -->
  <div class="card" id="cbody">
  <div class="container">

    <p class="login-box-msg" id="signtext">Request For Password</p>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required  pattern="^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; }else{} ?>">
      </div>
      <div class="form-group has-feedback" id="otp_div" style="display:none;">
        <input type="text" class="form-control" name="otp" placeholder="OTP"  required maxlength="15" minlength="4" class="form-control">
      </div>
      <div class="row">
        <div class="col-md-8">
          <div class="checkbox icheck">
            <label>
              <?php echo $message; ?>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-3" id="sign">
          <input type="button" class="btn btn-primary btn-block btn-flat" id="request_otp" name="submit" value="Submit" style="display: block;">
		  <input type="submit" class="btn btn-primary btn-block btn-flat" id="verify_btn" name="verify" value="Verify" style="display: none;">
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- /.social-auth-links -->
   </div>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script>
$(document).ready(function(){
  $("#request_otp").click(function(){
	  //alert("Request For OTP");
	  var email = $('#email').val();
	  //alert(email);
	  $.ajax({
			type:"POST",
			url:"generate_otp.php",
			data:{
				email:email
			},
			dataType:'json',
			success:function(response)
			{
				//alert(response);
				if(response==1)
				{
					$("#otp_div").css("display","block");
					$("#verify_btn").css("display","block");
					$("#request_otp").css("display","none");
				}
				else if(response==2)
				{
					alert("You are not country franchise");
				}
				else{
					alert("You are not country franchise");
					$("#otp_div").css("display","none");
					$("#verify_btn").css("display","none");
					$("#request_otp").css("display","block");
				}
			},
			error:function(error)
			{
				alert(error);
			},
		});
  });
});
</script>
</body>
</html>