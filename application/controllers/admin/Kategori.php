<?php
class Kategori extends CI_Controller {

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

    private function generate_slug($string) 
    {
        $slug = strtolower(trim($string));
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug); // Hapus karakter aneh
        $slug = preg_replace('/[\s-]+/', '-', $slug);      // Ganti spasi dan minus ganda jadi satu minus
        $slug = trim($slug, '-');                          // Hapus minus di awal/akhir
        return $slug;
    }

    public function index()
    {
        $this->load->view('admin/kategori/kategori_view');
    }

    public function kategori_daftar()
    {
        $data['kategori'] = $this->kategori_model->get_kategori();
        $this->load->view('admin/kategori/kategori_daftar',$data);
    }

    public function kategori_add()
    {
        $this->load->view('admin/kategori/kategori_add');
    }

    public function kategori_edit($id_kategori)
    {
        $data['kategori'] = $this->kategori_model->get_kategori_by_id_kategori($id_kategori);
        $this->load->view('admin/kategori/kategori_edit',$data);
    }

    public function kategori_addsave() 
    {
        $this->load->library('upload');
        header('Content-Type: application/json');

        $id_kategori = 'KT' . date('ymdhis');

        $thumbnail_path = './uploads/thumbnail_kategori/';
        $ikon_path = './uploads/ikon_kategori/';

        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048;

        if (!is_dir($thumbnail_path)) mkdir($thumbnail_path, 0777, true);
        if (!is_dir($ikon_path)) mkdir($ikon_path, 0777, true);

        $thumbnail_kategori = '';
        $ikon_kategori = '';

        // ==== Upload Thumbnail ====
        if (!empty($_FILES['thumbnail_kategori']['name'])) {
            $config['upload_path'] = $thumbnail_path;
            $this->upload->initialize($config);

            if ($this->upload->do_upload('thumbnail_kategori')) {
                $thumbnail_data = $this->upload->data();
                $thumbnail_kategori = $thumbnail_data['file_name'];
            } else {
                $error = $this->upload->display_errors('', '');
                $this->set_output(['status' => 'error', 'message' => 'Upload thumbnail gagal: ' . $error]);
                return;
            }
        }

        // ==== Upload Ikon ====
        if (!empty($_FILES['ikon_kategori']['name'])) {
            $config['upload_path'] = $ikon_path;
            $this->upload->initialize($config);

            if ($this->upload->do_upload('ikon_kategori')) {
                $ikon_data = $this->upload->data();
                $ikon_kategori = $ikon_data['file_name'];
            } else {
                $error = $this->upload->display_errors('', '');
                $this->set_output(['status' => 'error', 'message' => 'Upload ikon gagal: ' . $error]);
                return;
            }
        }

        $nama_kategori = $this->input->post('nama_kategori', TRUE);
        $slug = $this->generate_slug($nama_kategori);

        $data = [
            'id_kategori' => $id_kategori,
            'nama_kategori' => $nama_kategori,
            'slug' => $slug,
            'thumbnail_kategori' => $thumbnail_kategori,
            'ikon_kategori' => $ikon_kategori,
            'unggulan' => 'false'
        ];

        if ($this->kategori_model->insert_kategori($data)) {
            $this->set_output(['status' => 'success', 'message' => 'Kategori berhasil ditambahkan!']);
        } else {
            $this->set_output(['status' => 'error', 'message' => 'Gagal menambahkan kategori.']);
        }
    }

    public function kategori_editsave() 
    {
        $this->load->library('upload');
        header('Content-Type: application/json');

        $id_kategori = $this->input->post('id_kategori', TRUE);
        $nama_kategori = $this->input->post('nama_kategori', TRUE);
        $slug = $this->generate_slug($nama_kategori);

        if (!$id_kategori || !$nama_kategori) {
            $this->set_output(['status' => 'error', 'message' => 'ID dan nama kategori harus diisi.']);
            return;
        }

        $kategori = $this->kategori_model->get_kategori_by_id_kategori($id_kategori);
        if (!$kategori) {
            $this->set_output(['status' => 'error', 'message' => 'Kategori tidak ditemukan.']);
            return;
        }

        $thumbnail_path = './uploads/thumbnail_kategori/';
        $ikon_path = './uploads/ikon_kategori/';
        $background_unggulan_path = './uploads/background_unggulan/';

        if (!is_dir($thumbnail_path)) mkdir($thumbnail_path, 0777, true);
        if (!is_dir($ikon_path)) mkdir($ikon_path, 0777, true);
        if (!is_dir($background_unggulan_path)) mkdir($background_unggulan_path, 0777, true);

        $thumbnail_kategori = $kategori->thumbnail_kategori;
        $ikon_kategori = $kategori->ikon_kategori;
        $background_unggulan_nama = $kategori->background_unggulan;

        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048;

        // Upload Thumbnail
        if (!empty($_FILES['thumbnail_kategori']['name'])) {
            $config['upload_path'] = $thumbnail_path;
            $this->upload->initialize($config);
            if ($this->upload->do_upload('thumbnail_kategori')) {
                if ($thumbnail_kategori && file_exists($thumbnail_path . $thumbnail_kategori)) {
                    unlink($thumbnail_path . $thumbnail_kategori);
                }
                $thumbnail_kategori = $this->upload->data('file_name');
            } else {
                $this->set_output(['status' => 'error', 'message' => 'Upload thumbnail gagal: ' . $this->upload->display_errors('', '')]);
                return;
            }
        }

        // Upload Ikon
        if (!empty($_FILES['ikon_kategori']['name'])) {
            $config['upload_path'] = $ikon_path;
            $this->upload->initialize($config);
            if ($this->upload->do_upload('ikon_kategori')) {
                if ($ikon_kategori && file_exists($ikon_path . $ikon_kategori)) {
                    unlink($ikon_path . $ikon_kategori);
                }
                $ikon_kategori = $this->upload->data('file_name');
            } else {
                $this->set_output(['status' => 'error', 'message' => 'Upload ikon gagal: ' . $this->upload->display_errors('', '')]);
                return;
            }
        }

        $unggulan = $this->input->post('unggulan') === 'true' ? 'true' : 'false';

        // Upload Background Unggulan
        if ($unggulan === 'true' && !empty($_FILES['background_unggulan']['name'])) {
            $config['upload_path'] = $background_unggulan_path;
            $this->upload->initialize($config);

            if ($this->upload->do_upload('background_unggulan')) {
                if (!empty($background_unggulan_nama) && file_exists($background_unggulan_path . $background_unggulan_nama)) {
                    unlink($background_unggulan_path . $background_unggulan_nama);
                }
                $background_unggulan_nama = $this->upload->data('file_name');
            } else {
                $this->set_output(['status' => 'error', 'message' => 'Upload background unggulan gagal: ' . $this->upload->display_errors('', '')]);
                return;
            }
        }

        $data = [
            'nama_kategori' => $nama_kategori,
            'slug' => $slug,
            'thumbnail_kategori' => $thumbnail_kategori,
            'ikon_kategori' => $ikon_kategori,
            'unggulan' => $unggulan,
            'background_unggulan' => $background_unggulan_nama
        ];

        if ($this->kategori_model->update_kategori($id_kategori, $data)) {
            $this->set_output(['status' => 'success', 'message' => 'Kategori berhasil diperbarui!']);
        } else {
            $this->set_output(['status' => 'error', 'message' => 'Gagal memperbarui kategori.']);
        }
    }

    public function kategori_delete() 
    {
        $id_kategori = $this->input->post('id_kategori', TRUE);

        if (!$id_kategori) {
            $this->set_output(['status' => 'error', 'message' => 'ID kategori tidak ditemukan.']);
            return;
        }

        // Ambil data kategori berdasarkan ID
        $kategori = $this->kategori_model->get_kategori_by_id_kategori($id_kategori);
        if (!$kategori) {
            $this->set_output(['status' => 'error', 'message' => 'Kategori tidak ditemukan.']);
            return;
        }

        // Ambil data wisata berdasarkan kategori
        $wisata = $this->wisata_model->get_wisata_by_kategori($id_kategori);
        if ($wisata) {
            foreach ($wisata as $w) {
                //hapus galeri
                $galeri = $this->galeri_model->get_galeri_by_wisata($w->id_wisata);
                foreach ($galeri as $key) {
                    unlink('./uploads/galeri/' . $key->galeri);
                    $this->galeri_model->delete_galeri($key->id_galeri);
                }

                // Path lokasi file
                $thumbnail_path = './uploads/thumbnail_wisata/' . $w->thumbnail_wisata;

                // Hapus file thumbnail jika ada
                if ($w->thumbnail_wisata && file_exists($thumbnail_path)) {
                    unlink($thumbnail_path);
                }
                $this->wisata_model->delete_wisata($w->id_wisata);
            }
        }


        // Path file kategori
        $thumbnail_path = './uploads/thumbnail_kategori/' . $kategori->thumbnail_kategori;
        $ikon_path = './uploads/ikon_kategori/' . $kategori->ikon_kategori;
        $background_unggulan_path = './uploads/background_unggulan/' . $kategori->background_unggulan;

        // Hapus file thumbnail jika ada
        if ($kategori->thumbnail_kategori && file_exists($thumbnail_path)) {
            unlink($thumbnail_path);
        }

        // Hapus file ikon jika ada
        if ($kategori->ikon_kategori && file_exists($ikon_path)) {
            unlink($ikon_path);
        }

        // Hapus file background_unggulan jika ada
        if ($kategori->background_unggulan && file_exists($background_unggulan_path)) {
            unlink($background_unggulan_path);
        }

        // Hapus dari database
        if ($this->kategori_model->delete_kategori($id_kategori)) {
            $this->set_output(['status' => 'success', 'message' => 'Kategori berhasil dihapus!']);
        } else {
            $this->set_output(['status' => 'error', 'message' => 'Gagal menghapus kategori.']);
        }
    }
}