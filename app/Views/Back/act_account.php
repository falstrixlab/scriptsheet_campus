<div class="row">
  <div class="col-xs-12">    
    <div class="box"> 
      <?php $session = session(); ?>   
      <?php
        echo $session->setFlashdata('sukses_aktivasi');
        echo $session->setFlashdata('gagal_aktivasi');
      ?>    
      <!-- /.box-header -->
      <div class="box-body">
<?php
  if (count($getData) > 0) { 
?>
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Nama Lengkap</th>
              <th>Email</th>
              <th>Username</th>
              <th>Nomer KTP</th>
              <th>Tempat Lahir</th>
              <th>Tanggal Lahir</th>
              <th>Umur</th>
              <th>Hak Akses</th>      
              <th>Navigasi</th>
            </tr>
          </thead>
          <tbody>
<?php 
    foreach ($getData as $key => $value) {
      $data_akses = '';
      $expUmur = explode('/', $value['profile_tanggal']);
      if ($value['user_akses'] == 2) {$data_akses = 'Pemilik Lapangan';} 
      else if ($value['user_akses'] == 3) {$data_akses = 'Penyewa Lapangan';} 
      else if ($value['user_akses'] == 4) {$data_akses = 'Pengisi Konten';}
?>
            <tr>
              <td><?php print($value['user_fullname']); ?></td>
              <td><?php print($value['profile_email']); ?></td>
              <td><?php print($value['user_fullname']); ?></td>
              <td><?php print($value['profile_ktp']); ?></td>
              <td><?php print($value['profile_tempat']); ?></td>
              <td><?php print($value['profile_tanggal']); ?></td>
              <td><?php print($umur = date('Y') - $expUmur[2]); ?></td>
              <td><?php print($data_akses); ?></td>
              <td>
                <a href="<?php echo site_url('configs/aktivasi_akun/'. $nav .'/'.$value['user_id'])?>" class="btn btn-primary" onClick="alert('Anda Yakin Untuk Aktivasi User Ini ?')">Aktivasi</a>
              </td>
            </tr>  
<?php } ?> 
          </tbody>
          <tfoot>
          <tr>
              <th>Nama Lengkap</th>
              <th>Email</th>
              <th>Username</th>
              <th>Hak Akses</th>
              <th>Nomer KTP</th>
              <th>Tempat Lahir</th>
              <th>Tanggal Lahir</th>
              <th>Umur</th>      
              <th>Navigasi</th>
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
  <center><h4><b>TIDAK ADA DATA AKTIVASI USER <?php print(strtoupper($nama_akses));?> !</b></h4></center>
<?php }?>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->