<?php $this->load->view('admin/template/head') ?>
<?php $this->load->view('admin/template/sidebar') ?>
<?php $this->load->view('admin/template/navbar') ?>
<h1 class="mb-3">Tambah Event</h1>
<form action="<?= site_url('admin/event/event_addsave') ?>" method="POST" enctype="multipart/form-data">
    <label for="judul_event">Nama event:</label>
    <input type="text" name="nama_event" class="form-control mb-3 bg-white" required>

    <label for="thumbnail_event">Thumbnail:</label>
    <input type="file" name="thumbnail_event" id="thumbnail_event" class="form-control mb-3 bg-white" accept="image/*"  required>

    <div class="row">
        <div class="col-md-6">
            <label for="waktu_mulai">Waktu mulai</label>
            <input type="date" name="waktu_mulai" id="waktu_mulai" class="form-control mb-3 bg-white">
        </div>
        <div class="col-md-6">
            <label for="waktu_selesai">Waktu selesai</label>
            <input type="date" name="waktu_selesai" id="waktu_selesai" class="form-control mb-3 bg-white">
        </div>
    </div>

    <label for="text">Event:</label>
    <textarea id="editor" required class="form-control mb-3 bg-white" name="text" id="text" style="min-height: 200px;"></textarea>

    <div class="d-flex justify-content-end mt-3">
        <button type="submit" class="btn btn-primary">Tambah</button>
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
        const fileInput = document.getElementById('thumbnail_event');
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