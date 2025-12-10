<div class="row">
  <div class="col-xs-12">    
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Tabel Tentang</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Konten</th>
              <th>Navigasi</th>              
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($tentang as $key => $value) {
                echo '
                        <tr>
                          <th>'. substr($value['tentang_konten'], 0, 100) .'</th>
                          <th>
                            <a href="javascript:void(0);" class="btn btn-success" onclick="showEvent();">Detail</a>
                            <a href="'. site_url('administrator/edit_about/'.$value['tentang_id']) .'" class="btn btn-primary">Edit</a>                
                          </th>              
                        </tr>
                     ';
              }
            ?>
          </tbody>
          <tfoot>
         <tr>
              <th>Konten</th>
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
<script type="text/javascript">
function showEvent(idDetail) {
  $("#myModal").modal('show', function(){});
  $.ajax({
    method: "GET",
    url : "<?php echo site_url('administrator/about_api/')?>",
    data: '',
    dataType: 'json',
    success: function(data) {
      $('#tentang_konten').append(data[0].tentang_konten);      
    }
  });
  $('.close').click(function(){
      $('#tentang_konten').empty();     
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
              <td>Tentang</td>
              <td>:</td>
              <td id="tentang_konten"></td>
            </tr>            
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" class="close">Close</button>
      </div>
    </div>
  </div>
</div>