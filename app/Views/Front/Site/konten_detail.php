<!--banner-->
<div class="events">
	<div class="container">
		<div class="col-md-12 events-left">
			<?php
				foreach ($detail as $key => $value) {
			?>
			<div class="eve-top">
				<div class="col-md-12">					
					<h5><?php echo ($parameter == 'event') ? $value['event_judul'] : $value['berita_judul'];?></h5><br>
					<div class="clearfix"></div>
				</div>
				<div class="col-md-12">	
					<?php $imagename = ($parameter === 'event') ? $value['event_gambar'] : $value['berita_gambar']; ?>
					<img style="width:100%; height:400px;" src="<?php echo base_url('assets/back/dist/file/'. $parameter .'/'. $imagename);?>" alt="">			
				</div>
				<div class="col-md-12">
					<?php echo ($parameter == 'event') ? $value['event_konten'] : $value['berita_konten'];?>
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