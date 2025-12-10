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
              <th>Nama Kategory</th>               
              <th colspan="3">Navigasi</th>
            </tr>
          </thead>
          <tbody>
<?php 
    foreach ($category as $key => $value) {            
?>
            <tr>
              <td><?php print($value['katm_nama']); ?></td>                            
              <td colspan="3">
                <a href="javascript:void(0);" class="btn btn-danger">Hapus</a>
                <a href="javascript:void(0);" class="btn btn-info">Edit</a>                                                
              </td>
            </tr> 
<?php } ?> 
          </tbody>
          <tfoot>
            <tr>
              <th>Nama Kategory</th>               
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