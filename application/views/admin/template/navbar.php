  <!--  Main wrapper -->
  <div class="body-wrapper">
    <!--  Header Start -->
    <header class="app-header">
      <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
          <li class="nav-item d-block d-xl-none">
            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
              <i class="ti ti-menu-2"></i>
            </a>
          </li>
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
          <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
            <li class="nav-item dropdown">
              <div class="nav-link nav-icon-hover" id="drop2" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="ti ti-user"></i>
              </div>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                <div class="message-body">
                  <div class="d-flex align-items-center gap-2 dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_profil">
                    <i class="ti ti-user fs-6"></i>
                    <p class="mb-0 fs-3">Edit Profile</p>
                  </div>
                  <a  href="<?= site_url('auth/logout') ?>" 
                      onclick="return confirm('Yakin akan logout?');" 
                      class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Modal -->
    <div class="modal fade" id="modal_profil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Profil</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="form_edit_profil">
            <input type="hidden" name="id_admin" value="<?= $this->session->userdata('admin')->id_admin ?>">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" name="username" value="<?= $this->session->userdata('admin')->username ?>" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="<?= $this->session->userdata('admin')->email ?>" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password">
              <!-- Tambahkan catatan agar password bisa dikosongkan jika tidak ingin diubah -->
              <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
          </form>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $('#form_edit_profil').on('submit', function(event){
             event.preventDefault();
             $.ajax({
                 url: '<?= site_url('admin/admin/profil_editsave') ?>',
                 type: 'POST',
                 data: $(this).serialize(),
                 dataType: 'json', // Supaya bisa menangkap JSON response
                 success: function(respon) {
                     if (respon.status === "success") {
                         $('#modal_frame').modal('hide');
                         toastr.success(respon.message, 'Sukses');
                         $('#karya_table').DataTable().ajax.reload(); // Memperbarui DataTable
                     } else {
                         toastr.error(respon.message, 'Gagal');
                     }
                 },
                 error: function(jqXHR, textStatus, errorThrown) {
                     toastr.error('Terjadi kesalahan, coba lagi.', 'Error');
                 }
             });
          });
    </script>
    <!--  Header End -->
    <div class="container-fluid">