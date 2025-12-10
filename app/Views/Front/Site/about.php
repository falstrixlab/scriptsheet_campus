<!--banner-->
<div class="about">
	<div class="container">
		<h3>TENTANG</h3>
			<div class="ab-top">
				<div class="col-md-6 ab-lft">
					<img src="<?php echo base_url('assets/front/images/1.jpg')?>" alt=" " class="img-responsive">
				</div>
				<div class="col-md-6 ab-rgt">
					<h4>Sekilat Alto 13</h4>
					<?php
						foreach ($getTentang as $key => $value) {
							echo '<p style="text-align:justify;">'. $value['tentang_konten'] .'</p>';
						}
					?>
				</div>
				<div class="clearfix"></div>
			</div>
	</div>
</div>