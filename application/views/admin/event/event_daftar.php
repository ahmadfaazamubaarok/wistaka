<style type="text/css">
    .preview-teks p {
        line-height: 1.5;
        margin-bottom: 10px;
    }
</style>
<?php foreach ($event as $key): ?>
<?php 
if ($key->publish === 'false') {
    $class = 'danger';
    $key->publish = 'Belum Publish';
} elseif ($key->publish === 'true') {
    $class = 'success';
    $key->publish = 'Publish';
} 
?>
<div class="col-12 position-relative">
    <a href="<?= site_url('admin/event/event_edit/'.$key->id_event) ?>">
        <div class="card mb-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div style="width: 100%; height: 150px; overflow: hidden; border-radius: 8px;">
                            <img src="<?= base_url('uploads/thumbnail_event/'.$key->thumbnail_event) ?>" 
                                 class="img-fluid w-100 h-100" 
                                 style="object-fit: cover;">
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="mt-1">
                            <div class="w-100">
                                <div class="d-flex justify-content-start align-items-center">
                                    <div>
                                        <span class="fs-2"><?= $key->id_event ?></span>
                                        <h4><?= $key->nama_event ?></h4>
                                        <p>Periode <strong class="text-success"><?= $key->waktu_mulai ?></strong> hingga <strong class="text-danger"><?= $key->waktu_selesai ?></strong></p>
                                        <p class="badge bg-<?= $class ?>"><?= $key->publish ?><i class="ti ti-check"></i></p>
                                    </div>
                                </div>
                                <div class="preview-teks"><?= strip_tags(substr($key->teks, 0, 100)) . '...'; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
    
    <!-- Tombol Hapus di luar <a>, tetap dalam card -->
    <button class="btn btn-outline-danger btn-delete-event position-absolute" 
            data-id="<?= $key->id_event ?>" 
            style="top: 40px; right: 40px;">
        Hapus
    </button>
</div>
<?php endforeach ?>
