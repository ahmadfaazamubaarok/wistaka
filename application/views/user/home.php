<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

	<title>Wistaka | All you can visit</title>

	<!-- Bootstrap core CSS -->
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


	<!-- Additional CSS Files -->
	<link rel="stylesheet" href="<?= base_url('assets/user/')?>css/fontawesome.css">
	<link rel="stylesheet" href="<?= base_url('assets/user/')?>css/templatemo-tale-seo-agency.css">
	<link rel="stylesheet" href="<?= base_url('assets/user/')?>css/tampil.css">
	<link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
	<!-- link -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ6v7K6klzgh7kT1J4v0VfZOJ3BCsw2P0p/WeNf9aE/CqZV8l6Z1hG8U5g18" crossorigin="anonymous">
	<style>
		body {
			background-color: white;
		}
		.card-content h5 {
			font-size: 10px;
			font-weight: normal;
			margin-bottom: 6px;
			color: #333;
		}
		/*header*/
		.header {
			position: relative;
			width: 100%;
			height: 250px; /* Ukuran landscape */
			background: url('<?= base_url('assets/user/images/jogja.jpg') ?>') no-repeat center center/cover;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			text-align: center;
			color: white;
			padding: 15px;
		}

/* Kotak Pencarian */
.search-container {
	position: absolute;
	bottom: -25px; /* Setengah keluar dari header */
	background-color: #08332c;
	padding: 8px;
	border-radius: 20px;
	box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
	display: flex;
	align-items: center;
	width: 80%;
	max-width: 340px;
}

