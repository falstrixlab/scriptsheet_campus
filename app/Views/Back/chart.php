<!-- Info boxes -->
<div class="row">
  <div class="col-md-12">
    <div class="box card">
      <div class="box-header with-border">
        <h3 class="box-title">
          <?php 
            if ($this->uri->segment(3) == 'rating') { echo 'Studio'; }
            else {echo 'Area';}
          ?> Rating</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-8">
              <p class="text-center">
                <strong>Data Rating Berdasarkan Hasil Poling</strong>
              </p>
              <div class="chart">
                <!-- Sales Chart Canvas -->
                <canvas id="pieChart" style="height:250px"></canvas>
                </div><!-- /.chart-responsive -->
                </div><!-- /.col -->
                <div class="col-md-4">
                  <p class="text-center">
                    <strong>Hasil Data</strong>
                  </p>
                  <div class="progress-group">
                    <span class="progress-text">
                      <?php 
                        if ($this->uri->segment(3) == 'rating') { echo 'Paling Bagus';}
                        else { echo 'Beji'; }
                      ?>
                    </span>
                    <span class="progress-number">
                      <b><?php 
                        if ($this->uri->segment(3) == 'rating') { echo $terbaik; }
                        else { echo $beji; }
                      ?></b> Data
                    </span>
                    <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: 
                      <?php 
                        if ($this->uri->segment(3) == 'rating') { echo $terbaik; }
                        else { echo $beji; }
                      ?>%"></div>
                    </div>
                    </div><!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">
                        <?php 
                          if ($this->uri->segment(3) == 'rating') { echo 'Bagus';}
                          else { echo 'Cilodong'; }
                        ?>
                      </span>
                      <span class="progress-number"><b><?php 
                        if ($this->uri->segment(3) == 'rating') { echo $baik; }
                        else { echo $cilodong; }
                      ?></b> Data</span>
                      <div class="progress sm">
                        <div class="progress-bar progress-bar-red" style="width: 
                        <?php 
                          if ($this->uri->segment(3) == 'rating') { echo $baik; }
                          else { echo $cilodong; }
                        ?>%"></div>
                      </div>
                    </div><!-- /.progress-group -->
                    <div class="progress-group">
                        <span class="progress-text">
                          <?php 
                            if ($this->uri->segment(3) == 'rating') { echo 'Cukup';}
                            else { echo 'Cimanggis'; }
                          ?>
                        </span>
                        <span class="progress-number"><b>
                          <?php 
                            if ($this->uri->segment(3) == 'rating') { echo $cukup; }
                            else { echo $cimanggis; }
                          ?></b> Data</span>
                        <div class="progress sm">
                          <div class="progress-bar progress-bar-green" style="width: 
                            <?php 
                              if ($this->uri->segment(3) == 'rating') { echo $cukup; }
                              else { echo $cimanggis; }
                            ?>%"></div>
                        </div>
                    </div><!-- /.progress-group -->
                    <div class="progress-group">
                          <span class="progress-text">
                            <?php 
                              if ($this->uri->segment(3) == 'rating') { echo 'Buruk';}
                              else { echo 'Cinere'; }
                            ?>
                          </span>
                          <span class="progress-number"><b>
                          <?php 
                            if ($this->uri->segment(3) == 'rating') { echo $buruk; }
                            else { echo $cinere; }
                          ?></b> Data</span>
                          <div class="progress sm">
                            <div class="progress-bar progress-bar-yellow" style="width: 
                            <?php 
                              if ($this->uri->segment(3) == 'rating') { echo $buruk; }
                              else { echo $cinere; }
                            ?>%"></div>
                          </div>
                    </div><!-- /.progress-group -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- ./box-body -->
    </div><!-- /.box -->
     <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Data Lengkap 10 Terbaru</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                   <div class="col-md-12">
                      <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="#a" data-toggle="tab">
                            <?php 
                              if ($this->uri->segment(3) == 'rating') { echo 'Paling Bagus'; }
                              else { echo 'Beji'; }
                            ?></a></li>
                          <li><a href="#b" data-toggle="tab">
                            <?php
                              if ($this->uri->segment(3) == 'rating') { echo 'Bagus'; }
                              else { echo 'Cimanggis'; }
                            ?>
                          </a></li>
                          <li><a href="#c" data-toggle="tab">
                            <?php
                              if ($this->uri->segment(3) == 'rating') { echo 'Cukup'; }
                              else { echo 'Cilodong'; }
                            ?>
                          </a></li>
                          <li><a href="#d" data-toggle="tab">
                            <?php
                              if ($this->uri->segment(3) == 'rating') { echo 'Buruk'; }
                              else { echo 'Cinere'; }
                            ?>
                          </a></li>
                        </ul>
                        <div class="tab-content">
                          <div class="active tab-pane" id="a">
                            <table id="dataA" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>Nama Studio</th>              
                                <th>Alamat</th>
                                <th>Wilayah</th>              
                                <th>Logo Studio</th>
                                <th>Status Studio</th>                                                                
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                              if ($this->uri->segment(3) == 'rating') { $dataFirst = $data_terbaik;} 
                              else { $dataFirst = $data_beji; }

                              foreach ($dataFirst as $key => $value) {
                                $set_status = ($value['studio_status'] == 1) ? 'Aktif' : '';
                                echo '<tr>
                                        <th>'. $value['studio_nama'] .'</th>              
                                        <th>'. $value['studio_alamat'] .'</th>
                                        <th>'. $value['studio_area'] .'</th>              
                                        <th>'. $value['studio_logo'] .'</th>
                                        <th>'. $set_status .'</th>                                                                                
                                      </tr>';
                              }
                            ?>
                            </tbody>
                            </table>
                          </div>
                          <!-- /.tab-pane -->
                          <div class="tab-pane" id="b">
                            <table id="dataB" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>Nama Studio</th>              
                                <th>Alamat</th>
                                <th>Wilayah</th>              
                                <th>Logo Studio</th>
                                <th>Status Studio</th>                                                                
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                              if ($this->uri->segment(3) == 'rating') { $dataSeconde = $data_baik; } 
                              else { $dataSeconde = $data_cimanggis; }

                              foreach ($dataSeconde as $key => $value) {
                               $set_status = ($value['studio_status'] == 1) ? 'Aktif' : '';
                                echo '<tr>
                                        <th>'. $value['studio_nama'] .'</th>              
                                        <th>'. $value['studio_alamat'] .'</th>
                                        <th>'. $value['studio_area'] .'</th>              
                                        <th>'. $value['studio_logo'] .'</th>
                                        <th>'. $set_status .'</th>                                                                                
                                      </tr>';
                              }
                            ?>
                            </tbody>
                            </table>
                          </div>
                          <!-- /.tab-pane -->

                          <div class="tab-pane" id="c">
                            <table id="dataC" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>Nama Studio</th>              
                                <th>Alamat</th>
                                <th>Wilayah</th>              
                                <th>Logo Studio</th>
                                <th>Status Studio</th>                                                                
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                              if ($this->uri->segment(3) == 'rating') { $dataThird = $data_cukup; } 
                              else { $dataThird = $data_cilodong; }

                              foreach ($dataThird as $key => $value) {
                                $set_status = ($value['studio_status'] == 1) ? 'Aktif' : '';
                                echo '<tr>
                                        <th>'. $value['studio_nama'] .'</th>              
                                        <th>'. $value['studio_alamat'] .'</th>
                                        <th>'. $value['studio_area'] .'</th>              
                                        <th>'. $value['studio_logo'] .'</th>
                                        <th>'. $set_status .'</th>                                                                                
                                      </tr>';
                              }
                            ?>
                            </tbody>
                            </table>
                          <!-- /.tab-pane -->
                          </div>
                          <div class="tab-pane" id="d">
                           <table id="dataD" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>Nama Studio</th>              
                                <th>Alamat</th>
                                <th>Wilayah</th>              
                                <th>Logo Studio</th>
                                <th>Status Studio</th>                                                                
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                              if ($this->uri->segment(3) == 'rating') { $dataFourth = $data_buruk; } 
                              else { $dataFourth = $data_cinere; }

                              foreach ($dataFourth as $key => $value) {
                                $set_status = ($value['studio_status'] == 1) ? 'Aktif' : '';
                                echo '<tr>
                                        <th>'. $value['studio_nama'] .'</th>              
                                        <th>'. $value['studio_alamat'] .'</th>
                                        <th>'. $value['studio_area'] .'</th>              
                                        <th>'. $value['studio_logo'] .'</th>
                                        <th>'. $set_status .'</th>                                                                                
                                      </tr>';
                              }
                            ?>
                            </tbody>
                            </table>
                          <!-- /.tab-pane -->
                          </div>
                        <!-- /.tab-content -->
                      </div>
                      <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
  </div><!-- /.col -->                         
</div><!-- /.row -->