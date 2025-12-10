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
<body>
<?php
  foreach ($getBook as $key => $valBook) {    
?>
<div >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
        <small>#<?php echo $valBook['book_nomor'];?></small>
      </h1>
    </section>

    <div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> Note:</h4>
        Apabila melakukan penipuan, akan dikenakan UU ITE tentang penipuan di Internet.
      </div>
    </div>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> <?php echo $valBook['studio_nama'];?>.
            <small class="pull-right">Date: <?php echo $valBook['book_tanggal'];?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Dari
          <address>
            <strong><?php echo $valBook['book_nama_depan'].' '.$valBook['book_nama_belakang'];?></strong><br>
            <?php echo $valBook['book_alamat'];?><br>
            No Hp :<?php echo $valBook['book_telepon'];?><br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          Kepada
          <address>
            <strong><?php echo $valBook['studio_nama'];?></strong><br>
            <?php echo $valBook['studio_alamat'];?><br>
            <?php echo $valBook['studio_area'];?><br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #<?php echo  $valBook['book_nomor'];?></b><br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Jam</th>
              <th>Jadwal</th>
              <th>Harga</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>1 Jam</td>
              <td><?php echo $valBook['jadwal_jam'];?></td>
              <td><?php echo 'Rp. '. number_format($valBook['studio_harga'], 0, ",", ",");?></td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Metode Pembayaran :</p>
          <img src="../../dist/img/credit/visa.png" alt="BCA">
          <img src="../../dist/img/credit/mastercard.png" alt="MANDIRI">
          <img src="../../dist/img/credit/american-express.png" alt="BNI">
          <img src="../../dist/img/credit/paypal2.png" alt="BRI">

          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Untuk metode pembayaran bisa dengan rekening : <br>
            1. BCA : 210293531 <br>
            2. MANDIRI : 3I8594403 <br>
            3. BNI : 4554332923 <br>
            4. BRI : 124235422 <br>
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Jatuh Tempo <?php echo $valBook['book_tanggal'];?></p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td><?php echo 'Rp. '. number_format($valBook['studio_harga'], 0, ",", ","); ?></td>
              </tr>
              <tr>
                <th>Tax (0%)</th>
                <td>$0</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td><?php echo 'Rp. '. number_format($valBook['studio_harga'], 0, ",", ",");?></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="#"  onclick="window.print()" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Download PDF</a>
           <a href="<?php echo site_url('site')?>"  target="_blank" class="btn btn-success"><i class="fa fa-home"></i> Kembali Halaman Utama</a>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
  <?php } ?>
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
