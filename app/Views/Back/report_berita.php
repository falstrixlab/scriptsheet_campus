<div class="row">
  <div class="col-xs-12">    
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Report Berita</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <a href="" class="btn btn-primary" onclick="window.print()">Download Report</a><br><br>
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Judul Berita</th>
              <th>Konten</th>
              <th>Gambar</th>
              <th>Tanggal</th>
              <th>Status</th>
              <th>Hot</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($berita as $key => $value) {
                $status = ($value['berita_status'] == 1) ? 'Aktif' : '';
                $hot = ($value['berita_hot'] == 1) ? 'Ok' : '';
                echo '<tr>
                        <th>'. $value['berita_judul'] .'</th>
                        <th>'. $value['berita_konten'] .'</th>
                        <th>'. $value['berita_gambar'] .'</th>
                        <th>'. $value['berita_created'] .'</th>
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