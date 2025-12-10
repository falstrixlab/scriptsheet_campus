<div class="row">
  <div class="col-xs-12 col-md-12"> 
    <div class="box">          
      <!-- /.box-header -->
      <div class="box-body">
       <?php echo form_open_multipart('configs/add_berita');?>
        <table class="table table-hover">
          <tr>
            <td>Judul</td>
            <td>:</td>
            <td>
              <input type="text" name="berita_judul" class="form-control" placeholder="Judul Berita">
              <input type="hidden" name="berita_pembuat" value="<?php echo $this->session->userdata('is_id')?>">
            </td>
          </tr>
          <tr>
            <td>Konten</td>
            <td>:</td>
            <td><textarea id="editor1" name="berita_konten" rows="10" cols="80"></textarea></td>
          </tr>
          <tr>
            <td>Foto</td>
            <td>:</td>
            <td><input type="file" name="image"></td>
          </tr>
          <tr>
            <td>Hot</td>
            <td>:</td>
            <td>
              <select name="berita_hot" class="form-control">
                <option value="">Pilih Status</option>
                <option value="1">Hot</option>
                <option value="0">Biasa</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>Kategori Musik</td>
            <td>:</td>
            <td>
              <select name="kategori_id" class="form-control">
                  <option value="">Pilih Kategori Musik</option>
                  <?php
                    foreach ($kat_musik as $key => $value) {
                      echo '<option value="'. $value['katm_id'] .'">'. $value['katm_nama'] .'</option>';
                    }
                  ?>
              </select>
            </td>
          </tr>
          <tr>
            <td colspan="3">
              <input type="submit" name="simpan" class="col-md-4 col-md-offset-4 btn btn-primary" value="Simpan Data">
            </td>
          </tr>
        </table>
        </form>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->