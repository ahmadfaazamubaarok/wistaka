<?php $this->load->view('admin/template/head') ?>
<style type="text/css">
    a {
    color: inherit; /* Menggunakan warna teks bawaan */
    text-decoration: none; /* Menghapus garis bawah */
    }

    a:hover {
        color: inherit; /* Warna tetap sama saat hover */
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
<div class="row">
	<!-- Button trigger modal -->
	<a href="<?= site_url('admin/artikel/artikel_add') ?>" type="button" class="btn btn-primary">
	  Tambah artikel
	</a>
</div>
<div id="daftar_artikel" class="row"></div>
<!-- Modal -->
<div class="modal fade" id="modal_frame" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(".text").each(function () {
      let text = $(this).text();
      if (text.length > 100) {
        $(this).text(text.substring(0, 100) + "...");
      }
    });
</script>
<script type="text/javascript">
$(document).ready(function () {
    var daftar_artikel = $('#daftar_artikel');
    var pesan_loading = '<p class="text-center"><em>Tunggu ya...</em></p>';
    var frame = $('#modal_frame');

    daftar_artikel.html(pesan_loading);
    $.post('<?= site_url('admin/artikel/artikel_daftar') ?>', function(res){
        daftar_artikel.html(res);
    });

    // DELETE ARTIKEL
    $(document).on("click", ".btn-delete-artikel", function (e) {
        e.preventDefault();
        let id_artikel = $(this).data("id");

        if (confirm("Apakah Anda yakin ingin menghapus artikel ini?")) {
            $.ajax({
                url: "<?= site_url('admin/artikel/artikel_delete') ?>",
                type: "POST",
                data: { id_artikel: id_artikel },
                dataType: "json",
                success: function (res) {
                    if (res.status === "success") {
                        $("#modal_frame").modal("hide");
                        toastr.success(res.message, "Sukses");

                        // Reload daftar artikel setelah sukses
                        $.post("<?= site_url('admin/artikel/artikel_daftar') ?>", function (res) {
                            $("#daftar_artikel").html(res);
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