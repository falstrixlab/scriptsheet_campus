<?php
  foreach ($profile as $key => $value) {
    $fullname = $value['profile_firstname'].' '.$value['profile_lastname'];   
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Alto | Administrator</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/back/bootstrap/css/bootstrap.min.css')?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/back/plugins/datatables/dataTables.bootstrap.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/back/dist/css/AdminLTE.css')?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/back/dist/css/skins/_all-skins.css')?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/back/plugins/iCheck/flat/blue.css')?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url('assets/back/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')?>">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url('assets/back/plugins/morris/morris.css')?>">
  <!-- NPprogres -->
  <link rel="stylesheet" href="<?php echo base_url('assets/back/plugins/Nprogress/nprogress.css')?>">
  <!-- Style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/back/style.css')?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo site_url('administrator')?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>AD</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Alto</b>Admin</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url('assets/back/dist/file/user/'.$value['profile_foto'])?>" class="user-image" alt="User Image" style="width:35px; height:35px;">
              <span class="hidden-xs"><?php echo $fullname; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url('assets/back/dist/file/user/'.$value['profile_foto'])?>" class="user-image" alt="User Image" style="width:90px; height:90px;">
                <p style="color:black !important;">
                  <?php echo $fullname; ?> - <?php if ($akses == 1) {print('Administrator');} else if ($akses == 2) {print('Pemilik Studio Band');} else if ($akses == 3) {print('Pemain Band');} else if ($akses == 4) {print('Penulis Konten');}?>
                  <small>Member since <?php echo $value['profile_created']; ?></small>
                </p>
              </li>                           
              <!-- Menu Footer-->
              <li class="user-footer">
                <!-- <div class="pull-left">
                  <a href="<?php echo site_url('administrator/profile/'.$value['profile_id'])?>" class="btn btn-default btn-flat">Profile</a>
                </div> -->
                <div class="pull-right">
                  <a href="<?php echo site_url('auth/logout')?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>          
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img style="width:200px; height:50px;" src="<?php echo base_url('assets/back/dist/file/user/'.$value['profile_foto'])?>" class="img-circle" alt="User Image">          
        </div>
        <div class="pull-left info" style="color:white;">
          <p><?php echo $fullname; ?></p>
          <a href="#" style="color:white;"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Menu Utama</li>
        <?php $session = session(); ?>
