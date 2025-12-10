<div class="row">
  <div class="col-xs-12 col-md-12"> 
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
              <th>Judul Event</th>
              <th>Konten Event</th>
              <th>Gambar</th>
              <th>Status Aktivasi</th>              
              <th>Kategori Event</th>
              <th>Dibuat</th>
              <th>Pembuat</th>      
              <th colspan="2">Navigasi</th>
            </tr>
          </thead>
          <tbody>
<?php 
    foreach ($actEvent as $key => $value) {
      $status = ($value['event_status'] == 1) ? 'Aktif' : 'Tidak Aktif';
      $hot = ($value['event_hot'] ==  1) ? 'Hot' : 'Tidak Hot';
      if ($value['user_akses'] == 2) {$data_akses = 'Pemilik Lapangan';} 
      else if ($value['user_akses'] == 3) {$data_akses = 'Penyewa Lapangan';} 
      else if ($value['user_akses'] == 4) {$data_akses = 'Pengisi Konten';}
?>
            <tr>
              <td><?php print($value['event_judul']); ?></td>
              <td><?php print($value['event_konten']); ?></td>
              <td><img style="width:80px; height:80px;" class="img-rounded" src="<?php echo site_url('assets/back/dist/file/event/'. $value['event_gambar'])?>"/></td>
              <td><?php print($status); ?></td>              
              <td><?php print($value['katm_nama']); ?></td>
              <td><?php print($value['event_created']); ?></td>
              <td><?php print($value['user_fullname']); ?></td>
              <td colspan="2">
                <a href="javascript:void(0);" class="btn btn-success" onclick="showEvent(<?php echo $value['event_id'];?>)">Detail</a>
                <a href="<?php echo site_url('configs/aktivasi_konten/event/'.$value['event_id'])?>" class="btn btn-primary" onClick="alert('Anda Yakin Untuk Aktivasi User Ini ?')">Aktivasi</a>                
              </td>
            </tr>  
<?php } ?> 
          </tbody>
          <tfoot>
            <tr>
              <th>Judul Event</th>
              <th>Konten Event</th>
              <th>Gambar</th>
              <th>Status Aktivasi</th>
              <th>Status Hot</th>
              <th>Kategori Event</th>
              <th>Dibuat</th>
              <th colspan="2">Navigasi</th>
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
<script type="text/javascript">
function showEvent(idDetail) {
  $("#myModal").modal('show', function(){});
  $.ajax({
    method: "GET",
    url : "<?php echo site_url('administrator/activation_event_api/')?>"+ idDetail,
    data: '',
    dataType: 'json',
    success: function(data) {
      $('#judul_event').append(data[0].event_judul);
      $('#konten_event').append(data[0].event_konten);
      $('#gambar_event').append('<img style="width:60px; height:60px;" class="img-rounded" src="<?php echo site_url('assets/back/dist/file/berita/')?>' +  data[0].event_gambar + '"/>');
      $('#status').append(data[0].event_status);
      $('#kategori').append(data[0].katm_nama);
      $('#dibuat').append(data[0].event_created);
      $('#pembuat').append(data[0].user_fullname);
      $('#myModalLabel').append(data[0].event_judul);
    }
  });
  $('.close').click(function(){
      $('#judul_berita').empty();
      $('#konten_berita').empty();
      $('#gambar_berita').empty();
      $('#status').empty();
      $('#kategori').empty();
      $('#dibuat').empty();
      $('#pembuat').empty();
      $('#myModalLabel').empty();
  });
}
</script>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
        <table class="col-md-12 table table-striped">
            <tr>
              <td>Judul Berita</td>
              <td>:</td>
              <td id="judul_event"></td>
            </tr>
            <tr>
              <td>Konten</td>
              <td>:</td>
              <td id="konten_event"></td>
            </tr>
            <tr>
              <td>Gambar</td>
              <td>:</td>
              <td id="gambar_event"></td>
            </tr>
            <tr>
              <td>Status</td>
              <td>:</td>
              <td id="status"></td>
            </tr>
            <tr>
              <td>Kategori</td>
              <td>:</td>
              <td id="kategori"></td>
            </tr>
            <tr>
              <td>Dibuat</td>
              <td>:</td>
              <td id="dibuat"></td>
            </tr>
            <tr>
              <td>Pembuat</td>
              <td>:</td>
              <td id="pembuat"></td>
            </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" class="close">Close</button>
      </div>
    </div>
  </div>
</div>