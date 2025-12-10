<div class="row">
  <div class="col-xs-12">    
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Data Keluhan</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Email</th>
              <th>Nama</th>
              <th>Isi Pengaduan</th>
              <th>Navigasi</th>              
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($pengaduan as $key => $value) {
            ?>
              <tr>
                <th><?php echo $value['keluhan_email']?></th>
                <th><?php echo $value['keluhan_nama']?></th>
                <th><?php echo $value['keluhan_isi']?></th>
                <th>
                  <a href="javascript:void(0);" class="btn btn-success" onclick="showKeluhan(<?php echo $value['keluhan_id'];?>)">Detail</a>
                  <a href="<?php echo site_url('configs/delete_keluhan/'.$value['keluhan_id']);?>" class="btn btn-danger" onClick="alert('Anda yakin hapus data ini ?')">Hapus</a>
                </th>              
              </tr>
            <?php
              }
            ?>
          </tbody>
          <tfoot>
           <tr>
              <th>Email</th>
              <th>Nama</th>
              <th>Isi Pengaduan</th>
              <th>Navigasi</th>              
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
              <td>Email</td>
              <td>:</td>
              <td id="keluhan_email"></td>
            </tr>
            <tr>
              <td>Nama</td>
              <td>:</td>
              <td id="keluhan_nama"></td>
            </tr>
            <tr>
              <td>Keluhan</td>
              <td>:</td>
              <td id="keluhan_isi"></td>
            </tr>           
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" class="close">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function showKeluhan(idDetail) {
  $("#myModal").modal('show', function(){});
  $.ajax({
    method: "GET",
    url : "<?php echo site_url('administrator/pengaduan_api/')?>"+ idDetail,
    data: '',
    dataType: 'json',
    success: function(data) {
      $('#keluhan_email').append(data[0].keluhan_email);
      $('#keluhan_nama').append(data[0].keluhan_nama);
      $('#keluhan_isi').append(data[0].keluhan_isi);     
    }
  });
  $('.close').click(function(){
      $('#keluhan_email').empty();
      $('#keluhan_nama').empty();
      $('#keluhan_isi').empty();      
  });
}
</script>