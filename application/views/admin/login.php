<?php $this->load->view('admin/template/head') ?>
<div class="vh-100 d-flex">
    <!-- Kolom Kiri (Ilustrasi/Gambar) -->
    <div class="col-lg-8 d-none d-lg-block bg-image" style="background-position:center; background-image: url('<?= base_url('assets/user/images/jogja.jpg') ?>'); background-size: cover; height: 100vh;">
    </div>
    
    <!-- Kolom Kanan (Form Login) -->
    <div class="col-12 col-lg-4 d-flex justify-content-center align-items-center">
        <div class="w-75">
        	<div class="d-flex justify-content-center mb-3">
	        	<img style="width:150px" src="<?= base_url('assets/user/images/logogelap.png') ?>">
        	</div>
            <h3 class="text-center mb-4">Login Admin</h3>
            <form action="<?= site_url('auth/login') ?>" method="POST">
                <div class="mb-3">
                    <!-- Username with Floating Label -->
                    <div class="form-floating">
                        <input type="text" name="username" class="form-control bg-white" id="username" placeholder="Masukkan Username" required>
                        <label for="username">Username</label>
                    </div>
                </div>
                <div class="mb-3">
                    <!-- Email with Floating Label -->
                    <div class="form-floating">
                        <input type="text" name="email" class="form-control bg-white" id="email" placeholder="Masukkan email" required>
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="mb-3">
                    <!-- Password with Floating Label -->
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control bg-white" id="password" placeholder="Masukkan Password" required>
                        <label for="password">Password</label>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary rounded-pill">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('admin/template/foot') ?>
