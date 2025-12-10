<div class="row">
  <div class="col-xs-12 col-md-12"> 
    <div class="box">          
      <!-- /.box-header -->
      <div class="box-body">
      <form action="<?php echo site_url('configs/update_tentang')?>" method="POST">
        <table class="table table-hover">  
        <?php
          foreach ($update_tentang as $key => $value) {            
        ?>        
          <tr>
            <td>Tentang Konten</td>
            <td>:</td>
            <td>
              <textarea name="tentang_konten"  class="form-control" rows="10" cols="80"><?php echo $value['tentang_konten']?></textarea>
              <input type="hidden" name="tentang_id" value="<?php echo $value['tentang_id']?>">
            </td>
          </tr> 
        <?php } ?>         
          <tr>
            <td colspan="3">
              <input type="submit" name="update" class="col-md-4 col-md-offset-4 btn btn-primary" value="Update Data">
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