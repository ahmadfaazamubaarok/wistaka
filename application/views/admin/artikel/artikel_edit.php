<?php $this->load->view('admin/template/head') ?>
<?php $this->load->view('admin/template/sidebar') ?>
<?php $this->load->view('admin/template/navbar') ?>
<form action="<?= site_url('admin/artikel/artikel_editsave') ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_artikel" value="<?= htmlspecialchars($artikel->id_artikel, ENT_QUOTES, 'UTF-8'); ?>">
    <label for="judul_artikel">Nama artikel:</label>
    <input type="text" name="judul_artikel" class="form-control" required value="<?= htmlspecialchars($artikel->judul_artikel, ENT_QUOTES, 'UTF-8'); ?>">

    <label for="thumbnail_artikel">Thumbnail:</label>
    <input type="file" name="thumbnail_artikel" id="thumbnail_artikel" class="form-control">

    <label for="text">Artikel:</label>
    <textarea id="editor" required class="form-control" name="text" id="text" style="min-height: 200px;"><?= htmlspecialchars($artikel->teks, ENT_QUOTES, 'UTF-8'); ?></textarea>

    <button type="submit" name="draft" value="true" class="btn btn-secondary">Draft</button>
    <button type="submit" name="draft" value="false" class="btn btn-primary">Simpan</button>
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
<?php $this->load->view('admin/template/foot') ?>