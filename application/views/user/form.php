<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

	<title>Wistaka | Tambah wisata</title>

	 <!-- Summernote CSS -->
  	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

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
<header class="header">
</header>
<!-- ***** Header Area End ***** -->
<br><br>
<div class="container">
    <h1 class="mb-3">Tambah Wisata</h1>
    <form action="<?= site_url('wisata/wisata_addsave') ?>" method="POST" enctype="multipart/form-data">
        <label>Kontak:</label>
        <input type="text" name="kontak" class="form-control bg-white" required>

        <label>Nama Wisata:</label>
        <input type="text" name="nama_wisata" class="form-control bg-white" required>

        <label for="thumbnail_wisata">Thumbnail:</label>
        <input type="file" name="thumbnail_wisata" id="thumbnail_wisata" class="form-control bg-white" required accept="image/*">
        <div class="invalid-feedback">
            File harus berupa gambar jpg/png/gif/webp dan maksimal 2 MB.
        </div>
        
        <label for="text">Deskripsi:</label>
        <textarea required class="form-control editor" name="deskripsi_wisata" id="text"></textarea>
        <div class="row">
            <div class="col-md-6">
                <label for="text">Jam Buka:</label>
                <textarea required class="form-control editor" name="jam_buka" id="text"></textarea>
            </div>
            <div class="col-md-6">
                <label for="text">Harga Masuk:</label>
                <textarea required class="form-control editor" name="harga_masuk" id="text"></textarea>
            </div>
            <div class="col-md-6">
                <label for="text">Parkir:</label>
                <textarea required class="form-control editor" name="parkir" id="text"></textarea>
            </div>
            <div class="col-md-6">
                <label for="text">Fasilitas:</label>
                <textarea required class="form-control editor" name="fasilitas" id="text"></textarea>
            </div>
        </div>
        <label for="text">Alamat:</label>
        <textarea required class="form-control bg-white" name="alamat" id="text"></textarea>
        <label for="map">Link Map:</label>
        <input type="text" name="map" class="form-control bg-white" required>
        <label for="kategori">Kategori Wisata:</label>
        <select name="kategori" class="form-control bg-white" required>
            <option value="" disabled selected>Pilih kategori</option>
            <?php foreach ($kategori as $key): ?>
            <option value="<?= $key->id_kategori ?>"><?= $key->nama_kategori ?></option>
            <?php endforeach ?>
        </select>
	    <label>Galeri foto</label>
	    <input class="form-control" name="galeri[]" type="file" id="imageInput" multiple accept="image/*">
	  	<div id="previewContainer" style="margin-top: 20px; display: flex; gap: 10px; flex-wrap: wrap;"></div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('.editor').summernote({
            height: 100,  // Tinggi editor
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('thumbnail_wisata');
    const maxSize = 2 * 1024 * 1024; // 2MB
    const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    fileInput.addEventListener('change', function () {
        const file = this.files[0];

        // Reset custom validity dan border setiap kali berubah
        this.setCustomValidity('');
        this.classList.remove('is-invalid');

        if (!file) return;

        if (!validTypes.includes(file.type)) {
            alert("File harus berupa gambar (jpg, png, gif, webp)!");
            this.setCustomValidity('File tidak valid.');
            this.classList.add('is-invalid');
        } else if (file.size > maxSize) {
            alert("Ukuran file maksimal 2 MB!");
            this.setCustomValidity('Ukuran terlalu besar.');
            this.classList.add('is-invalid');
        }
    });

    // Tambahan: validasi ulang saat submit untuk jaga-jaga
    document.querySelector('form').addEventListener('submit', function (e) {
        const file = fileInput.files[0];
        if (!file || fileInput.validationMessage !== '') {
            e.preventDefault();
            alert("Periksa kembali file thumbnail sebelum mengirim.");
        }
    });
});
</script>
<script>
  const input = document.getElementById('imageInput');
  const preview = document.getElementById('previewContainer');

  input.addEventListener('change', function () {
    preview.innerHTML = ''; // Kosongkan preview dulu

    const files = Array.from(this.files);

    files.forEach(file => {
      if (!file.type.startsWith('image/')) return;

      const reader = new FileReader();
      reader.onload = function (e) {
        const img = document.createElement('img');
        img.src = e.target.result;
        img.style.maxWidth = '120px';
        img.style.maxHeight = '120px';
        img.style.border = '1px solid #ccc';
        img.style.borderRadius = '8px';
        img.style.objectFit = 'cover';
        preview.appendChild(img);
      };

      reader.readAsDataURL(file);
    });
  });
</script>
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
<!-- Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</body>

</html>
