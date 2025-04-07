<?php
class Kategori_model extends CI_Model {
    private $table = 'kategori'; // Ganti dengan nama tabel yang sesuai

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_kategori($data) {
        return $this->db->insert($this->table, $data);
    }

    public function get_kategori_by_id_kategori($id_kategori) {
        return $this->db->get_where($this->table, ['id_kategori' => $id_kategori])->row();
    }

    public function get_kategori_by_nama_kategori($nama_kategori) {
        return $this->db->get_where($this->table, ['nama_kategori' => $nama_kategori])->row();
    }

    public function get_kategori_by_unggulan() {
        return $this->db->get_where($this->table, ['unggulan' => 'true'])->result();
    }

    public function get_kategori() {
        $this->db->order_by('id_kategori', 'DESC');
        return $this->db->get($this->table)->result();
    }

    public function update_kategori($id_kategori, $data) {
        $this->db->where('id_kategori', $id_kategori);
        return $this->db->update($this->table, $data);
    }

    public function delete_kategori($id_kategori) {
        $this->db->where('id_kategori', $id_kategori);
        return $this->db->delete($this->table);
    }

    public function count_kategori() {
        return $this->db->count_all_results($this->table);
    }
}
