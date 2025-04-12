 <!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Wistaka | <?= $wisata->nama_wisata ?></title>
	<link rel="icon" href="<?= base_url('assets/user/images/ikonlogo.png') ?>">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/user/css/css.css') ?>">
	<style>
		.bg-dark {
			--bs-bg-opacity: 1;
			background-color: rgb(12 66 48) !important;
		}
		/*crad*/
		.swiper-container {
			width: 100%;
			padding: 20px 0;
		}
		.swiper-slide {
			background: #fff;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
			border-radius: 10px;
			overflow: hidden;
			text-align: center;
			transition: transform 0.3s;
			cursor: pointer;
			border: 2px solid #ddd;
		}
		.swiper-slide:hover {
			transform: scale(1.05);
			border-color: green;
		}
		.swiper-slide img {
			width: 100%;
			height: 130px;
			object-fit: cover;
		}
		.swiper-slide .content {
			padding: 15px;
		}
		.swiper-slide h2 {
			font-size: 18px;
			margin: 10px 0;
			color: #333;
		}
		.swiper-slide p {
			font-size: 14px;
			color: #666;
		}
		.content h4{
			font-size: 16px;
			font-weight: bold;
			margin-bottom: 6px;
			color: #333;
		}
		.content p{
			font-size: 10px;
			font-weight: bold;
			margin-bottom: 6px;
			color: #333;
		}
		/*map*/
		.map-box {
			display: flex;
			align-items: center;
			background: #fff;
			padding: 10px;
			border-radius: 10px;
			box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
			width: fit-content;
			max-width: 500px;
			font-family: Arial, sans-serif;
			transition: transform 0.2s ease-in-out;
		}

		.map-box:hover {
			transform: scale(1.05);
		}

		.map-icon {
			width: 50px;
			height: 50px;
			margin-right: 10px;
		}

		.map-content {
			display: flex;
			flex-direction: column;
		}

		.map-title {
			font-size: 16px;
			font-weight: bold;
			color: #333;
		}

		.map-address {
			font-size: 12px;
			color: #666;
		}

		.map-link {
			margin-top: 5px;
			font-size: 12px;
			color: #007bff;
			text-decoration: none;
			font-weight: bold;
		}

		.map-link:hover {
			text-decoration: underline;
		}
		/*jajal*/
		.container {
			text-align: center;
		}

		.thumbnail img {
			width: 100%;
			max-width: 600px; /* Ukuran maksimum thumbnail */
			height: 300px; /* Tinggi tetap */
			object-fit: cover;
			border-radius: 10px;
		}

		.galeri {
			display: flex;
			gap: 10px;
			justify-content: center;
			flex-wrap: wrap;
			margin-top: 10px;
		}

		.galeri .card {
			width: 150px; /* Ukuran tetap untuk semua */
			height: 150px;
			overflow: hidden;
			border-radius: 10px;
		}

		.galeri .card img {
			width: 100%;
			height: 100%;
			object-fit: cover; /* Menyesuaikan gambar */
		}

		.popup-content {
			text-align: center;
		}

		.popup-images img {
			width: 100%;
			max-width: 500px; /* Ukuran popup */
			height: 300px;
			object-fit: cover;
			margin: 5px;
			border-radius: 10px;
		}
		/*footer*/
		.footer {
			background: #222;
			color: white;
			text-align: center;
			padding: 20px 0;
			position: relative;
			bottom: 0;
			width: 100%;
		}

		.social-icons {
			display: flex;
			justify-content: center;
			gap: 15px;
			padding: 10px 0;
		}

		.social-icons a {
			color: white;
			font-size: 24px;
			text-decoration: none;
			transition: transform 0.3s;
		}

		.social-icons a:hover {
			transform: scale(1.2);
		}

		.email {
			margin-top: 10px;
			font-size: 14px;
		}

		@media (max-width: 600px) {
			.social-icons a {
				font-size: 20px;
			}
		}
		/*info*/
		.info{
			padding-left: 20px;
		}
		p {
			line-height: 1.2;
		}
	</style>
