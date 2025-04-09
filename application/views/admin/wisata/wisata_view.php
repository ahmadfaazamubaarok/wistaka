<?php $this->load->view('admin/template/head') ?>
<?php $this->load->view('admin/template/sidebar') ?>
<?php $this->load->view('admin/template/navbar') ?>
<style type="text/css">
    a {
    color: inherit; /* Menggunakan warna teks bawaan */
    text-decoration: none; /* Menghapus garis bawah */
    }

    a:hover {
        color: inherit; /* Warna tetap sama saat hover */
    }
</style>
<div class="d-flex justify-content-between mb-3">
    <div data-aos="zoom-out" data-aos-delay="">
        <h2>Wisata</h2>
        <p>Kelola data wisata.</p>
    </div>
    <div data-aos="zoom-out" data-aos-delay="100">
        <a href="<?= site_url('admin/wisata/wisata_add') ?>" type="button" class="btn btn-primary"><i class="ti ti-plus"></i> Tambah wisata</a>
    </div>
</div>
<div class="row" id="daftar_wisata" data-aos="zoom-out" data-aos-delay="200"></div>
<!-- Modal -->
<div class="modal fade" id="modal_frame" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Wisata</h5>
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
    var daftar_wisata = $('#daftar_wisata');
    var pesan_loading = '<p class="text-center"><em>Work in progress...</em></p>';
    var frame = $('#modal_frame');

    daftar_wisata.html(pesan_loading);
    $.post('<?= site_url('admin/wisata/wisata_daftar') ?>', function(res){
        daftar_wisata.html(res);
    });

    // DELETE WISATA
    $(document).on("click", ".btn-delete-wisata", function (e) {
        e.preventDefault();
        let id_wisata = $(this).data("id");

        if (confirm("Apakah Anda yakin ingin menghapus wisata ini?")) {
            $.ajax({
                url: "<?= site_url('admin/wisata/wisata_delete') ?>",
                type: "POST",
                data: { id_wisata: id_wisata },
                dataType: "json",
                success: function (res) {
                    if (res.status === "success") {
                        $("#modal_frame").modal("hide");
                        toastr.success(res.message, "Sukses");

                        // Reload daftar wisata setelah sukses
                        $.post("<?= site_url('admin/wisata/wisata_daftar') ?>", function (res) {
                            $("#daftar_wisata").html(res);
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

    // TAMBAH GALERI
    $(document).on("click", ".btn-add-galeri", function(e){
        let id_wisata = $(this).data("id");
        frame.find(".modal-title").html("Tambah galeri");
        frame.find(".modal-body").html(pesan_loading);
        frame.modal("show");
        $.post('<?= site_url('admin/galeri/galeri_add/') ?>'+id_wisata, function(res){
            frame.find(".modal-body").html(res);
        });
    });

    $(document).on('submit', '#form-add-galeri', function (event) {
        event.preventDefault();

        let formData = new FormData(this); // Gunakan FormData untuk menangani file
        $.ajax({
            url: '<?= site_url('admin/galeri/galeri_addsave') ?>',
            type: 'POST',
            data: formData,
            processData: false,  // Mencegah jQuery memproses data
            contentType: false,  // Mencegah jQuery mengatur jenis konten
            dataType: 'json',    // Pastikan server mengembalikan JSON
            success: function (res) {
                if (res.status === 'success') {
                    $('#modal_frame').modal('hide');
                    toastr.success(res.message, 'Sukses');
                } else {
                    toastr.error(res.message, 'Gagal');
                }
            },
            error: function () {
                toastr.error('Gagal mengirim data', 'Gagal');
            }
        });
    });

    // DELETE GALERI
    $(document).on("click", ".btn-delete-galeri", function (e) {
        e.preventDefault();
        let id_galeri = $(this).data("id");

        if (confirm("Apakah Anda yakin ingin menghapus galeri ini?")) {
            $.ajax({
                url: "<?= site_url('admin/galeri/galeri_delete') ?>",
                type: "POST",
                data: { id_galeri: id_galeri },
                dataType: "json",
                success: function (res) {
                    if (res.status === "success") {
                        toastr.success(res.message, "Sukses");
                        $(".galeri-item-" + id_galeri).remove(); // Hapus elemen dari DOM
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