<form id="form-add-admin">
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="username" name="username" placeholder="Nama admin" required>
        <label for="username">Nama admin</label>
    </div>
    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="email" name="email" placeholder="email" required>
        <label for="email">email</label>
    </div>
    <select name="role" class="form-control">
        <option value="admin">Role : Admin</option>
        <option value="owner">Role : Owner</option>
    </select>
    <input type="hidden" name="password" value="admin">
    <div class="alert alert-info mt-3">
        <p>Default password akan diatur menjadi: <strong>admin</strong></p>
    </div>
    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary mt-3 py-2 w-50 rounded-pill">Tambahkan</button>
    </div>
</form>