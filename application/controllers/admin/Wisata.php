<?php
class Wisata extends CI_Controller {

    public function __construct() {
        parent::__construct();
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

    public function index(){
        $this->load->view('admin/wisata/wisata_view');
    }

    public function wisata_daftar(){
        $data['wisata'] = $this->wisata_model->get_wisata();
        $this->load->view('admin/wisata/wisata_daftar',$data);
    }

    public function wisata_add(){
        $data['kategori'] = $this->kategori_model->get_kategori();
        $this->load->view('admin/wisata/wisata_add',$data);
    }

    public function wisata_edit($id_wisata){
        $data['wisata'] = $this->wisata_model->get_wisata_by_id_wisata($id_wisata);
        $data['kategori'] = $this->kategori_model->get_kategori();
        $this->load->view('admin/wisata/wisata_edit',$data);
    }

    public function wisata_addsave() {
        $this->load->library('upload'); // Load library upload
        header('Content-Type: application/json');

        $id_wisata = 'WS' . date('ymdhis');

        // Path untuk masing-masing folder
        $thumbnail_path = './uploads/thumbnail_wisata/';

        // Konfigurasi upload
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']      = 2048; // 2MB
        $config['upload_path']   = $thumbnail_path;

        // Pastikan folder ada
        if (!is_dir($thumbnail_path)) {
            mkdir($thumbnail_path, 0777, true);
        }

        $thumbnail_wisata = '';

        // Upload thumbnail_wisata
        $this->upload->initialize($config);
        if ($this->upload->do_upload('thumbnail_wisata')) {
            $thumbnail_data = $this->upload->data();
            
            // Rename file dengan menambahkan ID wisata
            $ext = pathinfo($thumbnail_data['file_name'], PATHINFO_EXTENSION);
            $new_filename = $id_wisata . '.' . $ext;
            
            rename($thumbnail_data['full_path'], $thumbnail_path . $new_filename);
            
            $thumbnail_wisata = $new_filename;
        }

        $data = [
            'id_wisata' => $id_wisata,
            'kategori' => $this->input->post('kategori', TRUE),
            'thumbnail_wisata' => $thumbnail_wisata,
            'nama_wisata' => $this->input->post('nama_wisata', TRUE),
            'deskripsi_wisata' => $this->input->post('deskripsi_wisata', TRUE),
            'jam_buka' => $this->input->post('jam_buka', TRUE),
            'harga_masuk' => $this->input->post('harga_masuk', TRUE),
            'parkir' => $this->input->post('parkir', TRUE),
            'fasilitas' => $this->input->post('fasilitas', TRUE),
            'map' => $this->input->post('map', TRUE),
            'alamat' => $this->input->post('alamat', TRUE),
            'publish' => 'true'
        ];

        if ($this->wisata_model->insert_wisata($data)) {
            $this->session->set_flashdata('sukses','Sukses menambahkan wisata');
            redirect('admin/wisata');
        } else {
            $this->session->set_flashdata('gagal','Gagal menambahkan wisata');
            redirect('admin/wisata');
        }
    }

    public function wisata_editsave() {
        $id_wisata = $this->input->post('id_wisata');
        $this->load->library('upload'); // Load library upload
        header('Content-Type: application/json');

        // Path untuk folder thumbnail
        $thumbnail_path = './uploads/thumbnail_wisata/';

        // Konfigurasi upload
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']      = 2048; // 2MB
        $config['upload_path']   = $thumbnail_path;

        // Pastikan folder ada
        if (!is_dir($thumbnail_path)) {
            mkdir($thumbnail_path, 0777, true);
        }

        // Ambil data wisata lama
        $wisata_lama = $this->wisata_model->get_wisata_by_id_wisata($id_wisata);
        $thumbnail_wisata = $wisata_lama->thumbnail_wisata; // Default: gunakan gambar lama

        // Upload thumbnail baru jika ada
        if (!empty($_FILES['thumbnail_wisata']['name'])) {
            $this->upload->initialize($config);
            if ($this->upload->do_upload('thumbnail_wisata')) {
                // Hapus file lama
                if ($thumbnail_wisata && file_exists($thumbnail_path . $thumbnail_wisata)) {
                    unlink($thumbnail_path . $thumbnail_wisata);
                }
                
                // Rename file dengan mengganti nama menjadi ID wisata
                $thumbnail_data = $this->upload->data();
                $ext = pathinfo($thumbnail_data['file_name'], PATHINFO_EXTENSION);
                $new_filename = $id_wisata . '.' . $ext;
                rename($thumbnail_data['full_path'], $thumbnail_path . $new_filename);
                
                $thumbnail_wisata = $new_filename;
            } else {
                $this->set_output(['status' => 'error', 'message' => $this->upload->display_errors('', '')]);
                return;
            }
        }

        // Data yang akan diperbarui
        $data = [
            'kategori' => $this->input->post('kategori', TRUE),
            'thumbnail_wisata' => $thumbnail_wisata,
            'nama_wisata' => $this->input->post('nama_wisata', TRUE),
            'deskripsi_wisata' => $this->input->post('deskripsi_wisata', TRUE),
            'jam_buka' => $this->input->post('jam_buka', TRUE),
            'harga_masuk' => $this->input->post('harga_masuk', TRUE),
            'parkir' => $this->input->post('parkir', TRUE),
            'fasilitas' => $this->input->post('fasilitas', TRUE),
            'map' => $this->input->post('map', TRUE),
            'alamat' => $this->input->post('alamat', TRUE),
            'publish' => $this->input->post('publish') ? 'true' : 'false',
        ];

        // Simpan ke database
        if ($this->wisata_model->update_wisata($id_wisata, $data)) {
            $this->session->set_flashdata('sukses', 'Sukses mengedit wisata');
            redirect('admin/wisata');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal mengedit wisata');
            redirect('admin/wisata');
        }
    }

    public function wisata_delete() {
        $id_wisata = $this->input->post('id_wisata', TRUE);

        if (!$id_wisata) {
            $this->set_output(['status' => 'error', 'message' => 'ID wisata tidak ditemukan.']);
            return;
        }

        // Ambil data wisata berdasarkan ID
        $wisata = $this->wisata_model->get_wisata_by_id_wisata($id_wisata);
        if (!$wisata) {
            $this->set_output(['status' => 'error', 'message' => 'wisata tidak ditemukan.']);
            return;
        }

        // Path lokasi file
        $thumbnail_path = './uploads/thumbnail_wisata/' . $wisata->thumbnail_wisata;

        // Hapus file thumbnail jika ada
        if ($wisata->thumbnail_wisata && file_exists($thumbnail_path)) {
            unlink($thumbnail_path);
        }

        // Hapus dari database
        if ($this->wisata_model->delete_wisata($id_wisata)) {
            $this->set_output(['status' => 'success', 'message' => 'wisata berhasil dihapus!']);
        } else {
            $this->set_output(['status' => 'error', 'message' => 'Gagal menghapus wisata.']);
        }
    }
}