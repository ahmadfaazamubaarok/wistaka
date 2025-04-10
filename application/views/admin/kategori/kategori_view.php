<?php $this->load->view('admin/template/head') ?>
<?php $this->load->view('admin/template/sidebar') ?>
<?php $this->load->view('admin/template/navbar') ?>
<div class="d-flex justify-content-between mb-3">
    <div data-aos="zoom-out" data-aos-delay="">
        <h2>Kategori</h2>
        <p>Kelola data kategori.</p>
    </div>
    <div data-aos="zoom-out" data-aos-delay="100">
        <button class="btn btn-primary btn-add-kategori"><i class="ti ti-plus"></i> Tambah kategori</button>
    </div>
</div>
<div id="daftar_kategori" class="row" data-aos="zoom-out" data-aos-delay="200"></div>
<!-- Modal -->
<div class="modal fade" id="modal_frame" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function () {
    var daftar_kategori = $('#daftar_kategori');
    var pesan_loading = '<p class="text-center"><em>Work in progress...</em></p>';
    var frame = $('#modal_frame');

    daftar_kategori.html(pesan_loading);
    $.post('<?= site_url('admin/kategori/kategori_daftar') ?>', function(res){
        daftar_kategori.html(res);
    });

    // TAMBAH KATEGORI
    $(document).on("click", ".btn-add-kategori", function(e){
        frame.find(".modal-title").html("Tambah Kategori");
        frame.find(".modal-body").html(pesan_loading);
        frame.modal("show");
        $.post('<?= site_url('admin/kategori/kategori_add/') ?>', function(res){
            frame.find(".modal-body").html(res);
        });
    });

    $(document).on('submit', '#form-add-kategori', function (event) {
        event.preventDefault();

        let formData = new FormData(this); // Gunakan FormData untuk menangani file
        $.ajax({
            url: '<?= site_url('admin/kategori/kategori_addsave') ?>',
            type: 'POST',
            data: formData,
            processData: false,  // Mencegah jQuery memproses data
            contentType: false,  // Mencegah jQuery mengatur jenis konten
            dataType: 'json',    // Pastikan server mengembalikan JSON
            success: function (res) {
                if (res.status === 'success') {
                    $('#modal_frame').modal('hide');
                    toastr.success(res.message, 'Sukses');
                    $.post('<?= site_url('admin/kategori/kategori_daftar') ?>', function (res) {
                        $('#daftar_kategori').html(res); // Pastikan ID ini ada dalam DOM
                    });
                } else {
                    toastr.error(res.message, 'Gagal');
                }
            },
            error: function () {
                toastr.error('Gagal mengirim data', 'Gagal');
            }
        });
    });

    // EDIT KATEGORI
    $(document).on("click", ".kategori", function(e){
        let id_kategori = $(this).data("id");
        frame.find(".modal-title").html("Edit Kategori");
        frame.find(".modal-body").html(pesan_loading);
        frame.modal("show");
        $.post('<?= site_url('admin/kategori/kategori_edit/') ?>'+id_kategori, function(res){
            frame.find(".modal-body").html(res);
        });
    });

    $(document).on('submit', '#form-edit-kategori', function(event) {
        event.preventDefault();

        let formData = new FormData(this);
        $.ajax({
            url: '<?= site_url('admin/kategori/kategori_editsave') ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    $('#modal_frame').modal('hide');
                    toastr.success(res.message, 'Sukses');
                    $.post('<?= site_url('admin/kategori/kategori_daftar') ?>', function(res) {
                        $('#daftar_kategori').html(res);
                    });
                } else {
                    toastr.error(res.message, 'Gagal');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                toastr.error('Terjadi kesalahan: ' + error, 'Gagal');
            }
        });
    });

    // DELETE KATEGORI
    $(document).on("click", ".btn-delete-kategori", function (e) {
        e.preventDefault();
        let id_kategori = $(this).data("id");

        if (confirm("Apakah Anda yakin ingin menghapus kategori dan seluruh data wisata yang terkait?")) {
            $.ajax({
                url: "<?= site_url('admin/kategori/kategori_delete') ?>",
                type: "POST",
                data: { id_kategori: id_kategori },
                dataType: "json",
                success: function (res) {
                    if (res.status === "success") {
                        $("#modal_frame").modal("hide");
                        toastr.success(res.message, "Sukses");

                        // Reload daftar kategori setelah sukses
                        $.post("<?= site_url('admin/kategori/kategori_daftar') ?>", function (res) {
                            $("#daftar_kategori").html(res);
                        });
                    } else {
                        toastr.error(res.message, "Gagal");
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                    toastr.error("Terjadi kesalahan: " + error, "Gagal");
                }
            });
        }
    });
});
</script>
<?php $this->load->view('admin/template/foot') ?>