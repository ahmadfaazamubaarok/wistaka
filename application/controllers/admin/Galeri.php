<?php
class Galeri extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user')) {
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

    public function galeri_add($id_wisata)
    {
        $data['id_wisata'] = $id_wisata;
        $data['galeri'] = $this->galeri_model->get_galeri_by_wisata($id_wisata);
        $this->load->view('admin/galeri/galeri_add',$data);
    }

    public function galeri_addsave() {
        $config['upload_path']   = './uploads/galeri/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']      = 2048;
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);

        $files = $_FILES['galeri'];
        $jumlah_files = count($files['name']);

        $response = ['status' => 'success', 'message' => 'Galeri berhasil ditambahkan.'];

        for ($i = 0; $i < $jumlah_files; $i++) {
            if (!empty($files['name'][$i])) {
                $_FILES['file']['name']     = $files['name'][$i];
                $_FILES['file']['type']     = $files['type'][$i];
                $_FILES['file']['tmp_name'] = $files['tmp_name'][$i];
                $_FILES['file']['error']    = $files['error'][$i];
                $_FILES['file']['size']     = $files['size'][$i];

                $this->upload->initialize($config);

                if ($this->upload->do_upload('file')) {
                    $uploadData = $this->upload->data();
                    $data = [
                        'id_galeri' => 'GL'.uniqid(),
                        'wisata'    => $this->input->post('id_wisata',TRUE),
                        'galeri'    => $uploadData['file_name'],
                    ];
                    $this->galeri_model->insert_galeri($data); // Insert satu per satu
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => $this->upload->display_errors(),
                    ];
                    break; // Hentikan jika ada kegagalan upload
                }
            }
        }
        $this->set_output($response);
    }

    public function galeri_delete()
    {
        $id_galeri = $this->input->post('id_galeri');
        $galeri = $this->galeri_model->get_galeri_by_id_galeri($id_galeri);
        if ($galeri) {
            // Path lengkap file gambar yang akan dihapus
            $gambar_path = FCPATH . 'uploads/galeri/' . $galeri->galeri;

            // Cek apakah file ada, lalu hapus
            if (!empty($galeri->galeri) && file_exists($gambar_path)) {
                unlink($gambar_path); // Hapus gambar

                $this->galeri_model->delete_galeri($id_galeri);
                $response = ['status' => 'success', 'message' => 'Galeri berhasil dihapus.'];
            } else {
                // Jika data tidak ditemukan
                $response = ['status' => 'error', 'message' => 'File tidak ditemukan di: ' . $gambar_path];
            }
        } else {
            $response = ['status' => 'error', 'message' => 'Data tidak ditemukan.'];
        }
        $this->set_output($response);
    }
}