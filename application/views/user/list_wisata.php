<?php if (!empty($wisata)): ?>
    <?php foreach ($wisata as $key): ?>
        <div class="col-4 col-md-3">
			<a href="<?= site_url('welcome/wisata/').$key->nama_wisata ?>">
	        	<div class="card">
	        		<img src="<?= base_url('uploads/thumbnail_wisata/').$key->thumbnail_wisata ?>" alt="<?= $key->nama_wisata ?>" class="card-img">
					<div class="card-content">
						<h4><?= $key->nama_wisata ?></h4>
						<p><?php echo (strlen($key->deskripsi_wisata) > 20) ? substr($key->deskripsi_wisata, 0, 20) . "..." : $key->deskripsi_wisata; ?></p>
					</div>
	        	</div>
	        </a>
        </div>
    <?php endforeach; ?>
<?php else: ?>
	<div class="w-100 text-center">
	    <p>Tidak ada hasil ditemukan.</p>
	</div>
<?php endif; ?>
