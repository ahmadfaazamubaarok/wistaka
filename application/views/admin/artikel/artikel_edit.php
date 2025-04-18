<?php $this->load->view('admin/template/head') ?>
<?php $this->load->view('admin/template/sidebar') ?>
<?php $this->load->view('admin/template/navbar') ?>
<h1 class="mb-3">Edit Artikel : <?= htmlspecialchars($artikel->judul_artikel, ENT_QUOTES, 'UTF-8'); ?></h1>
<form action="<?= site_url('admin/artikel/artikel_editsave') ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_artikel" value="<?= htmlspecialchars($artikel->id_artikel, ENT_QUOTES, 'UTF-8'); ?>">
    <label for="judul_artikel">Judul artikel:</label>
    <input type="text" name="judul_artikel" class="form-control  mb-3 bg-white" required value="<?= htmlspecialchars($artikel->judul_artikel, ENT_QUOTES, 'UTF-8'); ?>">

    <label for="thumbnail_artikel">Thumbnail:</label>
    <input type="file" name="thumbnail_artikel" id="thumbnail_artikel" class="form-control  mb-3 bg-white" accept="image/*" >

    <label for="text">Artikel:</label>
    <textarea id="editor" required class="form-control  mb-3 bg-white" name="text" id="text" style="min-height: 200px;"><?= htmlspecialchars($artikel->teks, ENT_QUOTES, 'UTF-8'); ?></textarea>

    <div class="d-flex justify-content-end mt-3">
        <button type="submit" name="draft" value="true" class="btn btn-secondary mx-3">Simpan Draft</button>
        <button type="submit" name="draft" value="false" class="btn btn-primary">Posting</button>
    </div>
</form>
<script>
    $(document).ready(function() {
        $('#editor').summernote({
            height: 300,  // Tinggi editor
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
    document.querySelector('form').addEventListener('submit', function (e) {
        const fileInput = document.getElementById('thumbnail_artikel');
        const file = fileInput.files[0];
        const maxSize = 2 * 1024 * 1024; // 2MB

        if (file) {
            const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

            if (!validTypes.includes(file.type)) {
                alert("File harus berupa gambar (jpg, png, gif, webp)!");
                e.preventDefault();
                return;
            }

            if (file.size > maxSize) {
                alert("Ukuran file maksimal 2 MB!");
                e.preventDefault();
            }
        }
    });
</script>

<?php $this->load->view('admin/template/foot') ?>