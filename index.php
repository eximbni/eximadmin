<?php
session_start();
include('config.php');
$today = date('Y-m-d');
$country_id = $_SESSION['country'];

$country_sql = "SELECT name as country_name from countries where country_id = '$country_id'";
$res_country_name = mysqli_fetch_array(mysqli_query($conn,$country_sql));
$country_name = $res_country_name['country_name'];

$res_active_users = mysqli_fetch_array(mysqli_query($conn, "SELECT count(*) as totalUsers FROM users WHERE status='1' AND email_check='1' and country_id = $country_id"));
$active_users = $res_active_users['totalUsers']; 


//$sql_leads = "SELECT count(*) as totalLeads from leads WHERE country_id = $country_id and expiry_date >= '$today'";
$sql_leads = "SELECT count(*) as totalLeads from leads WHERE country_id = $country_id";
$res_active_leads = mysqli_fetch_array(mysqli_query($conn,$sql_leads));
$total_leads = $res_active_leads['totalLeads'];

$sql_fr = "select count(*) as tot_fr_users from franchise_users where country_id = $country_id and state_id != '' and status = 1";
$res_fr_user = mysqli_fetch_array(mysqli_query($conn,$sql_fr));
$tot_fr_users = $res_fr_user['tot_fr_users'];


$sql_in = "SELECT sum(amount) as tot_amt from frachise_accounts where user_id = '291'";
$res_sql_in = mysqli_fetch_array(mysqli_query($conn,$sql_in));
$total_income = $res_sql_in['tot_amt'];




if(isset($_SESSION['email']) && isset($_SESSION['country']))