.search-container input {
	flex: 1;
	padding: 8px;
	border: 1px solid white;
	border-radius: 20px;
	outline: none;
	font-size: 14px;
	box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

.search-container button {
	background-color: #136235;
	color: white;
	padding: 8px 14px;
	border-radius: 20px;
	cursor: pointer;
	margin-left: 8px;
	font-weight: bold;
	font-size: 14px;
	transition: 0.3s;
	box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
}

.search-container button:hover {
	background-color: #005500;
	box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
}

/* Responsif untuk Desktop */
@media (min-width: 768px) {
	.header {
		height: 300px;
	}

	.header-content h1 {
		font-size: 2rem;
	}

	.header-content p {
		font-size: 1.2rem;
	}

	.search-container {
		max-width: 400px;
		bottom: -30px; /* Agar tetap proporsional di layar lebih besar */
	}
}
/*card*/
/* Background utama */
.slider-section {
	position: relative;
	padding: 20px 0;
}

.slider-overlay {

	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}

.container {
	position: relative;
	z-index: 2;
}

/* Container untuk kategori */
.category-container {
	display: grid;
	grid-template-columns: repeat(4, 1fr); /* Menampilkan 4 kolom */
	gap: 20px; /* Jarak antar kolom */
	margin-top: 20px;
}

/* Gaya untuk setiap kategori item tanpa kotak */
.category-item {
	text-align: center;
}

.category-item .icon img {
	width: 100%;
	max-width: 100px; /* Ukuran gambar lebih kecil */
	height: auto;
	margin-bottom: 10px;
}

.category-title {
	font-size: 16px;
	color: black;
}

/* Responsif untuk tampilan mobile */
@media (max-width: 576px) {
	.category-container {
		grid-template-columns: repeat(4, 1fr); /* Tetap tampil 4 gambar per baris di mobile */
	}

	.category-item .icon img {
		max-width: 55px; /* Ukuran gambar lebih kecil di mobile */
	}

	.category-title {
		font-size: 12px; /* Ukuran teks lebih kecil di mobile */
	}
}
/*nav*/
.custom-navbar {
	background-image: url('<?= base_url('assets/user/')?>images/bg.jpeg'); /* Ganti dengan path gambar yang sesuai */
	background-size: cover;
	background-position: center;
	background-repeat: no-repeat;
}
/*category*/
.category-link {
	text-decoration: none; /* Menghilangkan garis bawah */
	color: inherit; /* Menjaga warna tetap seperti aslinya */
	display: inline-block;
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
p {
	line-height: 1.2;
}
</style>
</head>
<body>
	<?php if ($this->session->flashdata('sukses_tambah_wisata')): ?>
	<div class="modal fade" tabindex="-1" id="sukses-tambah-wisata">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Modal title</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	      	<h3>Terimakasih sudah menambahkan wisata</h3>
	        <p>Silakan menunggu konfirmasi dari pihak admin untuk menampilkan wisata yang telah ditambahkan.</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
	<script>
	  document.addEventListener("DOMContentLoaded", function() {
	    var myModal = new bootstrap.Modal(document.getElementById('sukses-tambah-wisata'));
	    myModal.show();
	  });
	</script>
	<?php endif ?>
	<!-- ***** Header Area Start ***** -->
	<nav class="navbar navbar-dark custom-navbar">
		<div class="container-fluid">
			<a class="navbar-brand" href="<?= site_url('welcome') ?>">
				<img src="<?= base_url('assets/user/')?>images/logo.png" alt="Logo" height="40">
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
			aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="<?= site_url('welcome') ?>">Home</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
<header class="header">
	<div class="search-container">
		<input type="text" id="search-wisata" placeholder="Cari wisata atau kategori...">
		<button onclick="search()">Cari</button>
	</div>
</header>
<br><br>
	<div class="container">
		<div id="result-search-wisata" class="row justify-content-center"></div>
	</div>

<!-- ***** Header Area End ***** -->
<div class="services section" id="services">
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<br>
				<h2 style="color: black; font-size: 20px;">ALL YOU CAN VISIT</h2>
			</div>
			<div class="col-12">
				<div class="category-container">
					<!-- Kategori Wisata -->
					<?php foreach ($kategori as $key): ?>
					<a href="<?= site_url('welcome/kategori/'.$key->slug) ?>" class="category-link">
						<div class="category-item">
							<div class="icon rounded-circle">
								<img src="<?= base_url('uploads/ikon_kategori/'.$key->ikon_kategori) ?>" alt="Hutan">
							</div>
							<h4 class="category-title"><?= $key->nama_kategori ?></h4>
						</div>
					</a>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
</div>
<br>
<?php foreach ($unggulan as $u): ?>
<div class="slider-section" style="background: url('<?= base_url('uploads/background_unggulan/'.$u->background_unggulan)?>') no-repeat center center/cover">
	<div class="slider-overlay"></div>
	<div class="container">
		<div class="tengah">
			<h2 class="text-center" style="color: white; font-size: 15px;">DESTINASI WISATA <?= $u->nama_kategori ?></h2>
			<br>
		</div>
		<div class="owl-carousel card-slider">
			<?php $wisata = $this->wisata_model->get_wisata_by_kategori($u->id_kategori) ?>
			<?php foreach ($wisata as $key): ?>
			<a href="<?= site_url('welcome/wisata/').$key->slug ?>">
				<div class="item">
					<img src="<?= base_url('uploads/thumbnail_wisata/').$key->thumbnail_wisata ?>" alt="">
					<div class="card-content">
						<h4><?= $key->nama_wisata ?></h4>
						<?php echo (strlen($key->deskripsi_wisata) > 20) ? substr($key->deskripsi_wisata, 0, 20) . "..." : $key->deskripsi_wisata; ?>
					</div>
				</div>
			</a>
			<?php endforeach ?>
		</div>
	</div>
</div>
<br>
<div class="projects section" id="projects">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8"> <!-- Sesuaikan ukuran container -->
				<div class="section-heading text-center">
					<h5><em>Rekomendasi</em></h5>
					<br>
				</div>
				<div class="swiper mySwiper" style="max-width: 400px; height: 200px; margin: auto;">
					<div class="swiper-wrapper">
						<?php foreach ($iklan as $key): ?>
						<div class="swiper-slide">
							<img src="<?= base_url('uploads/iklan/'.$key->iklan) ?>" style="width: 100%; height: 100%; object-fit: cover;">
						</div>
						<?php endforeach ?>
					</div>
					<div class="swiper-pagination"></div>
				</div>
			</div>
		</div> 
	</div>
</div>
<br>
<?php endforeach ?>
<div class="slider-section">
	<div class="slider-overlay"></div>
	<div class="container">
		<div class="tengah">
			<h2 class="text-center">Artikel</h2>
			<br>
		</div>
		<div class="owl-carousel card-slider">
			<?php foreach ($artikel as $key): ?>
			<a href="<?= site_url('artikel/artikel_detail/').$key->slug ?>">
				<div class="item">
					<img src="<?= base_url('uploads/thumbnail_artikel/').$key->thumbnail_artikel ?>" alt="">
					<div class="card-content">
						<h4><?= $key->judul_artikel ?></h4>
					</div>
				</div>
			</a>
			<?php endforeach ?>
		</div>
	</div>
</div>
<br>
<br>
<br>
<div class="card m-3">
	<div class="card-body">
		<div class="row">
			<div class="col-lg-4">
				<img src="<?= base_url('assets/user/images/jogja.jpg') ?>" class="img-fluid rounded">
			</div>
			<div class="col-lg-8 d-flex align-items-center">
				<div>
					<h2>Tambahkan wisata baru</h2>
					<p>Isi formulir deskripsi wisata yang diusulkan kepada admin untuk ditampilkan</p>
					<a href="<?= site_url('wisata/daftar') ?>" class="btn btn-primary my-2 rounded-pill px-5 py-2">Tambahkan wisata</a>
				</div>
			</div>
		</div>
	</div>
</div>

<footer class="footer">
	<div class="social-icons">
		<a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
		<a href="https://tiktok.com" target="_blank"><i class="fab fa-tiktok"></i></a>
		<a href="https://twitter.com" target="_blank"><i class="fab fa-x-twitter"></i></a>
		<a href="mailto:example@email.com"><i class="fas fa-envelope"></i></a>
	</div>
	<div class="email">&copy; Wistaka Yogyakarta © 2025</div>
</footer>


<!-- Scripts -->
<!-- Bootstrap core JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="assets/js/tabs.js"></script>
<script src="assets/js/popup.js"></script>
<script src="assets/js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script>
	var swiper = new Swiper(".mySwiper", {
		slidesPerView: 1,
		spaceBetween: 10,
		loop: true,
		autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		},
		pagination: {
			el: ".swiper-pagination",
			clickable: true,
		},
	});
</script>
<!-- card -->
<script>
	$(document).ready(function(){
		$(".card-slider").owlCarousel({
			loop: true,
			margin: 5,
			nav: false,
			autoplay: true,
			autoplayTimeout: 2500,
			autoplayHoverPause: true,
			responsive: {
				0: { items: 3 }, /* 3 Card di layar kecil */
				480: { items: 3 }, /* Tetap 3 Card */
				768: { items: 4 }, /* 4 Card di tablet */
				1024: { items: 5 }  /* 5 Card di desktop */
			}
		});
	});
</script>
<!-- script untuk search -->
<script>
  $('#search-wisata').on('keyup', function () {
    var keyword = $(this).val();
    if (keyword.length >= 2) {
      $.ajax({
        url: "<?= site_url('wisata/search'); ?>",
        method: "POST",
        data: { search: keyword },
        success: function (response) {
          $('#result-search-wisata').html(response); // tampilkan HTML view
        }
      });
    } else {
      $('#result-search-wisata').html('');
    }
  });
</script>

</body>

</html>
