<div class="row">
<?php foreach ($galeri as $key): ?>
    <div class="col-md-4">
        <div class="position-relative d-inline-block galeri-item-<?= $key->id_galeri ?>" style="width: 100%; height: 150px; overflow: hidden; border-radius: 8px;">
            <button class="btn-close position-absolute top-0 end-0 m-2 btn-delete-galeri" data-id="<?= $key->id_galeri ?>"></button>
            <img class="img-fluid" style="border-radius: 20px; object-fit: cover;" src="<?= base_url('uploads/galeri/').$key->galeri ?>">
        </div>
    </div>
<?php endforeach ?>
</div>
<form id="form-add-galeri" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_wisata" value="<?= $id_wisata ?>">
    <div id="previewContainer" style="margin-top: 20px; display: flex; gap: 10px; flex-wrap: wrap;"></div>
    <label for="galeri">Gambar galeri:</label>
    <input type="file" id="imageInput" name="galeri[]"class="form-control" multiple accept="image/*">
    <div class="d-flex justify-content-end mt-3">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
