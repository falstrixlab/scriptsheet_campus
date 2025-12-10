<div class="row">
  <div class="col-xs-12 col-md-12"> 
    <div class="box">          
      <!-- /.box-header -->
      <div class="box-body">
       <?php 
        echo form_open_multipart('configs/edit_galeri');
        foreach ($get_galeri as $key => $value) {         
       ?>
        <table class="table table-hover">
          <tr>
            <td>Judul</td>
            <td>:</td>
            <td>
                <input type="text" class="form-control" value="<?php echo $value['galeri_nama'];?>" name="galeri_nama" placeholder="Judul Galeri">
                <input type="hidden" name="galeri_id" value="<?php echo $value['galeri_id'];?>">
            </td>
          </tr> 
          <tr>
            <td>Foto Lama</td>
            <td>:</td>
            <td>
                <img src="<?php echo base_url('assets/back/dist/file/galeri/'.$value['galeri_file']);?>" style="width:60px; height:60px;" alt="">
                <input type="hidden" name="last_gambar" value="<?php echo $value['galeri_file'];?>">
                <br><input type="checkbox"  name="gambar_update"> Update Gambar ?
            </td>
          </tr>         
          <tr>
            <td>Foto</td>
            <td>:</td>
            <td><input type="file" name="image" class=""></td>
          </tr>                    
          <tr>
            <td colspan="3">
              <input type="submit" name="update" class="col-md-4 col-md-offset-4 btn btn-primary" value="Update Data">
            </td>
          </tr>
        </table>
      </div>
      <?php } ?>
      </form>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->