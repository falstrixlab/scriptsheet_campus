<div class="row">
  <div class="col-xs-12">    
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Report Profile</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <a href="" class="btn btn-primary" onclick="window.print()">Download Report</a><br><br>
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Nama Lengkap</th>
              <th>Email</th>
              <th>Hp</th>
              <th>Foto</th>
              <th>KTP</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($profile as $key => $value) {
                echo '<tr>
                        <th>'. $value['profile_firstname'] .' '. $value['profile_lastname'] .'</th>
                        <th>'. $value['profile_email'] .'</th>
                        <th>'. $value['profile_hp'] .'</th>
                        <th><img style="width:50px; height:50px;" src="'. base_url('assets/back/dist/file/user') .'/'. $value['profile_foto'] .'"></th>
                        <th>'. $value['profile_ktp'] .'</th>
                      </tr>
                ';
              }
            ?>                  
          </tbody>
          <tfoot>
            <tr>
              <th>Nama Lengkap</th>
              <th>Email</th>
              <th>Hp</th>
              <th>Foto</th>
              <th>KTP</th>
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