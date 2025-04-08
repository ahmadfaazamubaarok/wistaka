<?php
class Artikel extends CI_Controller {

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

    private function generate_slug($string) {
        $slug = strtolower(trim($string));
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug); // Hapus karakter aneh
        $slug = preg_replace('/[\s-]+/', '-', $slug);      // Ganti spasi dan minus ganda jadi satu minus
        $slug = trim($slug, '-');                          // Hapus minus di awal/akhir
        return $slug;
    }

    public function index(){
        $this->load->view('admin/artikel/artikel_view');
    }

    public function artikel_daftar(){
        $data['artikel'] = $this->artikel_model->get_artikel();
        $this->load->view('admin/artikel/artikel_daftar',$data);
    }

    public function artikel_add(){
        $this->load->view('admin/artikel/artikel_add');
    }

    public function artikel_edit($id_artikel){
        $data['artikel'] = $this->artikel_model->get_artikel_by_id_artikel($id_artikel);
        $this->load->view('admin/artikel/artikel_edit',$data);
    }

    public function artikel_addsave() {
        $this->load->library('upload'); // Load library upload
        header('Content-Type: application/json');

        $id_artikel = 'AR' . date('ymdhis');
        $thumbnail_path = './uploads/thumbnail_artikel/';

        // Konfigurasi upload
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']      = 2048; // 2MB
        $config['upload_path']   = $thumbnail_path;

        // Pastikan folder ada
        if (!is_dir($thumbnail_path)) {
            mkdir($thumbnail_path, 0777, true);
        }

        $thumbnail_artikel = '';

        // Upload thumbnail_artikel
        $this->upload->initialize($config);
        if ($this->upload->do_upload('thumbnail_artikel')) {
            $thumbnail_data = $this->upload->data();

            // Rename file dengan menambahkan ID artikel
            $ext = pathinfo($thumbnail_data['file_name'], PATHINFO_EXTENSION);
            $new_filename = $id_artikel . '.' . $ext;

            rename($thumbnail_data['full_path'], $thumbnail_path . $new_filename);

            $thumbnail_artikel = $new_filename;
        } else {
            // Tangani error upload (termasuk ukuran file terlalu besar)
            $error = $this->upload->display_errors('', '');
            if (strpos(strtolower($error), 'exceeds the maximum allowed size') !== false) {
                $this->session->set_flashdata('gagal', 'Ukuran file terlalu besar. Maksimal 2MB.');
            } else {
                $this->session->set_flashdata('gagal', 'Upload gagal: ' . $error);
            }
            redirect('admin/artikel');
            return;
        }

        $judul_artikel = $this->input->post('judul_artikel', TRUE);
        $slug = $this->generate_slug($judul_artikel); // Slug otomatis

        $data = [
            'id_artikel' => $id_artikel,
            'judul_artikel' => $this->input->post('judul_artikel', TRUE),
            'slug' => $slug,
            'thumbnail_artikel' => $thumbnail_artikel,
            'teks' => $this->input->post('text', TRUE),
            'waktu_terbit' => date('Y-m-d'),
            'draft' => $this->input->post('draft')
        ];

        if ($this->artikel_model->insert_artikel($data)) {
            $this->session->set_flashdata('sukses','Sukses menambahkan artikel');
        } else {
            $this->session->set_flashdata('gagal','Gagal menambahkan artikel');
        }

        redirect('admin/artikel');
    }

    public function artikel_editsave() {
        $this->load->library('upload');
        header('Content-Type: application/json');

        $id_artikel = $this->input->post('id_artikel', TRUE);
        $judul_artikel = $this->input->post('judul_artikel', TRUE);

        if (!$id_artikel || !$judul_artikel) {
            $this->set_output(['status' => 'error', 'message' => 'ID dan judul artikel harus diisi.']);
            return;
        }

        $artikel = $this->artikel_model->get_artikel_by_id_artikel($id_artikel);
        if (!$artikel) {
            $this->set_output(['status' => 'error', 'message' => 'Artikel tidak ditemukan.']);
            return;
        }

        $thumbnail_path = './uploads/thumbnail_artikel/';
        if (!is_dir($thumbnail_path)) mkdir($thumbnail_path, 0777, true);

        $thumbnail_artikel = $artikel->thumbnail_artikel;

        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048; // 2MB
        $config['upload_path'] = $thumbnail_path;

        // Upload Thumbnail (Jika Ada)
        if (!empty($_FILES['thumbnail_artikel']['name'])) {
            $this->upload->initialize($config);
            if ($this->upload->do_upload('thumbnail_artikel')) {
                // Hapus file lama
                if ($thumbnail_artikel && file_exists($thumbnail_path . $thumbnail_artikel)) {
                    unlink($thumbnail_path . $thumbnail_artikel);
                }

                // Rename file dengan mengganti nama menjadi ID artikel
                $thumbnail_data = $this->upload->data();
                $ext = pathinfo($thumbnail_data['file_name'], PATHINFO_EXTENSION);
                $new_filename = $id_artikel . '.' . $ext;
                rename($thumbnail_data['full_path'], $thumbnail_path . $new_filename);

                $thumbnail_artikel = $new_filename;
            } else {
                $error = $this->upload->display_errors('', '');
                if (strpos(strtolower($error), 'exceeds the maximum allowed size') !== false) {
                    $error = 'Ukuran file terlalu besar. Maksimal 2MB.';
                }
                $this->set_output(['status' => 'error', 'message' => $error]);
                return;
            }
        }

        $judul_artikel = $this->input->post('judul_artikel', TRUE);
        $slug = $this->generate_slug($judul_artikel); // Slug otomatis

        $data = [
            'judul_artikel' => $judul_artikel,
            'slug' => $slug,
            'thumbnail_artikel' => $thumbnail_artikel,
            'teks' => $this->input->post('text', TRUE),
            'draft' => $this->input->post('draft', TRUE)
        ];

        if ($this->artikel_model->update_artikel($id_artikel, $data)) {
            $this->session->set_flashdata('sukses','Sukses mengubah artikel');
        } else {
            $this->session->set_flashdata('gagal','Gagal mengubah artikel');
        }

        redirect('admin/artikel');
    }

    public function artikel_delete() {
        $id_artikel = $this->input->post('id_artikel', TRUE);

        if (!$id_artikel) {
            $this->set_output(['status' => 'error', 'message' => 'ID artikel tidak ditemukan.']);
            return;
        }

        // Ambil data artikel berdasarkan ID
        $artikel = $this->artikel_model->get_artikel_by_id_artikel($id_artikel);
        if (!$artikel) {
            $this->set_output(['status' => 'error', 'message' => 'artikel tidak ditemukan.']);
            return;
        }

        // Path lokasi file
        $thumbnail_path = './uploads/thumbnail_artikel/' . $artikel->thumbnail_artikel;

        // Hapus file thumbnail jika ada
        if ($artikel->thumbnail_artikel && file_exists($thumbnail_path)) {
            unlink($thumbnail_path);
        }

        // Hapus dari database
        if ($this->artikel_model->delete_artikel($id_artikel)) {
            $this->set_output(['status' => 'success', 'message' => 'artikel berhasil dihapus!']);
        } else {
            $this->set_output(['status' => 'error', 'message' => 'Gagal menghapus artikel.']);
        }
    }
}