<?php 
  $userAkses = $session->get('is_akses');
  if ($userAkses !== 0) {
?>       
        <li class="treeview">
          <a href="<?php echo site_url('administrator')?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>            
          </a>          
        </li>
<?php
  } 
  if ($userAkses == 1) {
?>
        <li class="treeview">
          <a href="<?php echo site_url('administrator/activation_account/2')?>">
            <i class="fa fa-bell"></i>
            <span>Aktivasi Pemilik</span>
            <span class="pull-right-container">
              <?php if ($aktivasi_pemilik != 0) { ?>
              <span class="label label-primary pull-right"><?php echo $aktivasi_pemilik;?></span>
              <?php } ?>
            </span>
          </a>         
        </li>
       <!--  <li class="treeview">
          <a href="<?php echo site_url('administrator/activation_account/3')?>">
            <i class="fa fa-tripadvisor"></i>
            <span>Aktivasi Penyewa</span>
            <span class="pull-right-container">
              <?php if ($aktivasi_penyewa != 0) { ?>
              <span class="label label-primary pull-right"><?php echo $aktivasi_penyewa;?></span>
              <?php } ?>
            </span>
          </a>         
        </li> -->
        <li class="treeview">
          <a href="<?php echo site_url('administrator/activation_account/4')?>">
            <i class="fa fa-map-o"></i>
            <span>Aktivasi Author</span>
            <span class="pull-right-container">
              <?php if ($aktivasi_author != 0) { ?>
              <span class="label label-primary pull-right"><?php echo $aktivasi_author;?></span>
              <?php } ?>
            </span>
          </a>         
        </li>
        <li class="treeview">
          <a href="<?php echo site_url('administrator/activation_news')?>">
            <i class="fa fa-newspaper-o"></i>
            <span>Aktivasi Berita</span>
            <span class="pull-right-container">
              <?php if ($aktivasi_berita != 0) { ?>
              <span class="label label-primary pull-right"><?php echo $aktivasi_berita;?></span>
              <?php } ?>
            </span>
          </a>         
        </li>
        <li class="treeview">
          <a href="<?php echo site_url('administrator/activation_event')?>">
            <i class="fa fa-cubes"></i>
            <span>Aktivasi Event</span>
            <span class="pull-right-container">
              <?php if ($aktivasi_event != 0) { ?>
              <span class="label label-primary pull-right"><?php echo $aktivasi_event;?></span>
              <?php } ?>
            </span>
          </a>         
        </li>
<?php
  } 
  if ($userAkses == 1 || $userAkses == 3) {
?>
        <li class="treeview">         
          <a href="#">
             <i class="fa fa-files-o"></i>
            <span>Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url('administrator/report_profile')?>"><i class="fa fa-circle-o"></i> Profile</a></li>
            <li><a href="<?php echo site_url('administrator/report_studio')?>"><i class="fa fa-circle-o"></i> Studio</a></li>
            <li><a href="<?php echo site_url('administrator/report_berita')?>"><i class="fa fa-circle-o"></i> Berita</a></li>
            <li><a href="<?php echo site_url('administrator/report_event')?>"><i class="fa fa-circle-o"></i> Event</a></li>                        
          </ul>        
        </li>
<?php
 } 
 if ($userAkses == 1 || $userAkses == 4 || $userAkses == 2) {
?>
        <li>
          <a href="<?php echo site_url('administrator/event')?>">
            <i class="fa fa-th"></i> <span>Event</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">Hot</small>
            </span>
          </a>
        </li>
<?php } if ($userAkses == 1 || $userAkses == 4) { ?>
        <li>
          <a href="<?php echo site_url('administrator/news')?>">
            <i class="fa fa-th"></i> <span>Berita</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-blue">Update</small>
            </span>
          </a>
        </li>
<?php
} 
if ($userAkses == 1 || $userAkses == 3) {
?>
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Charts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url('administrator/chart/rating')?>"><i class="fa fa-circle-o"></i> Studio Rating</a></li>            
            <li><a href="<?php echo site_url('administrator/chart/area')?>"><i class="fa fa-circle-o"></i> Studio Area</a></li>            
          </ul>
        </li> -->
<?php
 }
 if ($userAkses == 2) { 
?>
     <li class="treeview">
          <a href="#">
            <i class="fa fa-music"></i>
            <span>User Booking</span>
            <span class="pull-right-container">
              <i class="fa fa-laptop"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url('administrator/booking')?>"><i class="fa fa-circle-o"></i>Waiting List</a></li>
            <li><a href="<?php echo site_url('administrator/booking_history')?>"><i class="fa fa-circle-o"></i> History</a></li>            
          </ul>
        </li>    
    <li class="treeview">
          <a href="#">
            <i class="fa fa-music"></i>
            <span>Studio Band</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url('administrator/studio')?>"><i class="fa fa-circle-o"></i> Profil Studio</a></li>
            <li><a href="<?php echo site_url('administrator/jadwal')?>"><i class="fa fa-circle-o"></i> Pengaturan Jadwal</a></li>            
          </ul>
        </li>      
<?php 
}
if ($userAkses == 1) {  
?>
        <li class="treeview">
          <a href="<?php echo site_url('administrator/gallery')?>">
            <i class="fa fa-image"></i> <span>Galeri</span>
          </a>          
        </li>
<?php
  } 
  if ($userAkses == 1) { 
?>
        <li class="treeview">
          <a href="<?php echo site_url('administrator/about')?>">
            <i class="fa fa-edit"></i> <span>Tentang</span>            
          </a>          
        </li>       
       <!--  <li>
          <a href="<?php echo site_url('administrator/advertise')?>">
            <i class="fa fa-share-alt-square "></i> <span>Iklan</span>            
          </a>
        </li> -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-wrench"></i>
            <span>Konfigurasi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url('administrator/user')?>"><i class="fa fa-circle-o"></i> User</a></li>
            <li><a href="<?php echo site_url('administrator/category')?>"><i class="fa fa-circle-o"></i> Kategori Musik</a></li>
            <li><a href="<?php echo site_url('administrator/advertise')?>"><i class="fa fa-circle-o"></i> Iklan Studio</a></li>            
          </ul>
        </li>
<?php
  } 
  if ($userAkses == 1 || $userAkses == 5) {
?>    
         <li>
          <a href="<?php echo site_url('administrator/pengaduan')?>">
            <i class="fa fa-commenting "></i> <span>Pengaduan</span>            
          </a>
        </li>
<?php
  }
