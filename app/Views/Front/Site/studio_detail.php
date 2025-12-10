<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

<style>

.cont {
  width: 93%;
  max-width: 350px;
  text-align: center;
  margin: 4% auto;
  padding: 30px 0;
  background: #111;
  color: #EEE;
  border-radius: 5px;
  border: thin solid #444;
  overflow: hidden;
}



div.title { font-size: 2em; }



div.stars {
  width: 300px;
  display: inline-block;
}

input.star { display: none; }

label.star {
  float: right;
  padding: 10px;
  font-size: 36px;
  color: #444;
  transition: all .2s;
}

input.star:checked ~ label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}

input.star-5:checked ~ label.star:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}

input.star-1:checked ~ label.star:before { color: #F62; }

label.star:hover { transform: rotate(-15deg) scale(1.3); }

label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}
</style>
<link href="http://www.cssscript.com/wp-includes/css/sticky.css" rel="stylesheet" type="text/css">
<!--banner-->
<div class="events">
	<div class="container">
		<div class="col-md-12 events-left">
			<?php
				foreach ($getStudioDetail as $key => $value) {
			?>
			<div class="eve-top">
				<div class="col-md-12">					
					<h5><?php echo $value['studio_nama']?> Studio Band</h5><br>
					<h5><?php echo $value['studio_area'];?> - Depok</h5><br>
					<h6>
						<?php
				            for ($i=1; $i <= $value['studio_rating']; $i++) { 
				                echo '<img src="http://pngimg.com/uploads/star/star_PNG1585.png" style="width:30px; height:30px;">';
				            }
				        ?>
					</h6><hr>
					<div class="clearfix"></div>
				</div>
				<div class="col-md-12">	
					<div class="col-md-2">
						<img style="width:120px; height:120px;" src="<?php echo base_url('assets/back/dist/file/logo/'.$value['studio_logo'])?>" alt=" " class="img-responsive"><br/>			
					</div>						
					<div class="col-md-10">
					<h3 style="color:white;">Alamat</h3>
					<p><?php echo $value['studio_alamat'];?></p><br>
					<h3 style="color:white;">Fasilitas & Detail</h3>
					<p><?php echo $value['studio_fasilitas'];?></p><br>
					<h3 style="color:white;">Tentang Studio Band</h3>
					<p><?php echo $value['studio_event'];?></p><br>
					<h3 style="color:white;">Harga Studio Per Jam</h3>
					<h4><?php echo 'Rp. '. number_format($value['studio_harga'], 0, ",", ",");?></h4><br>
					<h3 style="color:white;">Jadwal Studio Band</h3><br>					
					<table class="table" style="color:#FEF356;text-align: center; border:1px solid white;">
						<tr style="background-color: #FEF356; color:black;">
							<td>Jam Tersedia</td>
							<td>Status</td>
							<td>Navigasi</td>
							<td>Konfirmasi</td>
						</tr>
						<?php
							foreach ($getJadwal as $key => $valJadwal) {
								if ( $valJadwal['jadwal_status'] == 0  ) { $status = '<span class="label label-primary">Avalilable</span>'; }
				                else if ($valJadwal['jadwal_status'] == 1) {$status = '<span class="label label-warning">Waiting</span>';}
				                else if ($valJadwal['jadwal_status'] == 2) {$status = '<span class="label label-success">Process</span>';}
				                else if ($valJadwal['jadwal_status'] == 3) {$status = '<span class="label label-danger">Booked</span>';}
								echo '
									<tr>
										<td>'. $valJadwal['jadwal_jam'] .'</td>
										<td>'. $status .'</td>
										<td>'. $book = ($valJadwal['jadwal_status'] == 0) ? '<a class="btn btn-primary" href="'. base_url('auth/booking/'.$valJadwal['jadwal_id']) .'">Booking</a>' : '<input type="text" value="Booking" style="width:80px;" class="btn btn-primary" disabled="disabled">' .'</td>
										<td>
											'. $conf = ($valJadwal['jadwal_status'] == 2) ? '<a href="'. base_url('auth/booking/'. $valJadwal['jadwal_id'] .'/confirmation') .'" class="btn btn-warning">Konfirmasi Pembayaran</a>' : '<a href="#" class="btn btn-warning" disabled="disabled">Konfirmasi Pembayaran</a>' .'
										</td>
									</tr>';
							}
						?>
						
					</table><br/><br>
					<div class="events">
		<div class="col-md-12">
			<h3>Events</h3>
			<?php
				foreach ($d as $key => $value) {
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
					<p><?php echo substr($value['event_konten'], 0, 300);?>.....</p>
				</div>
				<div class="clearfix"></div>
			</div>
			<?php } ?>
		</div>
			<div class="clearfix"></div>
</div>
					 <div class="css-script-ads"><script type="text/javascript"><!--
						google_ad_client = "ca-pub-2783044520727903";
						/* CSSScript Demo Page */
						google_ad_slot = "3025259193";
						google_ad_width = 728;
						google_ad_height = 90;
						//-->
					</script> 
					</script></div>
					    <div class="css-script-clear"></div>
					  </div>
					</div>
					<div class="cont" style="margin-top:150px;">
					 <h3>Rating Studio Band</h3>					 
					  <div class="stars">
					    <form action="">
					      <input class="star star-5" id="star-5" type="radio" name="star"/>
					      <label class="star star-5" for="star-5"></label>
					      <input class="star star-4" id="star-4" type="radio" name="star"/>
					      <label class="star star-4" for="star-4"></label>
					      <input class="star star-3" id="star-3" type="radio" name="star"/>
					      <label class="star star-3" for="star-3"></label>
					      <input class="star star-2" id="star-2" type="radio" name="star"/>
					      <label class="star star-2" for="star-2"></label>
					      <input class="star star-1" id="star-1" type="radio" name="star"/>
					      <label class="star star-1" for="star-1"></label>
					    </form>
					  </div>
					<script>
						(function() { // DON'T EDIT BELOW THIS LINE
						var d = document, s = d.createElement('script');
						s.src = 'https://alto13-com.disqus.com/embed.js';
						s.setAttribute('data-timestamp', +new Date());
						(d.head || d.body).appendChild(s);
						})();
					</script>
						<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>					
					</div>					
				</div>
				<div class="clearfix"></div>
			</div>
			<?php } ?>
		</div>
		<div id="disqus_thread"></div>
                            
		<div class="clearfix"></div>
	</div>
</div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46156385-1', 'cssscript.com');
  ga('send', 'pageview');

</script>