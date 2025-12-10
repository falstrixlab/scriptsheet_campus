<div class="row">
  <div class="col-xs-12 col-md-12"> 
    <div class="box">          
      <!-- /.box-header -->
      <div class="box-body">
       <?php echo form_open_multipart('configs/add_studio');?>
        <table class="table table-hover">
          <tr>
            <td>Nama</td>
            <td>:</td>
            <td>
                <input type="text" class="form-control" name="studio_nama" placeholder="Studio Nama">
            </td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><textarea id="editor1" class="form-control" name="studio_alamat" rows="10" cols="80"></textarea></td>
          </tr>
          <tr>
            <td>Deskripsi & Fasilitas</td>
            <td>:</td>
            <td><textarea id="editor1" class="form-control" name="studio_fasilitas" rows="10" cols="80"></textarea></td>
          </tr>
          <tr>
            <td>Event</td>
            <td>:</td>
            <td><textarea id="editor1" class="form-control" name="studio_event" rows="10" cols="80"></textarea></td>
          </tr>
          <tr>
            <td>Harga</td>
            <td>:</td>
            <td>
                <input type="text" class="form-control" name="studio_harga" placeholder="Harga Perjam">
            </td>
          </tr>
          <tr>
            <td>Logo</td>
            <td>:</td>
            <td><input type="file" name="image" class=""></td>
          </tr>
          <tr>
            <td>Area</td>
            <td>:</td>
            <td>
              <select name="studio_area" id="" class="form-control">
                  <option value="">Pilih Area</option>
                  <option value="beji">Beji</option>
                  <option value="cilodong">Cilodong</option>
                  <option value="cimanggis">Cimanggis</option>
                  <option value="cinere">Cinere</option>
              </select>
            </td>
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