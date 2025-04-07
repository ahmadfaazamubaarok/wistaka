<?php foreach ($artikel as $key): ?>
<?php 
if ($key->draft === 'false') {
    $class = 'success';
    $key->draft = 'Posting';
} elseif ($key->draft === 'true') {
    $class = 'danger';
    $key->draft = 'Draft';
} 
?>
<div class="col-12 position-relative">
    <a href="<?= site_url('admin/artikel/artikel_edit/'.$key->id_artikel) ?>">
        <div class="card mb-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div style="width: 100%; height: 150px; overflow: hidden; border-radius: 8px;">
                            <img src="<?= base_url('uploads/thumbnail_artikel/'.$key->thumbnail_artikel) ?>" 
                                 class="img-fluid w-100 h-100" 
                                 style="object-fit: cover;">
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="mt-1">
                            <div class="w-100">
                                <div class="d-flex justify-content-start align-items-center">
		                            <img src="<?= base_url('assets/images/default.jpg') ?>" 
	                                 style="border-radius: 20px; height: 40px; width: 40px; margin-right: 10px;">
                                    <div>
                                        <span class="fs-2"><?= $key->id_artikel ?></span>
                                        <h4><?= $key->judul_artikel ?></h4>
                                        <div class="badge bg-<?= $class ?>"><?= $key->draft ?></div>
                                    </div>
                                </div>
                                <p class="text mt-2"><?= mb_strimwidth($key->teks, 0, 100, '...') ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
    
    <!-- Tombol Hapus di luar <a>, tetap dalam card -->
    <button class="btn btn-outline-danger btn-delete-artikel position-absolute" 
            data-id="<?= $key->id_artikel ?>" 
            style="top: 40px; right: 40px;">
        Hapus
    </button>
</div>
<?php endforeach ?>
