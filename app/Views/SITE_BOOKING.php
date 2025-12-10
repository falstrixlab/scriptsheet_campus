<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ALTO APP | Booking</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/back/bootstrap/css/bootstrap.min.css')?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Datepicker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/back/plugins/datepicker/datepicker3.css')?>">
  <!-- Timepicker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/back/plugins/timepicker/bootstrap-timepicker.min.css')?>">
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
<div class="login-box" style="width:700px;">
  <div class="login-logo">
    <a href="<?php echo site_url('auth/booking');?>"><b>Alto</b>BOOKING</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <?php $session = session(); ?>
    <?php
      echo $session->setFlashdata('sukses_booking');
      echo $session->setFlashdata('gagal_booking');
    ?>
    <center style="font-size: 70px;"><i class="fa fa-expeditedssl"></i></center>  
    <div class="alert alert-info"><a class="close" data-dismiss="alert">×</a>Form Pemesanan</div>    
    <?php       
      foreach ($getJdl as $key => $valJdl) {
      echo form_open_multipart('auth/booking/'.$valJdl['jadwal_id']);
    ?>
      <p><b>Studio Band : <?php echo $valJdl['studio_nama']; ?></b></p>
      <p><b>Jadwal : <?php echo $valJdl['jadwal_jam']; ?></b></p>
      <div class="form-group has-feedback">
        <span>Nama Depan :</span><br>
        <input type="text" required="required" class="form-control" placeholder="Nama Depan" name="book_nama_depan">
        <input type="hidden" name="jadwal_id" value="<?php echo $valJdl['jadwal_id']?>">
        <input type="hidden" name="user_id" value="<?php echo $valJdl['user_id']?>">
      </div>
      <div class="form-group has-feedback">
        <span>Nama Belakang :</span><br>
        <input type="text" required="required" class="form-control" placeholder="Nama Belakang" name="book_nama_belakang">
      </div>
      <div class="form-group has-feedback">
        <span>Foto Ktp:</span><br>
        <input type="file"
         placeholder="Foto KTP" name="image">
      </div>  
      <div class="form-group has-feedback">
        <span>Alamat Lengkap :</span><br>
        <textarea id="" required="required" name="book_alamat" placeholder="Alamat Lengkap" cols="30" rows="10" class="form-control"></textarea>
      </div>
      <div class="form-group has-feedback">
        <span>No Handphone :</span><br>
        <input type="text" required="required" class="form-control" placeholder="No Handphone" name="book_telepon">
      </div>
       <div class="form-group has-feedback">
        <span>Harga :</span><br>
        <input type="text"  class="form-control" placeholder="No Handphone" disabled="disabled" value="<?php echo 'Rp. '. number_format($valJdl['studio_harga'], 0, ",", ",");?>">
        <input type="hidden" name="book_harga" value="<?php echo $valJdl['studio_harga'];?>">
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <!-- <label>
              <input type="checkbox"> Remember Me
            </label> -->
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-12">
          <input type="submit" class="btn btn-primary btn-block btn-flat" name="booking" value="Registrasi">
        </div>
        <div class="col-md-6">
          <hr>
        </div>
        <!-- /.col -->
      </div>
    </form>
  <?php 
    } 
  ?>
    <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->

    <!-- <a href="#">I forgot my password</a><br> --> 

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('assets/back/plugins/jQuery/jquery-2.2.3.min.js')?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/back/bootstrap/js/bootstrap.min.js')?>"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url('assets/back/plugins/datepicker/bootstrap-datepicker.js')?>"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url('assets/back/plugins/timepicker/bootstrap-timepicker.min.js')?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/back/plugins/iCheck/icheck.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/back/dist/js/app.min.js')?>"></script>
<script>
  $(function () {
     $('#datepickerss').datepicker({
      autoclose: true
    });
  });
</script>

</body>
</html>
