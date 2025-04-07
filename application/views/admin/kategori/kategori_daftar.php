<?php foreach ($kategori as $key): ?>
<div class="col-lg-4">
	<div class="card kategori" data-id="<?= $key->id_kategori ?>">
		<div class="card-body">
			<div style="width: 100%; height: 150px; overflow: hidden; border-radius: 8px;">
			    <img src="<?= base_url('uploads/thumbnail_kategori/'.$key->thumbnail_kategori) ?>" 
			         class="img-fluid w-100 h-100" 
			         style="object-fit: cover;">
			</div>
			<div class="d-flex justify-content-start align-items-center mt-1">
				<img src="<?= base_url('uploads/ikon_kategori/'.$key->ikon_kategori) ?>" style="border-radius: 20px; height: 40px; width: 40px; margin-right: 10px;">
				<div class="d-flex justify-content-between align-items-center w-100">
					<div>
						<span class="fs-2"><?= $key->id_kategori ?></span>
						<h5><?= $key->nama_kategori ?></h5>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endforeach ?>