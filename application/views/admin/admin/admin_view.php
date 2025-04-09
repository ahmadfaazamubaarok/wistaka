<?php $this->load->view('admin/template/head') ?>
<?php $this->load->view('admin/template/sidebar') ?>
<?php $this->load->view('admin/template/navbar') ?>
<div class="container">
	<div class="card" data-aos="zoom-out">
		<div class="card-body">
			<div class="d-flex justify-content-between mb-3">
				<div>
					<h2>Admin</h2>
					<p>Kelola data admin.</p>
				</div>
				<div>
					<a href="javascript:;" class="btn btn-primary btn-admin-add py-3 rounded-pill" data-aos="zoom-out" data-aos-delay="100"><i class="ti ti-plus"></i> Tambah admin</a>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-striped table-hover display" id="admin_table">
				  <thead class="thead-dark">
				    <tr>
				      <th scope="col">Id admin</th>
				      <th scope="col">Nama admin</th>
				      <th scope="col">Email</th>
				      <th scope="col">Role</th>
				      <th scope="col" class="text-end">Aksi</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<!-- data dimuat disini menggunakan ajax -->
				  </tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" tabindex="-1" id="modal_frame">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Modal title</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</button>
			</div>
			<div class="modal-body">
				<p>Modal body text goes here.</p>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('admin/template/foot') ?>
<script type="text/javascript">
	$(document).ready(function(){
		var table_admin = $('#admin_table');
		var pesan_loading = '<p class="text-center"><em>Work in progress...</em></p>';
		var frame = $('#modal_frame');
		table_admin.DataTable({
			"ajax": "<?= site_url('admin/admin/admin_daftar') ?>",
			responsive: true,
	        language: {
	          url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/id.json' // Bahasa Indonesia
	        }
		});
		// ADD admin
		$(document).on("click",".btn-admin-add",function(){
			let id_admin = $(this).data('id');
			frame.find(".modal-title").html("Tambah admin");
			frame.find(".modal-body").html(pesan_loading);
			frame.modal("show");
			$.post('<?= site_url('admin/admin/admin_add') ?>', function(res){
				frame.find(".modal-body").html(res);
			});
		});
		$(document).on("submit","#form-add-admin",function(event){
			event.preventDefault();
			$.ajax({
			    url: '<?= site_url('admin/admin/admin_addsave') ?>',
			    type: 'POST',
			    data: $(this).serialize(),
			    dataType: 'json' // penting agar respon bisa diproses sebagai objek
			})
			.done(function(respon){
			    if (respon.status === 'sukses') {
			        $('#modal_frame').modal('hide');
			        $('#admin_table').DataTable().ajax.reload();
			        toastr.success(respon.message, 'Sukses');
			    } else {
			        toastr.error(respon.message, 'Gagal');
			    }
			})
			.fail(function(respon){
				alert('gagal tambah');
			})
		});
		//EDIT admin
		$(document).on("click",".btn-admin-edit",function(){
			let frame = $('#modal_frame');
			let id_admin = $(this).data('id');
				frame.find(".modal-title").html("Edit admin");
				frame.find(".modal-body").html(pesan_loading);
				frame.modal("show");
			$.get('<?= site_url('admin/admin/admin_edit/') ?>'+id_admin, function(res){
				frame.find(".modal-body").html(res);
			});
		});
		$(document).on("submit", "#form-edit-admin", function(event) {
		    event.preventDefault();

		    // Mengecek apakah checkbox untuk reset password dicentang
		    var resetPassword = $('#reset-password').is(':checked');
		    
		    // Jika dicentang, set password ke 'admin'
		    if (resetPassword) {
		        $('input[name="password"]').val('admin');
		    }

		    // Kirim data form melalui AJAX
		    $.ajax({
		        url: '<?= site_url('admin/admin/admin_editsave') ?>',
		        type: 'POST',
		        data: $(this).serialize(),
		        dataType: 'json',
		        success: function(response) {
		            if (response.status === 'sukses') {
		                toastr.success('Admin berhasil diperbarui!', 'Sukses');
		                $('#modal_frame').modal('hide');
			        	$('#admin_table').DataTable().ajax.reload();
		            } else {
		                toastr.error(response.message, 'Error');
		            }
		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		            toastr.error('Terjadi kesalahan. Silakan coba lagi.', 'Error');
		        }
		    });
		});
		// Konfigurasi hapus admin menggunakan Bootbox dan toastr
		$(document).on("click", ".btn-admin-delete", function() {
		    var id_admin = $(this).data("id");
		    
		    // Konfirmasi bawaan browser
		    if (confirm("Apakah Anda yakin ingin menghapus admin ini?")) {
		        $.ajax({
		            url: '<?= site_url('admin/admin/admin_delete') ?>',
		            type: 'POST',
		            data: { id_admin: id_admin },
		            dataType: 'json'
		        })
		        .done(function(respon) {
		            if (respon.status == 'sukses') {
		                toastr.success('Admin berhasil dihapus!', 'Sukses');
		                $('#admin_table').DataTable().ajax.reload(); // Memperbarui DataTable
		            } else {
		                toastr.error('Tidak bisa menghapus, admin masih digunakan!');
		            }
		        })
		        .fail(function(jqXHR, textStatus, errorThrown) {
		            alert('Gagal menghapus: ' + textStatus);
		        });
		    }
		});
	});
</script>