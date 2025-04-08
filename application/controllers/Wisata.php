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

    public function daftar()
    {
        $data['kategori'] = $this->kategori_model->get_kategori();
        $this->load->view('user/form',$data);
    }

    public function wisata_addsave()
    {
        $this->load->library('upload');
        header('Content-Type: application/json');

        $id_wisata = 'WS' . date('ymdhis');
        $thumbnail_path = './uploads/thumbnail_wisata/';
        $galeri_path = './uploads/galeri/';

        // Konfigurasi upload thumbnail
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']      = 2048;
        $config['upload_path']   = $thumbnail_path;

        if (!is_dir($thumbnail_path)) mkdir($thumbnail_path, 0777, true);
        if (!is_dir($galeri_path)) mkdir($galeri_path, 0777, true);

        $thumbnail_wisata = '';

        if (!empty($_FILES['thumbnail_wisata']['name'])) {
            $this->upload->initialize($config);
            if ($this->upload->do_upload('thumbnail_wisata')) {
                $thumbnail_data = $this->upload->data();
                $ext = pathinfo($thumbnail_data['file_name'], PATHINFO_EXTENSION);
                $new_filename = $id_wisata . '.' . $ext;
                rename($thumbnail_data['full_path'], $thumbnail_path . $new_filename);
                $thumbnail_wisata = $new_filename;
            } else {
                $error = $this->upload->display_errors('', '');
                $this->set_output(['status' => 'error', 'message' => $error]);
                return;
            }
        }

        // Simpan data wisata
        $data = [
            'kontak'            => $this->input->post('kontak', TRUE),
            'id_wisata'         => $id_wisata,
            'kategori'          => $this->input->post('kategori', TRUE),
            'thumbnail_wisata'  => $thumbnail_wisata,
            'nama_wisata'       => $this->input->post('nama_wisata', TRUE),
            'deskripsi_wisata'  => $this->input->post('deskripsi_wisata', TRUE),
            'jam_buka'          => $this->input->post('jam_buka', TRUE),
            'harga_masuk'       => $this->input->post('harga_masuk', TRUE),
            'parkir'            => $this->input->post('parkir', TRUE),
            'fasilitas'         => $this->input->post('fasilitas', TRUE),
            'map'               => $this->input->post('map', TRUE),
            'alamat'            => $this->input->post('alamat', TRUE),
            'publish'           => 'false'
        ];

        $this->load->model('galeri_model');

        if ($this->wisata_model->insert_wisata($data)) {

            // 🔁 Upload multiple galeri
            if (!empty($_FILES['galeri']['name'][0])) {
                $files = $_FILES['galeri'];
                $total = count($files['name']);

                for ($i = 0; $i < $total; $i++) {
                    $_FILES['file']['name']     = $files['name'][$i];
                    $_FILES['file']['type']     = $files['type'][$i];
                    $_FILES['file']['tmp_name'] = $files['tmp_name'][$i];
                    $_FILES['file']['error']    = $files['error'][$i];
                    $_FILES['file']['size']     = $files['size'][$i];

                    $config['upload_path'] = $galeri_path;
                    $config['encrypt_name'] = TRUE;

                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('file')) {
                        $upload_data = $this->upload->data();
                        $galeri_data = [
                            'id_galeri' => uniqid(),
                            'wisata' => $id_wisata,
                            'galeri' => $upload_data['file_name']
                        ];
                        $this->galeri_model->insert_galeri($galeri_data);
                    }
                }
            }

            $this->session->set_flashdata('sukses_tambah_wisata', 'Sukses menambahkan wisata');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal menambahkan wisata');
        }
        redirect('welcome');
    }

    public function search()
    {
        $keyword = $this->input->post('search', TRUE); // atau bisa pakai POST
        $data['wisata'] = $this->wisata_model->search_wisata($keyword);

        $this->load->view('user/list_wisata',$data);
    }
}