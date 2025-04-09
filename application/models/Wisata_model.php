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
        // $this->db->join('kategori','wisata.kategori = kategori.id_kategori','left');
        $this->db->where('wisata.kategori', $id_kategori);
        $this->db->where('wisata.publish','true');
        $this->db->order_by('id_wisata', 'DESC');
        return $this->db->get()->result();
    }

    public function get_wisata_by_slug($slug) {
        $this->db->select('*');
        $this->db->from('wisata');
        $this->db->join('kategori','wisata.kategori = kategori.id_kategori','left');
        $this->db->where('wisata.slug', $slug);
        $this->db->where('wisata.publish','true');
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

    public function search_wisata($keyword)
    {
        $this->db->select('wisata.*, kategori.nama_kategori');
        $this->db->from('wisata');
        $this->db->join('kategori', 'kategori.id_kategori = wisata.kategori');
        $this->db->like('wisata.nama_wisata', $keyword);
        $this->db->or_like('kategori.nama_kategori', $keyword);
        return $this->db->get()->result();
    }
}
