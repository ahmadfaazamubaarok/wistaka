<?php foreach ($wisata as $key): ?>
<?php 
if ($key->publish === 'false') {
    $class = 'danger';
    $key->publish = 'Belum Publish';
} elseif ($key->publish === 'true') {
    $class = 'success';
    $key->publish = 'Publish';
} 
?>
<div class="col-lg-4 col-6">
    <div class="card">
        <div class="card-body">
            <a href="<?= site_url('admin/wisata/wisata_edit/'.$key->id_wisata) ?>">
                <div style="width: 100%; height: 150px; overflow: hidden; border-radius: 8px;">
                    <img src="<?= base_url('uploads/thumbnail_wisata/'.$key->thumbnail_wisata) ?>" 
                         class="img-fluid w-100 h-100" 
                         style="object-fit: cover;">
                </div>
                <div class="d-flex justify-content-star mt-1">
                    <img src="<?= base_url('uploads/ikon_kategori/'.$key->ikon_kategori) ?>" 
                         style="border-radius: 20px; height: 40px; width: 40px; margin-right: 10px;">
                    <div>
                        <span class="fs-2"><?= $key->id_wisata ?></span>
                        <h5 class="mb-0"><?= $key->nama_wisata ?> </h5>
                        <p class="fs-2 py-0"><?= $key->nama_kategori ?></p>
                        <p class="badge bg-<?= $class ?>"><?= $key->publish ?><i class="ti ti-check"></i></p>
                    </div>
                </div>
            </a>
            <div class="p-2 text-end">
                <button class="btn btn-primary btn-add-galeri" data-id="<?= $key->id_wisata ?>">Galeri</button>
                <button class="btn btn-outline-danger btn-delete-wisata" data-id="<?= $key->id_wisata ?>">Hapus</button>
            </div>
        </div>
    </div>
</div>
<?php endforeach ?>