<!-- priv -->
<div class="priv">
	<div class="container">
		<div class="col-md-8 priv-left">
			<h3>Berita Terbaru</h3>
			<?php
				foreach ($getBerita as $key => $valBerita) {
			?>
				<div class="pvt-lt">
					<img src="<?php echo base_url('assets/back/dist/file/berita/'. $valBerita['berita_gambar'] .'');?>" alt=" " class="img-responsive">
				</div>
				<div class="pvt-rgt">
					<h4><a href="<?php echo site_url('site/detail/'. $valBerita['berita_id'] .'/berita');?>" style="color:#FEF356;"><?php echo $valBerita['berita_judul'];?></a></h4>
					<p style="text-align: justify;"><?php echo substr($valBerita['berita_konten'], 0, 250);?>....</p>
				</div>
				<div class="clearfix"></div><br>
			<?php
				}
			?>			
		</div>
		<div class="col-md-4 priv-right">
			<div class="pvt-rt">
				<h5>Studio Band Rating Terbaik</h5><hr>
				<?php
					foreach ($studioGood as $key => $valStudio) {
				?>
					<div class="col-md-4">
						<img src="<?php echo base_url('assets/back/dist/file/logo/'. $valStudio['studio_logo'] .'');?>" alt=" " class="img-responsive">
					</div>
					<div class="col-md-8">
						<h5><a href="<?php echo site_url('site/studio_detail/'. $valStudio['studio_id'] .'')?>"><?php echo $valStudio['studio_nama'];?></a></h5>
					</div>
					<div class="clearfix"></div><br>
				<?php } ?>
			</div>
		<div class="clearfix"></div>
	</div>
</div>
<div class="container">
	<div class="col-md-8">
		<h3>Event Terbaru</h3>
		<?php
				foreach ($getEventNew as $key => $valEvent) {
			?>
				<div class="pvt-lt">
					<img src="<?php echo base_url('assets/back/dist/file/event/'. $valEvent['event_gambar'] .'');?>" alt=" " class="img-responsive">
				</div>
				<div class="pvt-rgt">
					<h4><a href="<?php echo site_url('site/detail/'. $valEvent['event_id'] .'/event');?>" style="color:#FEF356;"><?php echo $valEvent['event_judul'];?></a></h4>
					<p style="text-align: justify;"><?php echo substr($valEvent['event_konten'], 0, 400);?>....</p>
				</div>
				<div class="clearfix"></div><br>
			<?php
				}
			?>
	</div>
	<div class="col-md-4">
		<h3>Studio Terbaru</h3>
		<?php
				foreach ($studioNew as $key => $valStudioNew) {
			?>
				<div class="pvt-lt">
					<img src="<?php echo base_url('assets/back/dist/file/logo/'. $valStudioNew['studio_logo'] .'');?>" alt=" " class="img-responsive">
				</div>
				<div class="pvt-rgt">
					<h4><a href="<?php echo site_url('site/studio_detail/'. $valStudioNew['studio_id'] .'')?>" style="color:#FEF356;"><?php echo $valStudioNew['studio_nama'];?></a></h4>
					<p style="text-align: justify;"><?php echo $valStudioNew['studio_alamat'];?>....</p>
				</div>
				<div class="clearfix"></div><br>
			<?php
				}
			?>
		<br>

		<h3>Rekomendasi Studio</h3>
		<?php
				foreach ($studioRek as $key => $valStudioRek) {
			?>
				<div class="pvt-lt">
					<img src="<?php echo base_url('assets/back/dist/file/logo/'. $valStudioRek['studio_logo'] .'');?>" alt=" " class="img-responsive">
				</div>
				<div class="pvt-rgt">
					<h4><a href="<?php echo site_url('site/studio_detail/'. $valStudioRek['studio_id'] .'')?>" style="color:#FEF356;"><?php echo $valStudioNew['studio_nama'];?></a></h4>
					<p style="text-align: justify;"><?php echo $valStudioRek['studio_alamat'];?>....</p>
				</div>
				<div class="clearfix"></div><br>
			<?php
				}
			?>
	</div>
</div>
<!-- priv -->
<!-- sched -->
<div class="sched">
	<div class="container">
		<div class="col-md-8 sched-left">
		<h4>Galeri Alto Studio</h4>
		<?php
			foreach ($galeri as $key => $valGal) {
		?>
		<li>
			<div class="box maxheight">
				<a class="example-image-link" href="<?php echo base_url('assets/back/dist/file/galeri/'. $valGal['galeri_file'] .'');?>" data-lightbox="example-1" data-title="Guidance.">
					<img class="example-image img-responsive" src="<?php echo base_url('assets/back/dist/file/galeri/'. $valGal['galeri_file'] .'');?>">
				</a>
			</div>
		</li>
		<?php } ?>
		<div class="clearfix"></div>
		</div>
		<!-- light-box -->
					<script src="<?php echo base_url('assets/front/js/lightbox-plus-jquery.min.js')?>"></script>
					<link rel="stylesheet" href="<?php echo base_url('assets/front/css/lightbox.css')?>">
				<!-- //light-box -->

		<div class="col-md-4 sched-right">
			<h4>Filosofi Musik</h4>
			<img src="<?php echo base_url('assets/front/images/1.jpg')?>" alt=" " class="img-responsive">
			<p>Musik memberi jiwa pada alam semesta, memberi sayap pada akal, dan menerbangkan imajinasi.</p>
		</div>
			<div class="clearfix"></div>
	</div>
</div>
<!-- sched -->