{?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EXIMBNI | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo$country_name ?> - Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $active_users; ?></h3>

                <p>Total Users in country</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="/countryadmin/subscribed_users.php" class="small-box-footer">View All Users <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $total_leads; ?></h3>

                <p>Total Lead Posted</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="/countryadmin/lead_request.php" class="small-box-footer">View All Leads <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $tot_fr_users ?></h3>

                <p>Total State Franchise Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="/countryadmin/franchise_list.php" class="small-box-footer">View All State Fracnhsie Users <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $total_income ?></h3>

                <p>Franchise Income</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="/countryadmin/lead_income.php" class="small-box-footer">View Franchise income <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
            <div class="col-md-12">
             <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">User Resgistration Chart</h3>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          
          <!-- right col -->
        </div>
        </div>
        <!-- /.row (main row) -->
        
        <div class="col-12"> 
            <!-- STACKED BAR CHART -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Posted Leads Chart</h3>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <section class="col-lg-12">

            <!-- Map card -->
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  Franchise Users
                </h3> 
              </div>
              <div class="card-body">
                  <input type="hidden" id="country" value="<?php echo $country_id ?>" >
                <div id="map1" style="height: 450px; width: 100%;"></div>
                <input type="hidden" id="sparkline-1" />
                <input type="hidden" id="sparkline-2" />
                <input type="hidden" id="sparkline-3" />
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.card -->

          </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.0-rc.3
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
	<script>
$( document ).ready(function() {
    //var cat_id = $_POST["cat_id"];
    var my_cntr_id = $("#country").val();
    $.ajax({
        
          url: "https://eximbni.com/api/getcountryUserslist.php", 
          type: "get", //send it through get method
          data: { 
            country_id: my_cntr_id, 
          },
         success: function(result){
       
    var mdata = result;
    console.log(result);
    
var json =  JSON.parse(mdata);


// Creating a new map
var map = new google.maps.Map(document.getElementById("map1"), {
  center: new google.maps.LatLng(20.593683, 78.962883),
  zoom: 4,
  mapTypeId: google.maps.MapTypeId.ROADMAP
});

for (var i = 0, length = json.length; i < length; i++) {
    //console.log(json.length);
  var data = json[i],
      latLng = new google.maps.LatLng(data.latitude, data.longitude); 
      console.log(latLng);
      
      

  // Creating a marker and putting it on the map
  var marker = new google.maps.Marker({
    position: latLng,
    map: map,
    //title: data.name
  });
}

var infoWindow = new google.maps.InfoWindow();

// Attaching a click event to the current marker
google.maps.event.addListener(marker, "click", function(e) {
  infoWindow.setContent(data.description);
  //infoWindow.open(map, marker);
});


// Creating a closure to retain the correct data 
//Note how I pass the current data in the loop into the closure (marker, data)
(function(marker, data) {

  // Attaching a click event to the current marker
  google.maps.event.addListener(marker, "click", function(e) {
    infoWindow.setContent(data.description);
    //infoWindow.open(map, marker);
  });

})(marker, data);

}});

});
    </script>
    <script>
    $( document ).ready(function() {
    var my_cntr_id = $("#country").val();
     $.ajax({
        url: "https://eximbni.com/api/getChartCountryUserlist.php", 
         type: "get", //send it through get method
          data: { 
            country_id: my_cntr_id, 
          },
        success: function(result){
        var mdata = result;
		console.log(result);
		var json =  JSON.parse(mdata);
	    console.log("json : ",json['lables']);
		
        // console.log("labels : ",result=>lables );
            // Get context with jQuery - using jQuery's .get() method.
             
            var areaChartData = {
              labels  : json['labels'], //['January', 'February', 'March', 'April', 'May', 'June', 'July'],
              datasets: [
                {
                  label               : 'Sellers',
                  backgroundColor     : 'rgba(245, 105, 84, 1)',
                  borderColor         : 'rgba(245, 105, 84, 1)',
                  pointRadius         : false,
                  pointColor          : 'rgba(245, 105, 84, 1)',
                  pointStrokeColor    : '#c1c7d1',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(245, 105, 84, 1)',
                  data                : json['seller']
                },
                {
                  label               : 'Buyers',
                  backgroundColor     : 'rgba(243, 156, 18, 1)',
                  borderColor         : 'rgba(243, 156, 18, 1)',
                  pointRadius         : false,
                  pointColor          : 'rgba(243, 156, 18, 1)',
                  pointStrokeColor    : '#c1c7d1',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(243, 156, 18, 1)',
                  data                : json['buyer']
                },
                {
                  label               : 'Both',
                  backgroundColor     : 'rgba(0, 166, 90, 1)',
                  borderColor         : 'rgba(0, 166, 90, 1)',
                  pointRadius         : false,
                  pointColor          : 'rgba(0, 166, 90, 1)',
                  pointStrokeColor    : '#c1c7d1',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(0, 166, 90, 1)',
                  data                : json['both']
                },
                {
                  label               : 'Others',
                  backgroundColor     : 'rgba(0, 192, 239, 1)',
                  borderColor         : 'rgba(0, 192, 239, 1)',
                  pointRadius         : false,
                  pointColor          : 'rgba(0, 192, 239, 1)',
                  pointStrokeColor    : '#c1c7d1',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(0, 192, 239, 1)',
                  data                : json['other']
                },
              ]
            }
        
            var areaChartOptions = {
              maintainAspectRatio : false,
              responsive : true,
              legend: {
                display: false
              },
              scales: {
                xAxes: [{
                  gridLines : {
                    display : false,
                  }
                }],
                yAxes: [{
                  gridLines : {
                    display : false,
                  }
                }]
              }
            }
        
            // This will get the first returned node in the jQuery collection.
            
           
            //-------------
            //- User Registration BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = jQuery.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0
        
            var barChartOptions = {
              responsive              : true,
              maintainAspectRatio     : false,
              datasetFill             : false
            }
        
            var barChart = new Chart(barChartCanvas, {
              type: 'bar', 
              data: barChartData,
              options: barChartOptions
            })
        
	    }
        
    });
	
});
    </script>


<script>

$( document ).ready(function() {
    // 
    var my_cntr_id = $("#country").val();
     $.ajax({
        url: "https://eximbni.com/api/getCountryChartLeads.php", 
         type: "get", //send it through get method
          data: { 
            country_id: my_cntr_id, 
          },
        success: function(result){
        var mdata = result;
		console.log(result);
		var json =  JSON.parse(mdata);
	    console.log("json : ",json['lables']);
		
        // console.log("labels : ",result=>lables );
            // Get context with jQuery - using jQuery's .get() method.
             
            var areaChartData = {
              labels  : json['labels'], //['January', 'February', 'March', 'April', 'May', 'June', 'July'],
              datasets: [
                {
                  label               : 'Sell Leads',
                  backgroundColor     : 'rgba(0, 166, 90, 1)',
                  borderColor         : 'rgba(0, 166, 90, 1)',
                  pointRadius         : false,
                  pointColor          : 'rgba(0, 166, 90, 1)',
                  pointStrokeColor    : '#c1c7d1',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(0, 166, 90, 1)',
                  data                : json['sell']
                },
                {
                  label               : 'Buy Leads',
                  backgroundColor     : 'rgba(243, 156, 18, 1)',
                  borderColor         : 'rgba(243, 156, 18, 1)',
                  pointRadius         : false,
                  pointColor          : 'rgba(243, 156, 18, 1)',
                  pointStrokeColor    : '#c1c7d1',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(243, 156, 18, 1)',
                  data                : json['buy']
                },
                 
              ]
            }
        
            var areaChartOptions = {
              maintainAspectRatio : false,
              responsive : true,
              legend: {
                display: false
              },
              scales: {
                xAxes: [{
                  gridLines : {
                    display : false,
                  }
                }],
                yAxes: [{
                  gridLines : {
                    display : false,
                  }
                }]
              }
            }
        
            // This will get the first returned node in the jQuery collection.
            
           
            //-------------
            //- User Registration BAR CHART -
            //-------------
            var barChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
            var barChartData = jQuery.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0
        
            var barChartOptions = {
              responsive              : true,
              maintainAspectRatio     : false,
              datasetFill             : false
            }
        
            var barChart = new Chart(barChartCanvas, {
              type: 'bar', 
              data: barChartData,
              options: barChartOptions
            })
        
        
           
	    }
        
    });
	
});
    </script>
    
    
    
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script> 
    <script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js" ></script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPuQadZpFuDF9KOWFrlthnPRdRJb-QlrI&callback=initMap">
    </script>
</body>
</html>
<?php }
else
{ header("Location: login.php"); }
?>