<?php
  foreach ($getStudio as $key => $value) {
?>
<div class="row">
  <div class="col-xs-12 col-md-12"> 
    <div class="box">          
      <!-- /.box-header -->
      <div class="box-body">
       <?php echo form_open_multipart('configs/update_studio');?>
        <table class="table table-hover">
          <tr>
            <td>Nama</td>
            <td>:</td>
            <td>
                <input type="text" value="<?php echo $value['studio_nama'];?>" class="form-control" name="studio_nama" placeholder="Studio Nama">
                <input type="hidden" name="studio_id" value="<?php echo $value['studio_id'];?>">
            </td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><textarea id="editor1" class="form-control" name="studio_alamat" rows="10" cols="80"><?php echo $value['studio_alamat'];?></textarea></td>
          </tr>
          <tr>
            <td>Deskripsi & Fasilitas</td>
            <td>:</td>
            <td><textarea id="editor1" class="form-control" name="studio_fasilitas" rows="10" cols="80"><?php echo $value['studio_fasilitas'];?></textarea></td>
          </tr>
          <tr>
            <td>Event</td>
            <td>:</td>
            <td><textarea id="editor1" class="form-control" name="studio_event" rows="10" cols="80"><?php echo $value['studio_event'];?></textarea></td>
          </tr>
          <tr>
            <td>Harga</td>
            <td>:</td>
            <td>
                <input type="text" class="form-control" name="studio_harga" placeholder="Harga Perjam" value="<?php echo $value['studio_harga'];?>">
            </td>
          </tr>
          <tr>
            <td>Logo</td>
            <td>:</td>
            <td>
              <img src="<?php echo base_url('assets/back/dist/file/logo/'. $value['studio_logo'] .'')?>" style="width:80px; height:80px;" alt=""><br><br>
              <input type="file" name="image" class=""><br>
              <input type="hidden" name="last_logo" value="<?php echo $value['studio_logo'];?>">
              <input type="checkbox" name="update_gambar"> <span>Yakin Edit Gambar ?</span>
            </td>
          </tr>
          <tr>
            <td>Area</td>
            <td>:</td>
            <td>
              <?php 
                $beji = ($value['studio_area'] == 'beji') ? 'selected="selected"' : '';
                $cilodong = ($value['studio_area'] == 'cilodong') ? 'selected="selected"' : '';
                $cimanggis = ($value['studio_area'] == 'cimanggis') ? 'selected="selected"' : '';
                $cinere = ($value['studio_area'] == 'cinere') ? 'selected="selected"' : '';
              ?>
              <select name="studio_area" id="" class="form-control">                
                  <option value="">Pilih Area</option>
                  <option value="beji" <?php echo $beji;?>>Beji</option>
                  <option value="cilodong" <?php echo $cilodong;?>>Cilodong</option>
                  <option value="cimanggis" <?php echo $cimanggis;?>>Cimanggis</option>
                  <option value="cinere" <?php echo $cinere;?>>Cinere</option>
              </select>
            </td>
          </tr>
          <tr>
            <td colspan="3">
              <input type="submit" name="update" class="col-md-4 col-md-offset-4 btn btn-primary" value="Edit Data">
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
<?php } ?>