?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">      
    <!-- Main content -->
    <section class="content-header">
          <h1>
            <?php print($navigation);?>          
          </h1>
            <ol class="breadcrumb">
              <li class="active"><a href="#"><i class="fa fa-refresh"></i> Refresh</a></li>
            </ol>
        </section>
    <section class="content">
      
    <?= view($contents) ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.8
    </div>
    <strong>Copyright &copy; <?php echo date('Y')?> <a href="http://naufaltrix.github.io">Naufaltrix</a>.</strong> All rights
    reserved.
  </footer>  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('assets/back/plugins/jQuery/jquery-2.2.3.min.js')?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/back/bootstrap/js/bootstrap.min.js')?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url('assets/back/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/back/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('assets/back/plugins/slimScroll/jquery.slimscroll.min.js')?>"></script>
<!-- Chart -->
<script src="<?php echo base_url('assets/back/plugins/chartjs/Chart.min.js')?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/back/plugins/fastclick/fastclick.js')?>"></script>
<!-- NProgress -->
<script src="<?php echo base_url('assets/back/plugins/Nprogress/nprogress.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/back/dist/js/app.min.js')?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/back/dist/js/demo.js')?>"></script>
<!-- CK Editor -->
<script src="<?php echo base_url('assets/back/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')?>"></script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
        $("#dataA").DataTable();
        $("#dataB").DataTable();        
        $("#dataC").DataTable();
        $("#dataD").DataTable();
      });
    </script>
<script>
      $(function () {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */
         //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        var PieData = [
          {
            value: 700,
            color: "#f56954",
            highlight: "#f56954",
            label: "Path Test"
          },
          {
            value: 500,
            color: "#00a65a",
            highlight: "#00a65a",
            label: "Web Test"
          },
          {
            value: 400,
            color: "#f39c12",
            highlight: "#f39c12",
            label: "Video Test"
          },
          {
            value: 600,
            color: "#00c0ef",
            highlight: "#00c0ef",
            label: "Speed Test"
          },
          {
            value: 300,
            color: "#3c8dbc",
            highlight: "#3c8dbc",
            label: "Facebook Test"
          },
          {
            value: 100,
            color: "#d2d6de",
            highlight: "#d2d6de",
            label: "One Click"
          }
        ];
        var pieOptions = {
          //Boolean - Whether we should show a stroke on each segment
          segmentShowStroke: true,
          //String - The colour of each segment stroke
          segmentStrokeColor: "#fff",
          //Number - The width of each segment stroke
          segmentStrokeWidth: 2,
          //Number - The percentage of the chart that we cut out of the middle
          percentageInnerCutout: 50, // This is 0 for Pie charts
          //Number - Amount of animation steps
          animationSteps: 100,
          //String - Animation easing effect
          animationEasing: "easeOutBounce",
          //Boolean - Whether we animate the rotation of the Doughnut
          animateRotate: true,
          //Boolean - Whether we animate scaling the Doughnut from the centre
          animateScale: false,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true,
          // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions);

        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var areaChart = new Chart(areaChartCanvas);

        var areaChartData = {
          labels: ["January", "February", "March", "April", "May", "June", "July"],
          datasets: [
            {
              label: "Electronics",
              fillColor: "rgba(210, 214, 222, 1)",
              strokeColor: "rgba(210, 214, 222, 1)",
              pointColor: "rgba(210, 214, 222, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: [65, 59, 80, 81, 56, 55, 40]
            },
            {
              label: "Digital Goods",
              fillColor: "#FFFF66",
              strokeColor: "#FFFF66",
              pointColor: "#FFFF66",
              pointStrokeColor: "#FFFF66",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "#FFFF66",
              data: [28, 48, 40, 19, 86, 27, 90]
            }
          ]
        };

        var areaChartOptions = {
          //Boolean - If we should show the scale at all
          showScale: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: false,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - Whether the line is curved between points
          bezierCurve: true,
          //Number - Tension of the bezier curve between points
          bezierCurveTension: 0.3,
          //Boolean - Whether to show a dot for each point
          pointDot: false,
          //Number - Radius of each point dot in pixels
          pointDotRadius: 4,
          //Number - Pixel width of point dot stroke
          pointDotStrokeWidth: 1,
          //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
          pointHitDetectionRadius: 20,
          //Boolean - Whether to show a stroke for datasets
          datasetStroke: true,
          //Number - Pixel width of dataset stroke
          datasetStrokeWidth: 2,
          //Boolean - Whether to fill the dataset with a color
          datasetFill: true,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true
        };

        //Create the line chart
        areaChart.Line(areaChartData, areaChartOptions);

        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var barChartData = areaChartData;
        barChartData.datasets[1].fillColor = "#00a65a";
        barChartData.datasets[1].strokeColor = "#00a65a";
        barChartData.datasets[1].pointColor = "#00a65a";
        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 2,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: true
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
      });
    </script> 
</body>
</html>
