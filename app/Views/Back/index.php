<!-- Info boxes -->
              <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon"><i class="fa fa-fw fa-male"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Active user</span>
                      <span class="info-box-number">290</span>
                    </div><!-- /.info-box-content -->
                  </div><!-- /.info-box -->
                </div><!-- /.col -->
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon"><i class="fa fa-fw fa-newspaper-o"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">News</span>
                      <span class="info-box-number">102</span>
                    </div><!-- /.info-box-content -->
                  </div><!-- /.info-box -->
                </div><!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix visible-xs-block"></div>

                <div class="col-md-3 col-sm-3 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon"><i class="fa fa-fw fa-diamond"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Event</span>
                      <span class="info-box-number">390 <small>times</small></span>
                    </div><!-- /.info-box-content -->
                  </div><!-- /.info-box -->
                </div><!-- /.col -->
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon"><i class="fa fa-fw fa-music"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Studio</span>
                      <span class="info-box-number">2,000</span>
                    </div><!-- /.info-box-content -->
                  </div><!-- /.info-box -->
                </div><!-- /.col -->
              </div><!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="box card">
                      <div class="box-header with-border">
                        <h3 class="box-title">Monthly Data Report</h3>
                      </div><!-- /.box-header -->
                      <div class="box-body">
                          <div class="row">
                            <div class="col-md-8">
                                <p class="text-center">
                                  <strong>Test Result: 1 Jan, 2014 - 30 Jul, 2014</strong>
                                </p>
                                <div class="chart">
                                  <!-- Sales Chart Canvas -->
                                  <canvas id="pieChart" style="height:250px"></canvas>
                                </div><!-- /.chart-responsive -->
                            </div><!-- /.col -->
                            <div class="col-md-4">
                                <p class="text-center">
                                  <strong>Detail Result</strong>
                                </p>
                                <div class="progress-group">
                                  <span class="progress-text">Pemilik Studio</span>
                                  <span class="progress-number"><b>600</b>/times</span>
                                  <div class="progress sm">
                                      <div class="progress-bar progress-bar-aqua" style="width: 60%"></div>
                                  </div>
                                </div><!-- /.progress-group -->
                                <div class="progress-group">
                                  <span class="progress-text">Penyewa Studio</span>
                                  <span class="progress-number"><b>700</b>/times</span>
                                  <div class="progress sm">
                                      <div class="progress-bar progress-bar-red" style="width: 70%"></div>
                                  </div>
                                </div><!-- /.progress-group -->
                                <div class="progress-group">
                                  <span class="progress-text">Transaksi</span>
                                  <span class="progress-number"><b>500</b>/times</span>
                                  <div class="progress sm">
                                      <div class="progress-bar progress-bar-green" style="width: 50%"></div>
                                  </div>
                                </div><!-- /.progress-group -->
                                <div class="progress-group">
                                  <span class="progress-text">Keluhan</span>
                                  <span class="progress-number"><b>400</b>/times</span>
                                  <div class="progress sm">
                                      <div class="progress-bar progress-bar-yellow" style="width: 40%"></div>
                                  </div>
                                </div><!-- /.progress-group -->
                            </div><!-- /.col -->
                          </div><!-- /.row -->
                      </div><!-- ./box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
                 <div class="col-md-6">
                <!-- AREA CHART -->
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Report Weekly Chart</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="chart">
                      <canvas id="areaChart" style="height:250px"></canvas>
                    </div>
                  </div>
                  <!-- /.box-body -->
                </div>
              </div>
              <div class="col-md-6">
               <!-- /.box -->
              <!-- BAR CHART -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Registration Weekly Chart</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <canvas id="barChart" style="height:230px"></canvas>
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
              </div><!-- /.row -->