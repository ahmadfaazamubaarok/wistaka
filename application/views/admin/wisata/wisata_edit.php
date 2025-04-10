<?php $this->load->view('admin/template/head') ?>
<?php $this->load->view('admin/template/sidebar') ?>
<?php $this->load->view('admin/template/navbar') ?>
<h1 class="mb-3">Edit Wisata : <?= htmlspecialchars($wisata->nama_wisata, ENT_QUOTES, 'UTF-8'); ?></h1>
<form action="<?= site_url('admin/wisata/wisata_editsave') ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_wisata" value="<?= htmlspecialchars($wisata->id_wisata, ENT_QUOTES, 'UTF-8'); ?>">
    <label for="judul_wisata">Kontak:</label>
    <input type="text" name="kontak" class="form-control bg-white" required value="<?= htmlspecialchars($wisata->kontak, ENT_QUOTES, 'UTF-8'); ?>">

    <label for="judul_wisata">Nama Wisata:</label>
    <input type="text" name="nama_wisata" class="form-control bg-white" required value="<?= htmlspecialchars($wisata->nama_wisata, ENT_QUOTES, 'UTF-8'); ?>">

    <label for="thumbnail_wisata">Thumbnail:</label>
    <input type="file" name="thumbnail_wisata" id="thumbnail_wisata" class="form-control bg-white" accept="image/*">

    <label for="text">Deskripsi:</label>
    <textarea required class="form-control editor" name="deskripsi_wisata" id="text"><?= htmlspecialchars($wisata->deskripsi_wisata, ENT_QUOTES, 'UTF-8'); ?></textarea>
    <div class="row">
        <div class="col-md-6">
            <label for="text">Jam Buka:</label>
            <textarea required class="form-control editor" name="jam_buka" id="text"><?= htmlspecialchars($wisata->jam_buka, ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>
        <div class="col-md-6">
            <label for="text">Harga Masuk:</label>
            <textarea required class="form-control editor" name="harga_masuk" id="text"><?= htmlspecialchars($wisata->harga_masuk, ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>
        <div class="col-md-6">
            <label for="text">Parkir:</label>
            <textarea required class="form-control editor" name="parkir" id="text"><?= htmlspecialchars($wisata->parkir, ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>
        <div class="col-md-6">
            <label for="text">Fasilitas:</label>
            <textarea required class="form-control editor" name="fasilitas" id="text"><?= htmlspecialchars($wisata->fasilitas, ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>
    </div>
    <label for="text">Alamat:</label>
    <textarea required class="form-control bg-white" name="alamat" id="text"><?= htmlspecialchars($wisata->alamat, ENT_QUOTES, 'UTF-8'); ?></textarea>
    <label for="map">Link Map:</label>
    <input type="text" name="map" class="form-control bg-white" required value="<?= htmlspecialchars($wisata->map, ENT_QUOTES, 'UTF-8'); ?>">
    <label for="kategori">Kategori Wisata:</label>
    <select name="kategori" class="form-control bg-white" required>
        <option value="" disabled selected>Pilih kategori</option>
        <?php foreach ($kategori as $key): ?>
        <option value="<?= $key->id_kategori ?>" <?= ($key->id_kategori == $wisata->kategori) ? 'selected' : '' ?>>
            <?= $key->nama_kategori ?>
        </option>
        <?php endforeach ?>
    </select>
    <label>
        <input type="checkbox" name="publish" value="true" <?= ($wisata->publish == 'true') ? 'checked' : '' ?>> Publish
    </label>
    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
</form>
<script>
    $(document).ready(function() {
        $('.editor').summernote({
            height: 100,  // Tinggi editor
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('thumbnail_wisata');
    const maxSize = 2 * 1024 * 1024; // 2MB
    const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    fileInput.addEventListener('change', function () {
        const file = this.files[0];

        // Reset custom validity dan border setiap kali berubah
        this.setCustomValidity('');
        this.classList.remove('is-invalid');

        if (!file) return;

        if (!validTypes.includes(file.type)) {
            alert("File harus berupa gambar (jpg, png, gif, webp)!");
            this.setCustomValidity('File tidak valid.');
            this.classList.add('is-invalid');
        } else if (file.size > maxSize) {
            alert("Ukuran file maksimal 2 MB!");
            this.setCustomValidity('Ukuran terlalu besar.');
            this.classList.add('is-invalid');
        }
    });

    // Tambahan: validasi ulang saat submit untuk jaga-jaga
    document.querySelector('form').addEventListener('submit', function (e) {
        const file = fileInput.files[0];
        if (!file || fileInput.validationMessage !== '') {
            e.preventDefault();
            alert("Periksa kembali file thumbnail sebelum mengirim.");
        }
    });
});
</script>
<?php $this->load->view('admin/template/foot') ?>