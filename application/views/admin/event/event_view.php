<?php $this->load->view('admin/template/head') ?>
<style type="text/css">
    a {
    color: inherit; /* Menggunakan warna teks bawaan */
    text-decoration: none; /* Menghapus garis bawah */
    }

    a:hover {
        color: inherit; /* Warna tetap sama saat hover */
    }
    p {
        line-height: 1.2;
    }
</style>
<?php $this->load->view('admin/template/sidebar') ?>
<?php $this->load->view('admin/template/navbar') ?>
<?php if ($this->session->flashdata('sukses')): ?>
    <div class="alert alert-success">
        <p><?= $this->session->flashdata('sukses') ?></p>
    </div>
<?php elseif($this->session->flashdata('gagal')): ?>
    <div class="alert alert-danger">
        <p><?= $this->session->flashdata('gagal') ?></p>
    </div>
<?php endif ?>
<div class="d-flex justify-content-between mb-3">
    <div data-aos="zoom-out" data-aos-delay="">
        <h2>Event</h2>
        <p>Kelola data event.</p>
    </div>
    <div data-aos="zoom-out" data-aos-delay="100">
    	<a href="<?= site_url('admin/event/event_add') ?>" type="button" class="btn btn-primary"><i class="ti ti-plus"></i> Tambah event</a>
    </div>
</div>
<div id="daftar_event" class="row" data-aos="zoom-out" data-aos-delay="200"></div>
<script type="text/javascript">
$(document).ready(function () {
    var daftar_event = $('#daftar_event');
    var pesan_loading = '<p class="text-center"><em>Work in progress...</em></p>';
    var frame = $('#modal_frame');

    daftar_event.html(pesan_loading);
    $.post('<?= site_url('admin/event/event_daftar') ?>', function(res){
        daftar_event.html(res);
    });

    // DELETE event
    $(document).on("click", ".btn-delete-event", function (e) {
        e.preventDefault();
        let id_event = $(this).data("id");

        if (confirm("Apakah Anda yakin ingin menghapus event ini?")) {
            $.ajax({
                url: "<?= site_url('admin/event/event_delete') ?>",
                type: "POST",
                data: { id_event: id_event },
                dataType: "json",
                success: function (res) {
                    if (res.status === "success") {
                        $("#modal_frame").modal("hide");
                        toastr.success(res.message, "Sukses");

                        // Reload daftar event setelah sukses
                        $.post("<?= site_url('admin/event/event_daftar') ?>", function (res) {
                            $("#daftar_event").html(res);
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