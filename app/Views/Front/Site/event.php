<!--banner-->
<div class="events">
	<div class="container">
		<div class="col-md-12 events-left">
			<h3>Events</h3>
			<?php
				foreach ($getEvent as $key => $value) {
				$date = explode('-', $value['event_created']);
				switch ($date[1]) {
					case '01':
						$month = 'Januari';
					break;
					case '02':
						$month = 'Febuari';
					break;
					case '03':
						$month = 'Maret';
					break;
					case '04':
						$month = 'April';
					break;
					case '05':
						$month = 'Mei';
					break;
					case '06':
						$month = 'Juni';
					break;
					case '07':
						$month = 'Juli';
					break;
					case '08':
						$month = 'Agustus';
					break;
					case '09':
						$month = 'September';
					break;
					case '10':
						$month = 'Oktober';
					break;
					case '11':
						$month = 'November';
					break;
					case '12':
						$month = 'Desember';
					break;
				}
			?>
			<div class="eve-top">
				<div class="col-md-5 eve-lt">
					<div class="ev-lft">
						<img src="<?php echo base_url('assets/back/dist/file/event/'.$value['event_gambar'])?>" alt=" " class="img-responsive">
					</div>
					<div class="ev-rgt">
						<h5><?php echo $date[2];?></h5>
						<h6><?php echo $month;?></h6>
					</div>	
					<div class="clearfix"></div>
				</div>
				<div class="col-md-7 eve-rt">
					<h4><a href="<?php echo site_url('site/detail/'. $value['event_id'] .'/event')?>" style="color:#FEF356;"><?php echo $value['event_judul']?></a></h4>
					<p><?php echo substr($value['event_konten'], 0, 500);?>.....</p>
				</div>
				<div class="clearfix"></div>
			</div>
			<?php } ?>
		</div>
			<div class="clearfix"></div>
	</div>
</div>