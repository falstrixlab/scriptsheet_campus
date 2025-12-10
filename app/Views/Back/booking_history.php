<div class="row">
  <div class="col-xs-12">    
    <div class="box">
      <div class="box-header">
        <h3 class="box-title"></h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Nama Lengkap</th>
              <th>Alamat</th>
              <th>KTP</th>
              <th>Invoice</th>
              <th>Jadwal</th>
            </tr>
          </thead>
          <tbody>
          <?php
            foreach ($dataBooking as $key => $value) {
          ?>
            <tr>
              <td><?php echo $value['book_nama_depan'].' '.$value['book_nama_belakang']; ?></td>
              <td><?php echo $value['book_alamat'];?></td>
              <td><img src="<?php echo base_url('assets/back/dist/file/ktp/'.$value['book_ktp']);?>" style="width:50px; height:50px;" alt="KTP"></td>
              <td><?php echo $value['book_nomor'];?></td>
              <td><?php echo $value['jadwal_jam'];?></td>
            </tr>
          <?php
            }
          ?>
          </tbody>
          <tfoot>
          <tr>
              <th>Nama Lengkap</th>
              <th>Alamat</th>
              <th>KTP</th>
              <th>Invoice</th>
              <th>Jadwal</th>
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