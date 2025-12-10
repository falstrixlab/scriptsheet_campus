<div class="row">
  <div class="col-xs-12">    
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Rekomendasi Studio</h3>
        <?php $session = session(); ?>
        <?php
          echo $session->setFlashdata('sukses_rekomendasi');
          echo $session->setFlashdata('gagal_rekomendasi');
        ?>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Nama Studio</th>
              <th>Logo Studio</th>
              <th>Status</th>
              <th>Navigasi</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($studio as $key => $value) {
              if ($value['studio_rekomendasi'] == 1) {$label = '<span class="label label-success">Sudah di Rekomendasi</span>';}
              else { $label = '<span class="label label-danger">Belum di Rekomendasi</span>'; }
            ?>
            <tr>
              <td><?php echo $value['studio_nama'];?></td>
              <td><img src="<?php echo base_url('assets/back/dist/file/logo/'. $value['studio_logo'] .'');?>" style="width:100px; height:100px;"></td>
              <td><?php echo $label;?></td>
              <td><a href="<?php echo site_url('configs/rekomendasi_studio/'. $value['studio_id'] .'')?>" class="btn btn-primary">Rekomendasi Studio</a></td>
            </tr>
            <?php
              }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Nama Studio</th>
              <th>Logo Studio</th>
              <th>Status</th>
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