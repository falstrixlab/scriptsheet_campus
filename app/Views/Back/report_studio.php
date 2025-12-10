<div class="row">
  <div class="col-xs-12">    
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Report Studio</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <a href="" class="btn btn-primary" onclick="window.print()">Download Report</a><br><br>
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Rating</th>
              <th>Grade</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($studio as $key => $value) {
                $status = ($value['studio_status'] == 1) ? 'Aktif' : '';
                echo '<tr>
                        <th>'. $value['studio_nama'] .'</th>
                        <th>'. $value['studio_alamat'] .'</th>
                        <th>'. $value['studio_rating'] .'</th>
                        <th>'. $value['studio_grade'] .'</th>
                        <th>'. $status .'</th>
                      </tr>
                ';
              }
            ?>                  
          </tbody>
          <tfoot>
            <tr>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Rating</th>
              <th>Grade</th>
              <th>Status</th>
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