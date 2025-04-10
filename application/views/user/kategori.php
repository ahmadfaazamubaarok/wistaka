<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Wistaka | Kategori</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/user/')?>css.css">
	<style>
		.bg-dark {
			--bs-bg-opacity: 1;
			background-color: rgb(12 66 48) !important;
		}
		/*info*/
		.info{
			padding-left: 20px;
		}
		.custom-navbar {
			background-image: url('<?= base_url('assets/user/')?>images/bg.jpeg'); /* Ganti dengan path gambar yang sesuai */
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
		}
		/*header*/
		.header {
			position: relative;
			width: 100%;
			height: 170px; /* Ukuran landscape */
			background: url('<?= base_url('uploads/thumbnail_kategori/'.$kategori->thumbnail_kategori)?>') no-repeat center center/cover;
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
.scroll-container::-webkit-scrollbar {
	display: none;
}
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
p {
	line-height: 1.2;
}
</style>
</head>
<!-- ***** Header Area Start ***** -->
<nav class="navbar navbar-dark custom-navbar">
	<div class="container-fluid">
		<a class="navbar-brand" href="<?= site_url('welcome/home') ?>">
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
<!-- header -->
<header class="header">
	<div class="search-container">
		<input type="text" id="searchInput" placeholder="Cari sesuatu...">
		<button onclick="searchHref()">Cari</button>
	</div>
</header>
<!-- card -->
<!-- Daftar Wisata -->
<br>
<div class="p-4">
	<h4 class="text-center" style="font-family: sans-serif;"><strong><?= $kategori->nama_kategori ?></strong></h4>
	<div class="swiper-container">
		<div class="swiper-wrapper">
			<?php foreach ($wisata as $key): ?>
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
</div>

<!-- ***** Header Area End ***** -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
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
<script>
    function searchHref() {
        var input = document.getElementById("searchInput").value.toLowerCase();
        var slides = document.querySelectorAll(".swiper-slide");

        slides.forEach(function(slide) {
            var link = slide.querySelector("a");
            var href = link.getAttribute("href").toLowerCase();

            if (href.includes(input)) {
                slide.style.display = "block"; // Tampilkan jika cocok
            } else {
                slide.style.display = "none"; // Sembunyikan jika tidak cocok
            }
        });
    }

    // Tambahkan event listener untuk pencarian secara langsung saat mengetik
    document.getElementById("searchInput").addEventListener("input", searchHref);
</script>

</html>
