<?php
class event_model extends CI_Model {
    private $table = 'event'; // Ganti dengan nama tabel yang sesuai

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_event($data) {
        return $this->db->insert($this->table, $data);
    }

    public function get_event_by_id_event($id_event) {
        return $this->db->get_where($this->table, ['id_event' => $id_event])->row();
    }

    public function get_event_by_slug($slug) {
        return $this->db->get_where($this->table, ['slug' => $slug])->row();
    }

    public function get_event() {
        $this->db->order_by('id_event', 'DESC');
        return $this->db->get($this->table)->result();
    }

    public function update_event($id_event, $data) {
        $this->db->where('id_event', $id_event);
        return $this->db->update($this->table, $data);
    }

    public function delete_event($id_event) {
        $this->db->where('id_event', $id_event);
        return $this->db->delete($this->table);
    }

    public function count_event() {
        return $this->db->count_all_results($this->table);
    }
}
