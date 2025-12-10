<div class="row">
  <div class="col-xs-12 col-md-12"> 
    <div class="box">          
      <!-- /.box-header -->
      <div class="box-body">
       <?php echo form_open_multipart('configs/add_jadwal');?>
        <table class="table table-hover">
          <tr>
            <td>Jadwal</td>
            <td>:</td>
            <td>
                <input type="text" class="form-control" name="jadwal_jam" placeholder="jadwal">
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