<?php foreach ($iklan as $key): ?>
<div class="col-lg-4">
	<div class="card iklan" data-id="<?= $key->id_iklan ?>">
		<div class="card-body">
			<div style="width: 100%; height: 150px; overflow: hidden; border-radius: 8px;">
			    <img src="<?= base_url('uploads/iklan/'.$key->iklan) ?>" 
			         class="img-fluid w-100 h-100" 
			         style="object-fit: cover;">
			</div>
			<div class="d-flex justify-content-between align-items-center mt-1">
				<span class="fs-2"><?= $key->id_iklan ?></span>
				<button class="btn btn-outline-danger btn-delete-iklan" data-id="<?= $key->id_iklan ?>">Hapus</button>
			</div>
		</div>
	</div>
</div>
<?php endforeach ?>