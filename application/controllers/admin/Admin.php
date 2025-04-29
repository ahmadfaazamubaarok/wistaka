<?php
class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user')) {
            redirect('auth');
        }
    }

    private function set_output($data)
    {
        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data, JSON_PRETTY_PRINT))
                ->_display();
        exit;
    }

    public function index()
    {
        $this->load->view('admin/admin/admin_view');
    }

    public function admin_daftar()
    {
        $daftar_admin = $this->admin_model->get_admin();
        $daftar_input = [];
        foreach ($daftar_admin as $key) {
            // BAHAN SATUAN
            $bahan_input = [
                $key->id_admin,
                $key->username,
                $key->email,
                $key->role,
                '<a href="javascript:;" class="mx-1 btn btn-success btn-admin-edit" data-id="'. $key->id_admin .'"><i class="ti ti-edit"></i></a>'.
                '<a href="javascript:;" class="mx-1 btn btn-danger btn-admin-delete" data-id="'. $key->id_admin .'"><i class="ti ti-trash"></i></a>'
            ];
            array_push($daftar_input, $bahan_input);
        };
        $response = array(
            'data' => $daftar_input
        );
        // var_dump($response);
        // die();
        $this->set_output($response);
    }

    // --------------------------------------------------------------
    public function admin_add()
    {
        $this->load->view('admin/admin/admin_add');
    }

    public function admin_addsave()
    {
        $username = $this->input->post('username', TRUE); // Hindari XSS
        $email = $this->input->post('email', TRUE);
        $role = $this->input->post('role', TRUE);
        $password = $this->input->post('password');

        // Validasi kosong
        if (empty($username) || empty($email) || empty($password)) {
            $this->set_output(['status' => 'error', 'message' => 'Semua field wajib diisi']);
            return;
        }

        // Validasi email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->set_output(['status' => 'error', 'message' => 'Format email tidak valid']);
            return;
        }

        // Validasi username unik
        $existing_user = $this->db->get_where('admin', ['username' => $username])->row();
        if ($existing_user) {
            $this->set_output(['status' => 'error', 'message' => 'Username sudah digunakan']);
            return;
        }

        // Validasi email unik
        $existing_email = $this->db->get_where('admin', ['email' => $email])->row();
        if ($existing_email) {
            $this->set_output(['status' => 'error', 'message' => 'Email sudah digunakan']);
            return;
        }

        // Hash password
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        $data = [
            'id_admin' => 'AD' . date('ymdhis'),
            'username' => $username,
            'email' => $email,
            'role' => $role,
            'password' => $password_hashed,
        ];

        $this->admin_model->insert_admin($data);

        $this->set_output(['status' => 'sukses', 'message' => 'Admin berhasil ditambahkan']);
    }

    // --------------------------------------------------------------
    public function admin_edit($id_admin)
    {
        $data['admin'] = $this->admin_model->get_admin_by_id_admin($id_admin);
        $this->load->view('admin/admin/admin_edit',$data);
    }

    public function admin_editsave()
    {
        $id_admin = $this->input->post('id_admin', TRUE);
        $username = $this->input->post('username', TRUE);
        $email = $this->input->post('email', TRUE);
        $role = $this->input->post('role', TRUE);

        // Cek apakah reset password dicentang
        $reset_password = $this->input->post('reset_password', FALSE); // Checkbox reset password

        // Validasi wajib
        if (empty($id_admin) || empty($username) || empty($email)) {
            $this->set_output(['status' => 'error', 'message' => 'Semua field wajib diisi']);
            return;
        }

        // Cek apakah admin ada
        $admin = $this->admin_model->get_admin_by_id_admin($id_admin);
        if (!$admin) {
            $this->set_output(['status' => 'error', 'message' => 'Data admin tidak ditemukan']);
            return;
        }

        // Cek username unik (jika berubah)
        if ($username !== $admin->username) {
            $cek_user = $this->db->get_where('admin', ['username' => $username])->row();
            if ($cek_user) {
                $this->set_output(['status' => 'error', 'message' => 'Username sudah digunakan']);
                return;
            }
        }

        // Cek email unik (jika berubah)
        if ($email !== $admin->email) {
            $cek_email = $this->db->get_where('admin', ['email' => $email])->row();
            if ($cek_email) {
                $this->set_output(['status' => 'error', 'message' => 'Email sudah digunakan']);
                return;
            }
        }

        // Siapkan data untuk update
        $update_data = [
            'username' => $username,
            'email' => $email,
            'role' => $role
        ];

        // Jika reset password dicentang, set password ke "admin"
        if ($reset_password) {
            $update_data['password'] = password_hash('admin', PASSWORD_DEFAULT);
        }

        // Update admin data
        $this->admin_model->update_admin($id_admin, $update_data);

        $this->set_output(['status' => 'sukses', 'message' => 'Data admin berhasil diperbarui']);
    }

    // --------------------------------------------------------------
    public function admin_delete()
    {
        $id_admin = $this->input->post('id_admin');

        // Cek apakah ID ada
        if (empty($id_admin)) {
            echo json_encode(['status' => 'error', 'message' => 'ID admin tidak valid']);
            return;
        }

        // Validasi apakah admin benar-benar ada
        $admin = $this->admin_model->get_admin_by_id_admin($id_admin);
        if (!$admin) {
            echo json_encode(['status' => 'error', 'message' => 'Admin tidak ditemukan']);
            return;
        }

        // Eksekusi hapus
        $hapus = $this->admin_model->delete_admin($id_admin);
        if ($hapus) {
            echo json_encode(['status' => 'sukses', 'message' => 'Admin berhasil dihapus']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus admin']);
        }
    }

    // --------------------------------------------------------------
    public function profil_editsave()
    {
        $id_admin = $this->input->post('id_admin', TRUE);
        $username = $this->input->post('username', TRUE);
        $email = $this->input->post('email', TRUE);

        // Cek apakah reset password dicentang
        $reset_password = $this->input->post('password', FALSE); // Checkbox reset password

        // Jika reset password dicentang, set password ke "admin"
        if ($reset_password) {
            $update_data['password'] = password_hash('admin', PASSWORD_DEFAULT);
        }

        // Validasi wajib
        if (empty($id_admin) || empty($username) || empty($email)) {
            $this->set_output(['status' => 'error', 'message' => 'Semua field wajib diisi']);
            return;
        }

        // Cek apakah admin ada
        $admin = $this->admin_model->get_admin_by_id_admin($id_admin);
        if (!$admin) {
            $this->set_output(['status' => 'error', 'message' => 'Data admin tidak ditemukan']);
            return;
        }

        // Cek username unik (jika berubah)
        if ($username !== $admin->username) {
            $cek_user = $this->db->get_where('admin', ['username' => $username])->row();
            if ($cek_user) {
                $this->set_output(['status' => 'error', 'message' => 'Username sudah digunakan']);
                return;
            }
        }

        // Cek email unik (jika berubah)
        if ($email !== $admin->email) {
            $cek_email = $this->db->get_where('admin', ['email' => $email])->row();
            if ($cek_email) {
                $this->set_output(['status' => 'error', 'message' => 'Email sudah digunakan']);
                return;
            }
        }

        // Siapkan data untuk update
        $update_data = [
            'username' => $username,
            'email' => $email,
        ];

        // Update admin data
        $this->admin_model->update_admin($id_admin, $update_data);

        $this->set_output(['status' => 'sukses', 'message' => 'Data admin berhasil diperbarui']);
    }
}