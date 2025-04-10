<form id="form-add-kategori" method="POST" enctype="multipart/form-data">
    <label for="nama_kategori">Nama Kategori:</label>
    <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required>

    <label for="thumbnail_kategori">Thumbnail:</label>
    <input type="file" name="thumbnail_kategori" id="thumbnail_kategori" class="form-control" accept="image/*">

    <label for="ikon_kategori">Ikon:</label>
    <input type="file" name="ikon_kategori" id="ikon_kategori" class="form-control" accept="image/*">

    <div class="d-flex justify-content-end mt-3">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
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
<script>
    document.getElementById('form-add-kategori').addEventListener('submit', function (e) {
        const maxSize = 2 * 1024 * 1024; // 2MB
        const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

        const filesToCheck = [
            document.getElementById('thumbnail_kategori'),
            document.getElementById('ikon_kategori')
        ];

        for (let input of filesToCheck) {
            const file = input.files[0];
            if (file) {
                if (!validTypes.includes(file.type)) {
                    alert(`File pada "${input.name}" harus berupa gambar (jpg, png, gif, webp)!`);
                    e.preventDefault();
                    return;
                }

                if (file.size > maxSize) {
                    alert(`Ukuran file pada "${input.name}" maksimal 2 MB!`);
                    e.preventDefault();
                    return;
                }
            }
        }
    });
</script>

