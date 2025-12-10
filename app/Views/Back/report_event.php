<div class="row">
  <div class="col-xs-12">    
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Report Event</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <a href="" class="btn btn-primary" onclick="window.print()">Download Report</a><br><br>
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Judul Event</th>
              <th>Konten</th>
              <th>Gambar</th>
              <th>Tanggal</th>
              <th>Status</th>
              <th>Hot</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($event as $key => $value) {
                $status = ($value['event_status'] == 1) ? 'Aktif' : '';
                $hot = ($value['event_hot'] == 1) ? 'Ok' : '';
                echo '<tr>
                        <th>'. $value['event_judul'] .'</th>
                        <th>'. $value['event_konten'] .'</th>
                        <th>'. $value['event_gambar'] .'</th>
                        <th>'. $value['event_created'] .'</th>
                        <th>'. $status .'</th>
                        <th>'. $hot .'</th>
                      </tr>
                ';
              }
            ?>                  
          </tbody>
          <tfoot>
            <tr>
              <th>Judul Berita</th>
              <th>Konten</th>
              <th>Gambar</th>
              <th>Tanggal</th>
              <th>Status</th>
              <th>Hot</th>
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