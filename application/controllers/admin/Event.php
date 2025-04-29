<?php
class Event extends CI_Controller {

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
        $this->load->view('admin/event/event_view');
    }

    public function event_daftar()
    {
        $data['event'] = $this->event_model->get_event();
        $this->load->view('admin/event/event_daftar',$data);
    }

    public function event_add()
    {
        $this->load->view('admin/event/event_add');
    }

    public function event_edit($id_event)
    {
        $data['event'] = $this->event_model->get_event_by_id_event($id_event);
        $this->load->view('admin/event/event_edit',$data);
    }

    public function event_addsave()
    {
        $this->load->library('upload'); // Load library upload
        header('Content-Type: application/json');

        $id_event = 'AR' . date('ymdhis');
        $thumbnail_path = './uploads/thumbnail_event/';

        // Konfigurasi upload
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']      = 2048; // 2MB
        $config['upload_path']   = $thumbnail_path;

        // Pastikan folder ada
        if (!is_dir($thumbnail_path)) {
            mkdir($thumbnail_path, 0777, true);
        }

        $thumbnail_event = '';

        // Upload thumbnail_event
        $this->upload->initialize($config);
        if ($this->upload->do_upload('thumbnail_event')) {
            $thumbnail_data = $this->upload->data();

            // Rename file dengan menambahkan ID event
            $ext = pathinfo($thumbnail_data['file_name'], PATHINFO_EXTENSION);
            $new_filename = $id_event . '.' . $ext;

            rename($thumbnail_data['full_path'], $thumbnail_path . $new_filename);

            $thumbnail_event = $new_filename;
        } else {
            // Tangani error upload (termasuk ukuran file terlalu besar)
            $error = $this->upload->display_errors('', '');
            if (strpos(strtolower($error), 'exceeds the maximum allowed size') !== false) {
                $this->session->set_flashdata('gagal', 'Ukuran file terlalu besar. Maksimal 2MB.');
            } else {
                $this->session->set_flashdata('gagal', 'Upload gagal: ' . $error);
            }
            redirect('admin/event');
            return;
        }

        $nama_event = $this->input->post('nama_event', TRUE);
        $slug = $this->generate_slug($nama_event); // Slug otomatis

        $data = [
            'id_event'       => $id_event,
            'nama_event'     => $this->input->post('nama_event', TRUE),
            'slug'           => $slug,
            'thumbnail_event'=> $thumbnail_event,
            'teks'           => $this->input->post('text', TRUE),
            'waktu_mulai'    => $this->input->post('waktu_mulai'),
            'waktu_selesai'  => $this->input->post('waktu_selesai')
        ];

        if ($this->event_model->insert_event($data)) {
            $this->session->set_flashdata('sukses','Sukses menambahkan event');

            //kirim email otomatis
            $this->load->library('email'); // Ini otomatis load config/email.php

            //email ke admin
            $this->email->from('Wistakatrip@gmail.com', 'Admin Wisata');
            $this->email->to('Wistakatrip@gmail.com');
            $this->email->subject('Konfirmasi Penambahan Event di Wistakatrip.com');

            $message = "
                <h3>".$this->session->userdata('admin')->username." barusaja menambahkan event!</h3>
                <p>Berikut detail event:</p>
                <ul>
                    <li><b>Nama Event:</b> {$data['nama_event']}</li>
                    <li><b>Mulai:</b> {$data['waktu_mulai']}</li>
                    <li><b>Hingga:</b> {$data['waktu_selesai']}</li>
                    <li><b>Deskripsi:</b> {$data['teks']}</li>
                </ul>
            ";

            $this->email->message($message);

            if (!$this->email->send()) {
                log_message('error', 'Email gagal dikirim: ' . $this->email->print_debugger());
            }

        } else {
            $this->session->set_flashdata('gagal','Gagal menambahkan event');
        }

        redirect('admin/event');
    }

    public function event_editsave()
    {
        $this->load->library('upload');
        header('Content-Type: application/json');

        $id_event = $this->input->post('id_event', TRUE);
        $nama_event = $this->input->post('nama_event', TRUE);

        if (!$id_event || !$nama_event) {
            $this->set_output(['status' => 'error', 'message' => 'ID dan nama event harus diisi.']);
            return;
        }

        $event = $this->event_model->get_event_by_id_event($id_event);
        if (!$event) {
            $this->set_output(['status' => 'error', 'message' => 'event tidak ditemukan.']);
            return;
        }

        $thumbnail_path = './uploads/thumbnail_event/';
        if (!is_dir($thumbnail_path)) mkdir($thumbnail_path, 0777, true);

        $thumbnail_event = $event->thumbnail_event;

        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048; // 2MB
        $config['upload_path'] = $thumbnail_path;

        // Upload Thumbnail (Jika Ada)
        if (!empty($_FILES['thumbnail_event']['name'])) {
            $this->upload->initialize($config);
            if ($this->upload->do_upload('thumbnail_event')) {
                // Hapus file lama
                if ($thumbnail_event && file_exists($thumbnail_path . $thumbnail_event)) {
                    unlink($thumbnail_path . $thumbnail_event);
                }

                // Rename file dengan mengganti nama menjadi ID event
                $thumbnail_data = $this->upload->data();
                $ext = pathinfo($thumbnail_data['file_name'], PATHINFO_EXTENSION);
                $new_filename = $id_event . '.' . $ext;
                rename($thumbnail_data['full_path'], $thumbnail_path . $new_filename);

                $thumbnail_event = $new_filename;
            } else {
                $error = $this->upload->display_errors('', '');
                if (strpos(strtolower($error), 'exceeds the maximum allowed size') !== false) {
                    $error = 'Ukuran file terlalu besar. Maksimal 2MB.';
                }
                $this->set_output(['status' => 'error', 'message' => $error]);
                return;
            }
        }

        $nama_event = $this->input->post('nama_event', TRUE);
        $slug = $this->generate_slug($nama_event); // Slug otomatis

        $data = [
            'nama_event'     => $nama_event,
            'slug'           => $slug,
            'thumbnail_event'=> $thumbnail_event,
            'teks'           => $this->input->post('text', TRUE),
            'waktu_mulai'    => $this->input->post('waktu_mulai'),
            'waktu_selesai'  => $this->input->post('waktu_selesai'),
            'publish'        => $this->input->post('publish')
        ];

        if ($this->event_model->update_event($id_event, $data)) {
            $this->session->set_flashdata('sukses','Sukses mengubah event');
        } else {
            $this->session->set_flashdata('gagal','Gagal mengubah event');
        }

        redirect('admin/event');
    }

    public function event_delete()
    {
        $id_event = $this->input->post('id_event', TRUE);

        if (!$id_event) {
            $this->set_output(['status' => 'error', 'message' => 'ID event tidak ditemukan.']);
            return;
        }

        // Ambil data event berdasarkan ID
        $event = $this->event_model->get_event_by_id_event($id_event);
        if (!$event) {
            $this->set_output(['status' => 'error', 'message' => 'event tidak ditemukan.']);
            return;
        }

        // Path lokasi file
        $thumbnail_path = './uploads/thumbnail_event/' . $event->thumbnail_event;

        // Hapus file thumbnail jika ada
        if ($event->thumbnail_event && file_exists($thumbnail_path)) {
            unlink($thumbnail_path);
        }

        // Hapus dari database
        if ($this->event_model->delete_event($id_event)) {
            $this->set_output(['status' => 'success', 'message' => 'event berhasil dihapus!']);
        } else {
            $this->set_output(['status' => 'error', 'message' => 'Gagal menghapus event.']);
        }
    }
}