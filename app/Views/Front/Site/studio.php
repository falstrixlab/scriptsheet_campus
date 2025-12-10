<!--banner-->
<div class="events">
	<div class="container">
		<div class="col-md-12 events-left">
			<h3>Studio</h3>
			<?php
				foreach ($getStudio as $key => $value) {
			?>
			<div class="eve-top">
				<div class="col-md-5 eve-lt">
					<div class="ev-lft">
						<img src="<?php echo base_url('assets/back/dist/file/logo/'.$value['studio_logo'])?>" alt=" " class="img-responsive">
					</div>
					<div class="ev-rgt">
						<h5><?php echo $value['studio_area'];?> - Depok</h5>
						<h6>
							<?php
				                for ($i=1; $i <= $value['studio_rating']; $i++) { 
				                  echo '<img src="http://pngimg.com/uploads/star/star_PNG1585.png" style="width:30px; height:30px;">';
				                }
				            ?>
						</h6>
					</div>	
					<div class="clearfix"></div>
				</div>
				<div class="col-md-7 eve-rt">
					<h4><a href="<?php echo site_url('site/studio_detail/'.$value['studio_id']);?>" style="color:white;"><?php echo $value['studio_nama']?></a></h4>
					<p><?php echo $value['studio_alamat'];?></p>
					<p><?php echo $value['studio_fasilitas'];?></p>
					<p><a href="<?php echo site_url('site/studio_detail/'.$value['studio_id']);?>" class="btn btn-primary">Lihat Studio Band</a></p>
				</div>
				<div class="clearfix"></div>
			</div>
			<?php } ?>
		</div>
			<div class="clearfix"></div>
	</div>
</div>