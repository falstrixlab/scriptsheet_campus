<div class="row">
  <div class="col-xs-12 col-md-12"> 
    <div class="box">        
      <!-- /.box-header -->
      <div class="box-body">
      <a href="" class="btn btn-success">Tambah Data</a><br><br>
<?php
  if (count($getData) > 0) { 
?>
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Nama Lengkap</th>              
              <th>Nama User</th>
              <th>Password</th>              
              <th>Akses</th>
              <th>Status</th>              
              <th>Dibuat</th>      
              <th colspan="3">Navigasi</th>
            </tr>
          </thead>
          <tbody>
<?php 
    foreach ($user as $key => $value) {      
      if ($value['user_akses'] == 2) {$data_akses = 'Pemilik Lapangan';} 
      else if ($value['user_akses'] == 3) {$data_akses = 'Penyewa Lapangan';} 
      else if ($value['user_akses'] == 4) {$data_akses = 'Pengisi Konten';}
      else if ($value['user_akses'] == 1) {$data_akses = 'Administrator';}

      $status = ($value['user_status'] == 1) ? 'Aktif' : '';
?>
            <tr>
              <td><?php print($value['user_fullname']); ?></td>              
              <td><?php print($value['user_name']); ?></td>              
              <td><?php print($value['user_pwd']); ?></td>              
              <td><?php print($data_akses); ?></td>
              <td><?php print($status); ?></td>
              <td><?php print($value['user_created']); ?></td>             
              <td colspan="3">
                <a href="javascript:void(0);" class="btn btn-danger">Hapus</a>
                <a href="javascript:void(0);" class="btn btn-info">Edit</a>                                
                <a href="javascript:void(0);" class="btn btn-primary">Detail</a>
              </td>
            </tr> 
<?php } ?> 
          </tbody>
          <tfoot>
            <tr>
              <th>Nama Lengkap</th>              
              <th>Nama User</th>
              <th>Password</th>
              <th>Akses</th>
              <th>Status</th>
              <th>Dibuat</th>
              <th colspan="3">Navigasi</th>
            </tr>
          </tfoot>
        </table>
<?php 
  } else {
    if ($akses == 2) {$nama_akses = 'Pemilik Lapangan';} 
    else if ($akses == 3) {$nama_akses = 'Penyewa Lapangan';} 
    else if ($akses == 4) {$nama_akses = 'Pengisi Konten';}
    else if ($akses == 1) {$nama_akses = 'Adminstrator';}
?>
  <center><h4><b>TIDAK ADA DATA AKTIVASI EVENT <?php print(strtoupper($nama_akses));?> !</b></h4></center>
<?php }?>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->