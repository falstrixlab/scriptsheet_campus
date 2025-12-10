<div class="row">
  <div class="col-xs-12">    
    <div class="box">
      <div class="box-header">
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <?php 
          if (count($getStudio) == 0) { echo '<a href="'. site_url('configs/add_studio') .'" class="btn btn-primary">Create Profile</a>'; } 
          else { echo ''; }
        ?>
        <?php
          foreach ($getStudio as $key => $value) {
        ?>
        <div class="col-md-12">
          <a href="<?php echo site_url('configs/update_studio');?>" class="btn btn-primary">Update Studio</a><br><br>
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('assets/back/dist/file/logo/'.$value['studio_logo']);?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $value['studio_nama'];?></h3>

              <p class="text-muted text-center">Pemilik Studio Band</p>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Detail Studio</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Alamat</strong>

              <p class="text-muted">
                <?php echo $value['studio_alamat'];?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Lokasi</strong>

              <p class="text-muted"><?php echo 'Indonesia,'.$value['studio_area'];?></p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Fasilitas</strong>

              <p class="text-muted"><?php echo $value['studio_fasilitas'];?></p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Harga Studio</strong>

              <p class="text-muted"><?php echo "Rp. ". number_format($value['studio_harga'], 0, ",", ",").' / Jam';?></p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Event</strong>

              <p class="text-muted"><?php echo $value['studio_event'];?></p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Grade & Rating</strong>
              <p>
              <?php
                for ($i=1; $i <= $value['studio_rating']; $i++) { 
                  echo '<img src="http://pngimg.com/uploads/star/star_PNG1585.png" style="width:30px; height:30px;">';
                }
              ?>
              </p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
       <?php } ?>
  </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->