<div class="row">
  <div class="col-xs-12 col-md-12"> 
    <div class="box">          
      <!-- /.box-header -->
      <div class="box-body">
       <?php echo form_open_multipart('configs/add_galeri');?>
        <table class="table table-hover">
          <tr>
            <td>Judul</td>
            <td>:</td>
            <td>
                <input type="text" class="form-control" name="galeri_nama" placeholder="Judul Galeri">
                <input type="hidden" name="event_pembuat" value="<?php echo $this->session->userdata('is_id')?>">
            </td>
          </tr>          
          <tr>
            <td>Foto</td>
            <td>:</td>
            <td><input type="file" name="image" class=""></td>
          </tr>                    
          <tr>
            <td colspan="3">
              <input type="submit" name="simpan" class="col-md-4 col-md-offset-4 btn btn-primary" value="Simpan Data">
            </td>
          </tr>
        </table>
      </div>
      </form>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->