</head>
<!-- ***** Header Area Start ***** -->
<nav class="navbar navbar-dark bg-dark ">
	<div class="container-fluid">
		<a class="navbar-brand" href="<?= site_url('welcome/home') ?>">
			<img src="<?= base_url('assets/user/')?>images/logo.png" alt="Logo" height="40">
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="<?= site_url('welcome/home') ?>">Home</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
<!-- ***** Header Area End ***** -->
<body>
	<div class="container">
		<div class="thumbnail">
			<img src="<?= base_url('uploads/thumbnail_wisata/'.$wisata->thumbnail_wisata) ?>" alt="Thumbnail Wisata">
		</div>
		<div class="judul"> <i class="fas fa-map-marker-alt icon"></i><?= $wisata->nama_wisata ?></div>

		<div class="container">
			<div class="galeri slider">
				<?php foreach ($galeri as $key): ?>
				<div class="card"><img src="<?= base_url('uploads/galeri/'.$key->galeri) ?>"></div>
				<?php endforeach ?>
			</div>
			<div class="lihat-semua">Lihat Semua</div>
		</div>

		<div class="popup" id="popup">
			<div class="popup-content">
				<span class="close">&times;</span>
				<div class="popup-images">
					<?php foreach ($galeri as $key): ?>
					<img src="<?= base_url('uploads/galeri/'.$key->galeri) ?>">
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
	<br>
	<!-- map -->
	<div class="map-box">
		<img src="<?= base_url('assets/user/images/map.png') ?>" alt="Map Icon" class="map-icon">
		<div class="map-content">
			<span class="map-title"><?= $wisata->nama_wisata ?></span>
			<span class="map-address"><?= $wisata->alamat ?></span>
			<a href="<?= $wisata->map ?>" 
			target="_blank" class="map-link">Buka Maps</a>
		</div>
	</div>

	<div class="info"><strong><i class="fas fa-align-left icon"></i> Deskripsi:</strong>
		<p>Deskripsi singkat:
			<?= $wisata->deskripsi_wisata ?>
		</p></div>
		<div class="info"><strong><i class="far fa-clock icon"></i> Jam Buka:</strong>
			<?= $wisata->jam_buka ?>
		</div>
		<div class="info"><strong><i class="fas fa-ticket-alt icon"></i> Harga Masuk:</strong>
			<?= $wisata->harga_masuk ?>
		</div>
		<div class="info"><strong><i class="fas fa-parking icon"></i> Parkir Kendaraan:</strong>
			<?= $wisata->parkir ?>
		</div>
		<div class="info"><strong><i class="fas fa-concierge-bell icon"></i> Fasilitas:</strong>
			<?= $wisata->fasilitas ?>
		</div>

		
		<!-- crad -->
		<br>
		<div class="section-heading">
			<h5 class="text-center" style="font-weight: bold;"><em>Rekomendasi wisata yang serupa</em></h5>
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php foreach ($wisata_serupa as $key): ?>
					<div class="swiper-slide">
						<a href="<?= site_url('welcome/wisata/'.$key->slug) ?>">
							<img src="<?= base_url('uploads/thumbnail_wisata/'.$key->thumbnail_wisata) ?>" alt="">
							<div class="content">
								<h4><?= $key->nama_wisata ?></h4>
								<p><?php echo (strlen($key->deskripsi_wisata) > 20) ? substr($key->deskripsi_wisata, 0, 20) . "..." : $key->deskripsi_wisata; ?></p>
							</div>
						</a>
					</div>
					<?php endforeach ?>
				</div>
			</div>
			<!-- footer -->
			<footer class="footer">
				<div class="social-icons">
					<a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
					<a href="https://tiktok.com" target="_blank"><i class="fab fa-tiktok"></i></a>
					<a href="https://twitter.com" target="_blank"><i class="fab fa-x-twitter"></i></a>
					<a href="mailto:example@email.com"><i class="fas fa-envelope"></i></a>
				</div>
				<div class="email">&copy; Wistaka Yogyakarta © 2025</div>
			</footer>

			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
			<script>
				$(document).ready(function(){
					$('.slider').slick({
						slidesToShow: 2,
						slidesToScroll: 1,
						autoplay: true,
						autoplaySpeed: 2000,
						arrows: false,
						responsive: [
						{
							breakpoint: 768,
							settings: {
								slidesToShow: 2
							}
						}
						]
					});

					$('.lihat-semua').click(function() {
						$('#popup').fadeIn();
					});

					$('.close').click(function() {
						$('#popup').fadeOut();
					});
				});
			</script>
			<!-- crad -->
			<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
			<script>
				var swiper = new Swiper('.swiper-container', {
					slidesPerView: 3,
					spaceBetween: 10,
					loop: true,
					autoplay: {
						delay: 3000,
						disableOnInteraction: false,
					},
				});
			</script>
			</html>
