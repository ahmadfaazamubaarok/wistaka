<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Wisataka | Welcome</title>
	<link rel="icon" href="<?= base_url('assets/user/images/ikonlogo.png') ?>">
	
	<link rel="stylesheet" href="<?= base_url() ?>assets/admin/css/styles.min.css" />
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<style>
	    .btn-glow {
		    transition: all 0.5s ease-in-out;
		    box-shadow: 0 5px 25px 10px rgba(255, 255, 255, 0.1);
		}

		.btn-glow:hover {
		    transform: scale(1.080);
		    background-color: #5d87ff;
		    border: none;
		    box-shadow: 0 5px 35px 50px rgba(255, 255, 255, 0.009);
		}
	</style>
</head>
<body>
	<!-- <div class="vh-100 d-flex justify-content-center" style="background-image: url('<?= base_url('assets/user/images/bg.jpeg') ?>');"> -->
	<div class="vh-100 d-flex justify-content-center" style="background: linear-gradient(to bottom, #000000, #08332c);">
		<div class="d-flex justify-content-center flex-column text-center">
			<img src="<?= base_url('assets/user/images/logo.png') ?>" style="width: 200px;" data-aos="zoom-out" data-aos-delay="">
			<div data-aos="zoom-out">
				<img src="<?= base_url('assets/user/images/welcome.png') ?>" style="width: 200px;" data-aos-delay="100">
				<div data-aos-delay="200">
					<a href="<?= site_url('welcome/home') ?>" class="btn btn-warning rounded-pill py-2 btn-glow px-3 w-100">Monggo</a>
					<p class="text-white text-center mt-4">www.wistakatrip.com</p>
				</div>
			</div>
		</div>
	</div>
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script>
	  AOS.init();
	</script>
	<!-- Bootstrap JS -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>