<?php $this->load->view('admin/template/head') ?>
<form action="<?= site_url('auth/login') ?>" method="POST">
	<input type="text" name="username" class="form-control" placeholder="Username" required>
	<input type="email" name="email" class="form-control" placeholder="Email" required>
	<input type="password" name="password" class="form-control" placeholder="Password" required>
	<button type="submit" class="btn btn-primary">Login</button>
</form>
<?php $this->load->view('admin/template/foot') ?>