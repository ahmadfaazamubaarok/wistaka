<form id="form-edit-admin">
    <input type="hidden" name="id_admin" value="<?= $admin->id_admin ?>">

    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="username" placeholder="Nama admin" value="<?= $admin->username ?>" required>
        <label>Nama admin</label>
    </div>

    <div class="form-floating mb-3">
        <input type="email" class="form-control" name="email" placeholder="Email" value="<?= $admin->email ?>" required>
        <label>Email</label>
    </div>

    <select name="role" class="form-control">
        <option value="admin" <?= $admin->role == 'admin' ? 'selected' : '' ?>>Role : Admin</option>
        <option value="owner" <?= $admin->role == 'owner' ? 'selected' : '' ?>>Role : Owner</option>
    </select>

    <div class="alert alert-warning mt-3">
        <!-- Ceklis untuk reset password -->
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="reset-password" name="reset_password">
            <label class="form-check-label" for="reset-password">Reset password ke "admin"</label>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-success mt-3 py-2 w-50 rounded-pill">Simpan Perubahan</button>
    </div>
</form>
