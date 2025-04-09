<?php
class Auth_model extends CI_Model {
    private $table = 'artikel'; // Ganti dengan nama tabel yang sesuai

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function login($username, $email, $password)
    {
        // Ambil user berdasarkan username atau email
        $this->db->where('username', $username);
        $this->db->or_where('email', $email);
        $query = $this->db->get('admin'); // Ganti 'users' sesuai nama tabel kamu
        // var_dump($query);
        // die();

        // Cek apakah user ditemukan
        if ($query->num_rows() === 1) {
            $user = $query->row();

            // Verifikasi password
            if (password_verify($password, $user->password)) {
                return $user; // Login berhasil, return data user
            } else {
                return false; // Password salah
            }
        }

        return false; // User tidak ditemukan
    }
}