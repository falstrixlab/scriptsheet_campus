<div class="row">
  <div class="col-xs-12 col-md-12"> 
    <div class="box">        
      <!-- /.box-header -->
      <div class="box-body">
        <?php $session = session(); ?>
        <?php
          echo $session->setFlashdata('sukses_insert');
          echo $session->setFlashdata('gagal_insert');
          echo $session->setFlashdata('sukses_update');
          echo $session->setFlashdata('gagal_update');
        ?>
      <a href="<?php echo site_url('configs/add_jadwal');?>" class="btn btn-success">Tambah Jadwal</a><br><br>
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Jadwal Jam</th>              
              <th>Status Jadwal</th>
              <th>Navigasi</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($getJadwal as $key => $value) {
                if ( $value['jadwal_status'] == 0  ) { $status = 'Avalilable'; }
                else if ($value['jadwal_status'] == 1) {$status = 'Waiting';}
                else if ($value['jadwal_status'] == 2) {$status = 'Booked';}
            ?>
              <tr style="text-align: center;">
                <td><?php echo $value['jadwal_jam']?></td>              
                <td><?php echo $status;?></td>
                <td><a class="btn btn-primary" href="<?php echo site_url('configs/update_jadwal/'. $value['jadwal_id'] .'');?>">Update Available</a></td>
                <!-- <td>Navigasi</td> -->
              </tr>
            <?php
              }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Jadwal Jam</th>              
              <th>Status Jadwal</th>
              <th>Navigasi</th>
              <!-- <th colspan="3">Navigasi</th> -->
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