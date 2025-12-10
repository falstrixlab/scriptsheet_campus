<!--banner-->
<div class="about">
	<div class="container">
		<h3 style="text-align: center;">KELUHAN</h3>
			<div class="ab-top">
				<div class="col-md-6 ab-lft">
				<form action="<?php echo site_url('site/kanal/keluhan');?>" method="POST">
					<input type="text" class="form-control" placeholder="Email" name="email" required="required"><br/>	
					<input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" required="required"><br/>	
					<textarea name="isi" id="isi" class="form-control" placeholder="Isi Pesan" cols="30" rows="10"></textarea><br/>
					<input type="submit" class="btn btn-primary" name="kirim_keluhan" value="Kirim Keluhan">	
				</form>
				</div>
				<div class="col-md-6 ab-rgt">
					<h4>PERATURAN MENGISI KELUHAN</h4>
					<p>1. Pengisian Data Keluhan Tidak Diperkenankan Menggunakan Kalimat Kasar.</p>
					<p>2. Tidak Diperkenankan Menggunakan Kalimat Yang Mengandung Sara.</p>
					<p>3. Tidak Diperkenankan Menggunakan Kalimat Yang Mengejek.</p>
					<p>4. Tidak Diperkenankan Menggunakan Kalimat Yang Menyinggung Orang Lain.</p>
					<p><b>Note : Apabila Ada Yang Melanggar Akan di Tindak Lanjuti Oleh Pihak Internal Alto13.com</b></p>
				</div>
				<div class="clearfix"></div>
			</div>
	</div>
</div>