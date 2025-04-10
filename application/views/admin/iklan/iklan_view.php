<?php $this->load->view('admin/template/head') ?>
<?php $this->load->view('admin/template/sidebar') ?>
<?php $this->load->view('admin/template/navbar') ?>
<div class="d-flex justify-content-between mb-3">
    <div data-aos="zoom-out" data-aos-delay="">
        <h2>Iklan</h2>
        <p>Kelola data iklan.</p>
    </div>
    <div data-aos="zoom-out" data-aos-delay="100">
        <button class="btn btn-primary btn-add-iklan"><i class="ti ti-plus"></i> Tambah iklan</button>
    </div>
</div>
<div id="daftar_iklan" class="row" data-aos="zoom-out" data-aos-delay="200"></div>
<!-- Modal -->
<div class="modal fade" id="modal_frame" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Iklan</h5>
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
    var daftar_iklan = $('#daftar_iklan');
    var pesan_loading = '<p class="text-center"><em>Work in progress...</em></p>';
    var frame = $('#modal_frame');

    daftar_iklan.html(pesan_loading);
    $.post('<?= site_url('admin/iklan/iklan_daftar') ?>', function(res){
        daftar_iklan.html(res);
    });

    // TAMBAH iklan
    $(document).on("click", ".btn-add-iklan", function(e){
        frame.find(".modal-title").html("Tambah iklan");
        frame.find(".modal-body").html(pesan_loading);
        frame.modal("show");
        $.post('<?= site_url('admin/iklan/iklan_add/') ?>', function(res){
            frame.find(".modal-body").html(res);
        });
    });

    $(document).on('submit', '#form-add-iklan', function (event) {
        event.preventDefault();

        let formData = new FormData(this); // Gunakan FormData untuk menangani file
        $.ajax({
            url: '<?= site_url('admin/iklan/iklan_addsave') ?>',
            type: 'POST',
            data: formData,
            processData: false,  // Mencegah jQuery memproses data
            contentType: false,  // Mencegah jQuery mengatur jenis konten
            dataType: 'json',    // Pastikan server mengembalikan JSON
            success: function (res) {
                if (res.status === 'success') {
                    $('#modal_frame').modal('hide');
                    toastr.success(res.message, 'Sukses');
                    $.post('<?= site_url('admin/iklan/iklan_daftar') ?>', function (res) {
                        $('#daftar_iklan').html(res); // Pastikan ID ini ada dalam DOM
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

    // DELETE iklan
    $(document).on("click", ".btn-delete-iklan", function (e) {
        e.preventDefault();
        let id_iklan = $(this).data("id");

        if (confirm("Apakah Anda yakin ingin menghapus iklan ini?")) {
            $.ajax({
                url: "<?= site_url('admin/iklan/iklan_delete') ?>",
                type: "POST",
                data: { id_iklan: id_iklan },
                dataType: "json",
                success: function (res) {
                    if (res.status === "success") {
                        $("#modal_frame").modal("hide");
                        toastr.success(res.message, "Sukses");

                        // Reload daftar iklan setelah sukses
                        $.post("<?= site_url('admin/iklan/iklan_daftar') ?>", function (res) {
                            $("#daftar_iklan").html(res);
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