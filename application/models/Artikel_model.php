<?php
class Artikel_model extends CI_Model {
    private $table = 'artikel'; // Ganti dengan nama tabel yang sesuai

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_artikel($data) {
        return $this->db->insert($this->table, $data);
    }

    public function get_artikel_by_id_artikel($id_artikel) {
        return $this->db->get_where($this->table, ['id_artikel' => $id_artikel])->row();
    }

    public function get_artikel_by_slug($slug) {
        return $this->db->get_where($this->table, ['slug' => $slug])->row();
    }

    public function get_artikel() {
        $this->db->order_by('id_artikel', 'DESC');
        return $this->db->get($this->table)->result();
    }

    public function update_artikel($id_artikel, $data) {
        $this->db->where('id_artikel', $id_artikel);
        return $this->db->update($this->table, $data);
    }

    public function delete_artikel($id_artikel) {
        $this->db->where('id_artikel', $id_artikel);
        return $this->db->delete($this->table);
    }

    public function count_artikel() {
        return $this->db->count_all_results($this->table);
    }
}
