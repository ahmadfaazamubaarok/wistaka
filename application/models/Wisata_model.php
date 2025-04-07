<?php
class Wisata_model extends CI_Model {
    private $table = 'wisata'; // Ganti dengan nama tabel yang sesuai

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_wisata($data) {
        return $this->db->insert($this->table, $data);
    }

    public function get_wisata_by_id_wisata($id_wisata) {
        $this->db->select('*');
        $this->db->from('wisata');
        $this->db->join('kategori','wisata.kategori = kategori.id_kategori','left');
        $this->db->where('wisata.id_wisata', $id_wisata);
        return $this->db->get()->row();
    }

    public function get_wisata() {
        $this->db->select('*');
        $this->db->from('wisata');
        $this->db->join('kategori','wisata.kategori = kategori.id_kategori','left');
        $this->db->order_by('id_wisata', 'DESC');
        return $this->db->get()->result();
    }

    public function get_wisata_by_kategori($id_kategori) {
        $this->db->select('*');
        $this->db->from('wisata');
        $this->db->join('kategori','wisata.kategori = kategori.id_kategori','left');
        $this->db->where('wisata.kategori', $id_kategori);
        $this->db->order_by('id_wisata', 'DESC');
        return $this->db->get()->result();
    }

    public function get_wisata_by_nama_wisata($nama_wisata) {
        $this->db->select('*');
        $this->db->from('wisata');
        $this->db->join('kategori','wisata.kategori = kategori.id_kategori','left');
        $this->db->where('wisata.nama_wisata', $nama_wisata);
        $this->db->order_by('id_wisata', 'DESC');
        return $this->db->get()->row();
    }

    public function update_wisata($id_wisata, $data) {
        $this->db->where('id_wisata', $id_wisata);
        return $this->db->update($this->table, $data);
    }

    public function delete_wisata($id_wisata) {
        $this->db->where('id_wisata', $id_wisata);
        return $this->db->delete($this->table);
    }

    public function count_wisata() {
        return $this->db->count_all_results($this->table);
    }
}
