<!DOCTYPE HTML>
<html>
	<head>
		<title>ALTO MUSIC</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Music8 Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
		Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
		<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<link href="<?php echo base_url('assets/front/css/bootstrap.css')?>" rel='stylesheet' type='text/css' />
		<!-- Custom Theme files -->
		<link href="<?php echo base_url('assets/front/css/style.css')?>" rel='stylesheet' type='text/css' />
		<script src="<?php echo base_url('assets/front/js/jquery-1.11.1.min.js')?>"></script>
		<!--webfonts-->
		<link href='//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,400,300,600,700|Six+Caps' rel='stylesheet' type='text/css'>
		<!--//webfonts-->
	</head>
	<body>
		<!--banner-->
		<?php $uri = service('uri'); $seg3 = $uri->getTotalSegments() >= 3 ? $uri->getSegment(3) : ''; ?>
				<div class="<?php echo ($seg3 == 'beranda') ? 'banner' : '';?>" id="home">
			<div class="header-top">
				<div class="header-bottom">
					<div class="fixed-header">
						<div class="logo">
							<h1><a href="<?php echo site_url('site/kanal/beranda');?>">Alto<span>13</span></a></h1>
						</div>
						<div class="hd-lt">
							<span class="menu"> </span>
							<div class="top-menu">
								<nav class="cl-effect-21">
									<ul>
										<li><a class="active" href="<?php echo site_url('site/kanal/beranda');?>">Beranda</a></li>
										<li><a href="<?php echo site_url('site/kanal/tentang');?>">Tentang</a></li>
										<li><a href="<?php echo site_url('site/kanal/event');?>">Event</a></li>
										<li><a href="<?php echo site_url('site/kanal/galeri');?>">Galeri</a></li>
										<li><a href="<?php echo site_url('site/kanal/studio');?>">Studio Band</a></li>
										<li><a href="<?php echo site_url('auth/registrasi');?>">Daftar</a></li>
										<div class="clearfix"></div>
									</ul>
								</nav>
							</div>
							
							<!-- script for menu -->
							<script>
							$( "span.menu" ).click(function() {
							$( ".top-menu" ).slideToggle( "slow", function() {
							// Animation complete.
							});
							});
							</script>
							<!-- script for menu -->
							<script>
							$(document).ready(function() {
							var navoffeset=$(".header-bottom").offset().top;
							$(window).scroll(function(){
								var scrollpos=$(window).scrollTop();
								if(scrollpos >=navoffeset){
									$(".header-bottom").addClass("fixed");
								}else{
									$(".header-bottom").removeClass("fixed");
								}
							});
							
							});
							</script>
							<div class="header-right">
								<h6><a href="<?php echo site_url('site/kanal/keluhan')?>"><b>KELUHAN</b></a></h6>
								<ul class="f-icons">
									<li><a href="#" class="facebook"> </a></li>
									<li><a href="#" class="p"> </a></li>
									<li><a href="#" class="twitter"> </a></li>
								</ul>
								<div class="clearfix"></div>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					</div>
					
				</div>
			</div>
		</div><?php echo ($seg3 == 'beranda') ? '' : '<br/><br/><br/><br/><br/><br/><hr/>';?>
		<!--banner-->
		<?php echo view($contents); ?>
		<!-- footer -->
		<div class="footer">
			<div class="container">
				<div class="col-md-3 footer-left">
					<h3>More Info</h3>
					<li><a href="#">How to order</a></li>
					<li><a href="#">Faq</a></li>
					<li><a href="#">Locatio</a></li>
					<li><a href="#">Shipping</a></li>
					<li><a href="#">Membership</a></li>
				</div>
				<div class="col-md-3 footer-left">
					<h3>Contact Us</h3>
					<p>Perum Pabuaran Indah</p>
					<p>Blok D 03 No 09 Cibinong Kab. Bogor</p>
					<p>office : +62 812 8260 1381</p>
				</div>
				<div class="col-md-3 social">
					<h3>Follow Us</h3>
					<ul>
						<li><a href="#" class="facebook"> </a></li>
						<li><a href="#" class="p"> </a></li>
						<li><a href="#" class="twitter"> </a></li>
						<li><a href="#" class="goog"> </a></li>
					</ul>
				</div>
				<div class="col-md-3 footer-left">
					<h3>Newsletter</h3>
					<form>
						<input type="text" placeholder="Enter email id" required="">
					</form>
					<div class="button">
						<form>
							<input type="submit" value="Subscribe">
						</form>
					</div>
					<div class="clearfix"> </div>
					<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/596d42706edc1c10b03466c4/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
				</div>
				<div class="clearfix"></div>
				<div class="footer-bottom">
					<p>Copyrights © <?php echo date('Y');?> Music8. All rights reserved | Development by <a href="javascript:void(0);">Muhammad Naufal</a></p>
				</div>
			</div>
		</div>
		<!-- footer -->
	</body>
</html>