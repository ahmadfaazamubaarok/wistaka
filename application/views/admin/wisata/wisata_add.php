<?php $this->load->view('admin/template/head') ?>
<?php $this->load->view('admin/template/sidebar') ?>
<?php $this->load->view('admin/template/navbar') ?>
<div class="container">
    <h1 class="mb-3">Tambah Wisata</h1>
    <form action="<?= site_url('admin/wisata/wisata_addsave') ?>" method="POST" enctype="multipart/form-data">
        <label>Kontak:</label>
        <input type="text" name="kontak" class="form-control bg-white" required>

        <label>Nama Wisata:</label>
        <input type="text" name="nama_wisata" class="form-control bg-white" required>

        <label for="thumbnail_wisata">Thumbnail:</label>
        <input type="file" name="thumbnail_wisata" id="thumbnail_wisata" class="form-control bg-white" required accept="image/*">
        <div class="invalid-feedback">
            File harus berupa gambar jpg/png/gif/webp dan maksimal 2 MB.
        </div>
        
        <label for="text">Deskripsi:</label>
        <textarea required class="form-control editor" name="deskripsi_wisata" id="text"></textarea>
        <div class="row">
            <div class="col-md-6">
                <label for="text">Jam Buka:</label>
                <textarea required class="form-control editor" name="jam_buka" id="text"></textarea>
            </div>
            <div class="col-md-6">
                <label for="text">Harga Masuk:</label>
                <textarea required class="form-control editor" name="harga_masuk" id="text"></textarea>
            </div>
            <div class="col-md-6">
                <label for="text">Parkir:</label>
                <textarea required class="form-control editor" name="parkir" id="text"></textarea>
            </div>
            <div class="col-md-6">
                <label for="text">Fasilitas:</label>
                <textarea required class="form-control editor" name="fasilitas" id="text"></textarea>
            </div>
        </div>
        <label for="text">Alamat:</label>
        <textarea required class="form-control bg-white" name="alamat" id="text"></textarea>
        <label for="map">Link Map:</label>
        <input type="text" name="map" class="form-control bg-white" required>
        <label for="kategori">Kategori Wisata:</label>
        <select name="kategori" class="form-control bg-white" required>
            <option value="" disabled selected>Pilih kategori</option>
            <?php foreach ($kategori as $key): ?>
            <option value="<?= $key->id_kategori ?>"><?= $key->nama_kategori ?></option>
            <?php endforeach ?>
        </select>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </div>
    </form>
</div>
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