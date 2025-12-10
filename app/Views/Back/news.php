<div class="row">
  <div class="col-xs-12 col-md-12"> 
    <div class="box">      
      <!-- /.box-header -->
      <div class="box-body">
        <?php $session = session(); ?>
      <?php
        echo $session->setFlashdata('sukses_tambah');
        echo $session->setFlashdata('sukses_hapus');
        echo $session->setFlashdata('sukses_hapus');
        echo $session->setFlashdata('sukses_edit');
        echo '<br/><br/>';
      ?>
	   <a href="<?php echo site_url('administrator/add_news');?>" class="btn btn-primary">+ Tambah Data</a><br><br>
		<table id="example2" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Judul Berita</th>              
              <th>Gambar</th>
              <th>Status Aktivasi</th>              
              <th>Kategori Berita</th>
              <th>Dibuat</th>
              <th>Pembuat</th>      
              <th colspan="3">Navigasi</th>
            </tr>
          </thead>
          <tbody>
<?php 
    foreach ($actNews as $key => $value) {
      $status = ($value['berita_status'] == 1) ? 'Aktif' : 'Tidak Aktif';
      $hot = ($value['berita_hot'] ==  1) ? 'Hot' : 'Tidak Hot';      
?>
            <tr>
              <td><?php print($value['berita_judul']); ?></td>              
              <td><img style="width:80px; height:80px;" class="img-rounded" src="<?php echo site_url('assets/back/dist/file/berita/'. $value['berita_gambar'])?>"/></td>
              <td><?php print($status); ?></td>              
              <td><?php print($value['katm_nama']); ?></td>
              <td><?php print($value['berita_created']); ?></td>
              <td><?php print($value['user_fullname']); ?></td>
              <td colspan="3">
                <a href="javascript:void(0);" class="btn btn-success" onclick="showNews(<?php echo $value['berita_id'];?>)">Detail</a>                
              </td>
            </tr> 
<?php } ?> 
          </tbody>
        </table>

      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
<script type="text/javascript">
function showNews(idDetail) {
  $("#myModal").modal('show', function(){});
  $.ajax({
    method: "GET",
    url : "<?php echo site_url('administrator/activation_news_api/')?>"+ idDetail,
    data: '',
    dataType: 'json',
    success: function(data) {
      $('#judul_berita').append(data[0].berita_judul);
      $('#konten_berita').append(data[0].berita_konten);
      $('#gambar_berita').append('<img style="width:60px; height:60px;" class="img-rounded" src="<?php echo site_url('assets/back/dist/file/berita/')?>' +  data[0].berita_gambar + '"/>');
      $('#status').append(data[0].berita_status);
      $('#kategori').append(data[0].katm_nama);
      $('#dibuat').append(data[0].berita_created);
      $('#pembuat').append(data[0].user_fullname);
      $('#myModalLabel').append(data[0].berita_judul);
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
              <td id="judul_berita"></td>
            </tr>
            <tr>
              <td>Konten</td>
              <td>:</td>
              <td id="konten_berita"></td>
            </tr>
            <tr>
              <td>Gambar</td>
              <td>:</td>
              <td id="gambar_berita"></td>
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