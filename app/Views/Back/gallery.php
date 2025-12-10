<div class="row">
  <div class="col-xs-12">    
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Data Galeri</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <a href="<?php echo site_url('configs/add_galeri')?>" class="btn btn-success">Tambah</a><br><br>
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Judul</th>
              <th>File</th>
              <th>Status</th>
              <th>Navigasi</th>              
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($get_galeri as $key => $value) {
                $status = ($value['galeri_status'] == 1) ? 'Active' : '';
            ?>
            <tr>
              <td><?php echo $value['galeri_nama'];?></td>
              <td>
                <img src="<?php echo base_url('assets/back/dist/file/galeri/'.$value['galeri_file'])?>" style="width:50px; height:50px;">
              </td>
              <td><?php echo $status;?></td>
              <td>
                <a href="<?php echo site_url('configs/edit_galeri/'. $value['galeri_id'] .'')?>" class='btn btn-primary'>Edit</a>
                <a href="<?php echo site_url('configs/delete_galeri/'. $value['galeri_id'] .'')?>" class='btn btn-danger'>Delete</a>
              </td>
            </tr>        
            <?php
              }
            ?>            
          </tbody>
          <tfoot>
          <tr>
              <th>Judul</th>
              <th>File</th>
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