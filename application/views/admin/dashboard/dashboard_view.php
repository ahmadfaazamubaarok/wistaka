<?php $this->load->view('admin/template/head') ?>
<?php $this->load->view('admin/template/sidebar') ?>
<?php $this->load->view('admin/template/navbar') ?>
<div class="card rounded" data-aos="zoom-out" data-aos-delay="" style="height: 30vh; background-size: cover; background-image: url('<?= base_url('assets/user/images/jogja.jpg') ?>');">
	<div class="card-body">
		<h1 class="text-white mt-3 fw-bolder mb-0">Selamat datang <?= $this->session->userdata('admin')->username ?>!</h1>
		<p class="text-white mt-3 fw-bolder mb-0">Anda login sebagai <?= $this->session->userdata('admin')->role ?>, Kelola data website Wistaka</p>
	</div>
</div>
<div class="row mt-3">
	<div class="col-6 col-md-3" data-aos="zoom-out" data-aos-delay="100">
		<a href="<?= site_url('admin/wisata') ?>">
			<div class="alert alert-primary">
				<span class="fs-6 fw-bolder"><i class="ti ti-map-pin"></i><?= $total_wisata ?></span>
				<span class="fs-6 mx-2">| Wisata</span>
			</div>
		</a>
	</div>
	<div class="col-6 col-md-3" data-aos="zoom-out" data-aos-delay="200">
		<a href="<?= site_url('admin/artikel') ?>">
			<div class="alert alert-success">
				<span class="fs-6 fw-bolder"><i class="ti ti-article"></i><?= $total_artikel ?></span>
				<span class="fs-6 mx-2">| Artikel</span>
			</div>
		</a>
	</div>
	<div class="col-6 col-md-3" data-aos="zoom-out" data-aos-delay="300">
		<a href="<?= site_url('admin/kategori') ?>">
			<div class="alert alert-warning">
				<span class="fs-6 fw-bolder"><i class="ti ti-list"></i><?= $total_kategori ?></span>
				<span class="fs-6 mx-2">| Kategori</span>
			</div>
		</a>
	</div>
	<div class="col-6 col-md-3" data-aos="zoom-out" data-aos-delay="400">
		<a href="<?= site_url('admin/iklan') ?>">
			<div class="alert alert-danger">
				<span class="fs-6 fw-bolder"><i class="ti ti-star"></i><?= $total_iklan ?></span>
				<span class="fs-6 mx-2">| Iklan</span>
			</div>
		</a>
	</div>
</div>
<?php $this->load->view('admin/template/foot') ?>