<?php
class unggulan extends CI_Controller {

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
        $this->load->view('admin/unggulan/unggulan_view');
    }

    public function unggulan_daftar()
    {
        $data['unggulan'] = $this->unggulan_model->get_unggulan();
        $this->load->view('admin/unggulan/unggulan_daftar',$data);
    }

    public function unggulan_add()
    {
        $this->load->view('admin/unggulan/unggulan_add');
    }

    public function unggulan_edit($id_unggulan)
    {
        $data['unggulan'] = $this->unggulan_model->get_unggulan_by_id_unggulan($id_unggulan);
        $this->load->view('admin/unggulan/unggulan_edit',$data);
    }

    public function unggulan_addsave() 
    {
        $this->load->library('upload'); // Load library upload
        header('Content-Type: application/json');

        $id_unggulan = 'KT' . date('ymdhis');

        // Path untuk masing-masing folder
        $thumbnail_path = './uploads/thumbnail_unggulan/';
        $ikon_path = './uploads/ikon_unggulan/';

        // Konfigurasi upload
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']      = 2048; // 2MB

        // Pastikan folder ada
        if (!is_dir($thumbnail_path)) {
            mkdir($thumbnail_path, 0777, true);
        }
        if (!is_dir($ikon_path)) {
            mkdir($ikon_path, 0777, true);
        }

        $thumbnail_unggulan = '';
        $ikon_unggulan = '';

        // Upload thumbnail_unggulan
        $config['upload_path'] = $thumbnail_path;
        $this->upload->initialize($config);
        if ($this->upload->do_upload('thumbnail_unggulan')) {
            $thumbnail_data = $this->upload->data();
            $thumbnail_unggulan = $thumbnail_data['file_name'];
        }

        // Upload ikon_unggulan
        $config['upload_path'] = $ikon_path;
        $this->upload->initialize($config);
        if ($this->upload->do_upload('ikon_unggulan')) {
            $ikon_data = $this->upload->data();
            $ikon_unggulan = $ikon_data['file_name'];
        }

        $data = [
            'id_unggulan' => $id_unggulan,
            'nama_unggulan' => $this->input->post('nama_unggulan', TRUE),
            'thumbnail_unggulan' => $thumbnail_unggulan,
            'ikon_unggulan' => $ikon_unggulan
        ];

        if ($this->unggulan_model->insert_unggulan($data)) {
            $response = [
                'status' => 'success',
                'message' => 'unggulan berhasil ditambahkan!'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Gagal menambahkan unggulan.'
            ];
        }
        $this->set_output($response);
    }

    public function unggulan_editsave() 
    {
        $this->load->library('upload');
        header('Content-Type: application/json');

        $id_unggulan = $this->input->post('id_unggulan', TRUE);
        $nama_unggulan = $this->input->post('nama_unggulan', TRUE);

        if (!$id_unggulan || !$nama_unggulan) {
            $this->set_output(['status' => 'error', 'message' => 'ID dan nama unggulan harus diisi.']);
        }

        $unggulan = $this->unggulan_model->get_unggulan_by_id_unggulan($id_unggulan);
        if (!$unggulan) {
            $this->set_output(['status' => 'error', 'message' => 'unggulan tidak ditemukan.']);
        }

        $thumbnail_path = './uploads/thumbnail_unggulan/';
        $ikon_path = './uploads/ikon_unggulan/';

        if (!is_dir($thumbnail_path)) mkdir($thumbnail_path, 0777, true);
        if (!is_dir($ikon_path)) mkdir($ikon_path, 0777, true);

        $thumbnail_unggulan = $unggulan->thumbnail_unggulan;
        $ikon_unggulan = $unggulan->ikon_unggulan;

        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048;

        // Upload Thumbnail (Jika Ada)
        if (!empty($_FILES['thumbnail_unggulan']['name'])) {
            $config['upload_path'] = $thumbnail_path;
            $this->upload->initialize($config);
            if ($this->upload->do_upload('thumbnail_unggulan')) {
                // Hapus file lama
                if ($thumbnail_unggulan && file_exists($thumbnail_path . $thumbnail_unggulan)) {
                    unlink($thumbnail_path . $thumbnail_unggulan);
                }
                $thumbnail_unggulan = $this->upload->data('file_name');
            } else {
                $this->set_output(['status' => 'error', 'message' => $this->upload->display_errors('', '')]);
            }
        }

        // Upload Ikon (Jika Ada)
        if (!empty($_FILES['ikon_unggulan']['name'])) {
            $config['upload_path'] = $ikon_path;
            $this->upload->initialize($config);
            if ($this->upload->do_upload('ikon_unggulan')) {
                // Hapus file lama
                if ($ikon_unggulan && file_exists($ikon_path . $ikon_unggulan)) {
                    unlink($ikon_path . $ikon_unggulan);
                }
                $ikon_unggulan = $this->upload->data('file_name');
            } else {
                $this->set_output(['status' => 'error', 'message' => $this->upload->display_errors('', '')]);
            }
        }

        $data = [
            'nama_unggulan' => $nama_unggulan,
            'thumbnail_unggulan' => $thumbnail_unggulan,
            'ikon_unggulan' => $ikon_unggulan
        ];

        if ($this->unggulan_model->update_unggulan($id_unggulan, $data)) {
            $this->set_output(['status' => 'success', 'message' => 'unggulan berhasil diperbarui!']);
        } else {
            $this->set_output(['status' => 'error', 'message' => 'Gagal memperbarui unggulan.']);
        }
    }

    public function unggulan_delete() 
    {
        $id_unggulan = $this->input->post('id_unggulan', TRUE);

        if (!$id_unggulan) {
            $this->set_output(['status' => 'error', 'message' => 'ID unggulan tidak ditemukan.']);
            return;
        }

        // Ambil data unggulan berdasarkan ID
        $unggulan = $this->unggulan_model->get_unggulan_by_id_unggulan($id_unggulan);
        if (!$unggulan) {
            $this->set_output(['status' => 'error', 'message' => 'unggulan tidak ditemukan.']);
            return;
        }

        // Path lokasi file
        $thumbnail_path = './uploads/thumbnail_unggulan/' . $unggulan->thumbnail_unggulan;
        $ikon_path = './uploads/ikon_unggulan/' . $unggulan->ikon_unggulan;

        // Hapus file thumbnail jika ada
        if ($unggulan->thumbnail_unggulan && file_exists($thumbnail_path)) {
            unlink($thumbnail_path);
        }

        // Hapus file ikon jika ada
        if ($unggulan->ikon_unggulan && file_exists($ikon_path)) {
            unlink($ikon_path);
        }

        // Hapus dari database
        if ($this->unggulan_model->delete_unggulan($id_unggulan)) {
            $this->set_output(['status' => 'success', 'message' => 'unggulan berhasil dihapus!']);
        } else {
            $this->set_output(['status' => 'error', 'message' => 'Gagal menghapus unggulan.']);
        }
    }
}