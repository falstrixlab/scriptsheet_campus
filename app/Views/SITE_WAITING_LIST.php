<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ALTO APP | Konfirmasi Akun</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/back/bootstrap/css/bootstrap.min.css')?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/back/dist/css/AdminLTE.css')?>">  
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/back/plugins/iCheck/square/blue.css')?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo site_url('auth');?>"><b>Alto</b> Konfirmasi Akun</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" style="width:800px; margin-left:-200px;">
          <div class="nav-tabs-custom">
          <a href="<?php echo site_url('auth');?>" class="btn btn-primary">Kembali ke Login</a><br><br>
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Menunggu Konfirmasi Admin</a></li>
              <li><a href="#timeline" data-toggle="tab">Akun Telah di Konfirmasi 1 Minggu Kebelakang</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                 <div class="row">
                  <div class="col-xs-12">    
                    <div class="box">
                      <div class="box-header">
                        <h3 class="box-title">Menunggu Konfirmasi Akun</h3>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>Nama Lengkap</th>
                              <th>Username</th>
                              <th>Akses User</th>
                              <th>Status User</th>
                              <th>Tanggal Dibuat</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              foreach ($userWait as $key => $valWait) {
                            ?>
                             <tr>
                              <th><?php echo $valWait['user_fullname'];?></th>
                              <th><?php echo $valWait['user_name'];?></th>
                              <th><?php echo $akses = ($valWait['user_akses'] == 2) ? 'Pemilik Lapangan' : 'Penulis Berita';?></th>
                              <th><?php echo $status = ($valWait['user_status'] == 0) ? '<span class="label label-primary">Menunggu Konfirmasi</span>' : '';?></th>
                              <th><?php echo $valWait['user_created'];?></th>
                            </tr>
                            <?php
                              }
                            ?>
                          </tbody>
                          <tfoot>
                          <tr>
                              <th>Nama Lengkap</th>
                              <th>Username</th>
                              <th>Akses User</th>
                              <th>Status User</th>
                              <th>Tanggal Dibuat</th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row --> 
              </div>             
              <div class="tab-pane" id="timeline">
                <div class="row">
                  <div class="col-xs-12">    
                    <div class="box">
                      <div class="box-header">
                        <h3 class="box-title">Akun Aktif</h3>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>Nama Lengkap</th>
                              <th>Username</th>
                              <th>Akses User</th>
                              <th>Status User</th>
                              <th>Tanggal Dibuat</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              foreach ($userDone as $key => $valDone) {
                            ?>
                             <tr>
                              <th><?php echo $valDone['user_fullname'];?></th>
                              <th><?php echo $valDone['user_name'];?></th>
                              <th><?php echo $akses = ($valDone['user_akses'] == 2) ? 'Pemilik Lapangan' : 'Penulis Berita';?></th>
                              <th><?php echo $status = ($valDone['user_status'] == 1) ? '<span class="label label-success">Aktif</span>' : '';?></th>
                              <th><?php echo $valDone['user_created'];?></th>
                            </tr>
                            <?php
                              }
                            ?>
                          </tbody>
                          <tfoot>
                          <tr>
                              <th>Nama Lengkap</th>
                              <th>Username</th>
                              <th>Akses User</th>
                              <th>Status User</th>
                              <th>Tanggal Dibuat</th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row --> 
              </div>             
            </div>
            <!-- /.tab-content -->
          </div>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('assets/back/plugins/jQuery/jquery-2.2.3.min.js')?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/back/bootstrap/js/bootstrap.min.js')?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/back/plugins/iCheck/icheck.min.js')?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
