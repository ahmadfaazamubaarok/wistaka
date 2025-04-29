<?php
class Iklan extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
        if (!$this->session->userdata('admin')) {
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
        $this->load->view('admin/iklan/iklan_view');
    }

    public function iklan_daftar()
    {
        $data['iklan'] = $this->iklan_model->get_iklan();
        $this->load->view('admin/iklan/iklan_daftar',$data);
    }

    public function iklan_add()
    {
        $this->load->view('admin/iklan/iklan_add');
    }

    public function iklan_addsave() 
    {
        $this->load->library('upload'); // Load library upload
        header('Content-Type: application/json');

        $id_iklan = 'IK' . date('ymdhis');

        // Path untuk masing-masing folder
        $iklan_path = './uploads/iklan/';

        // Konfigurasi upload
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']      = 2048; // 2MB

        // Pastikan folder ada
        if (!is_dir($iklan_path)) {
            mkdir($iklan_path, 0777, true);
        }

        $iklan_iklan = '';

        // Upload iklan_iklan
        $config['upload_path'] = $iklan_path;
        $this->upload->initialize($config);
        if ($this->upload->do_upload('iklan')) {
            $iklan_data = $this->upload->data();
            
            // Rename file dengan id_iklan
            $ext = pathinfo($iklan_data['file_name'], PATHINFO_EXTENSION);
            $new_filename = $id_iklan . '.' . $ext;
            rename($iklan_data['full_path'], $iklan_path . $new_filename);
            
            $iklan = $new_filename;
        }

        $data = [
            'id_iklan' => $id_iklan,
            'iklan' => $iklan,
        ];

        if ($this->iklan_model->insert_iklan($data)) {
            $response = [
                'status' => 'success',
                'message' => 'iklan berhasil ditambahkan!'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Gagal menambahkan iklan.'
            ];
        }
        $this->set_output($response);
    }

    public function iklan_delete() 
    {
        $id_iklan = $this->input->post('id_iklan', TRUE);

        if (!$id_iklan) {
            $this->set_output(['status' => 'error', 'message' => 'ID iklan tidak ditemukan.']);
            return;
        }

        // Ambil data iklan berdasarkan ID
        $iklan = $this->iklan_model->get_iklan_by_id_iklan($id_iklan);
        if (!$iklan) {
            $this->set_output(['status' => 'error', 'message' => 'iklan tidak ditemukan.']);
            return;
        }

        // Path lokasi file
        $iklan_path = './uploads/iklan/' . $iklan->iklan;

        // Hapus file iklan jika ada
        if ($iklan->iklan && file_exists($iklan_path)) {
            unlink($iklan_path);
        }

        // Hapus dari database
        if ($this->iklan_model->delete_iklan($id_iklan)) {
            $this->set_output(['status' => 'success', 'message' => 'iklan berhasil dihapus!']);
        } else {
            $this->set_output(['status' => 'error', 'message' => 'Gagal menghapus iklan.']);
        }
    }
}