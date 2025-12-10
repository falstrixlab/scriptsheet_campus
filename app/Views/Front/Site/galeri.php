<!--gallery-->
<div class="gallery">
	<div class="container">
		<div class="galler-top">
			<?php
				foreach ($getGaleri as $key => $value) {
			?>
			<li>
				<div class="box maxheight">
					<a class="example-image-link" href="<?php echo base_url('assets/back/dist/file/galeri/'. $value['galeri_file'] .'')?>" data-lightbox="example-1" data-title="Guidance."><img class="example-image img-responsive" src="<?php echo base_url('assets/back/dist/file/galeri/'. $value['galeri_file'] .'')?>"></a>
				</div>
			</li>			
			<?php } ?>
		<div class="clearfix"></div>
		<!-- light-box -->
					<script src="js/lightbox-plus-jquery.min.js"></script>
					<link rel="stylesheet" href="css/lightbox.css">
				<!-- //light-box -->


		</div>
	</div>
</div>
<!--gallery-->