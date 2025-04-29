<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontribusi extends CI_Controller {

	public function index()
	{
		$this->load->view('user/kontribusi/home');
	}

	public function wisata()
    {
        $data['kategori'] = $this->kategori_model->get_kategori();
        $this->load->view('user/kontribusi/wisata',$data);
    }

    public function event()
    {
        $this->load->view('user/kontribusi/event');
    }

    private function generate_slug($string)
    {
        $slug = strtolower(trim($string));
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug); // Hapus karakter aneh
        $slug = preg_replace('/[\s-]+/', '-', $slug);      // Ganti spasi dan minus ganda jadi satu minus
        $slug = trim($slug, '-');                          // Hapus minus di awal/akhir
        return $slug;
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

            //kirim email otomatis
            $this->load->library('email'); // Ini otomatis load config/email.php

            //email ke user
			$this->email->from('wistakatrip@gmail.com', 'Admin Wisata');
			$this->email->to($data['kontak']);
			$this->email->subject('Konfirmasi Penambahan Wisata di Wistakatrip.com');

			$message = "
			    <h3>Terima kasih telah menambahkan wisata!</h3>
			    <p>Berikut detail wisata Anda:</p>
			    <ul>
			        <li><b>Nama Wisata:</b> {$data['nama_wisata']}</li>
			        <li><b>Deskripsi:</b> {$data['deskripsi_wisata']}</li>
			        <li><b>Jam Buka:</b> {$data['jam_buka']}</li>
			        <li><b>Harga Masuk:</b> Rp. {$data['harga_masuk']}</li>
			        <li><b>Alamat:</b> {$data['alamat']}</li>
			    </ul>
			    <p>Wisata Anda akan segera kami review sebelum dipublish.</p>
			";

			$this->email->message($message);

			if (!$this->email->send()) {
			    log_message('error', 'Email gagal dikirim: ' . $this->email->print_debugger());
			}

            //email ke admin
            $this->email->from('wistakatrip@gmail.com', 'Admin Wisata');
            $this->email->to('wistakatrip@gmail.com');
            $this->email->subject('Konfirmasi Penambahan Wisata baru oleh user');

            $message = "
                <h3>".$data['kontak']." barusaja menambahkan wisata baru.</h3>
                <p>Berikut detail wisata:</p>
                <ul>
                    <li><b>Nama Wisata:</b> {$data['nama_wisata']}</li>
                    <li><b>Deskripsi:</b> {$data['deskripsi_wisata']}</li>
                    <li><b>Jam Buka:</b> {$data['jam_buka']}</li>
                    <li><b>Harga Masuk:</b> Rp. {$data['harga_masuk']}</li>
                    <li><b>Alamat:</b> {$data['alamat']}</li>
                </ul>
                <p>Silakan direview sebelum dipublish.</p>
            ";

            $this->email->message($message);

            if (!$this->email->send()) {
                log_message('error', 'Email gagal dikirim: ' . $this->email->print_debugger());
            }

	        redirect('kontribusi/konfirmasi');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal menambahkan wisata');
	        redirect('kontribusi/konfirmasi');
        }
    }

    public function event_addsave() {
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
            redirect('kontribusi/event');
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
            'waktu_selesai'  => $this->input->post('waktu_selesai'),
            'publish'        => 'false'
        ];

        if ($this->event_model->insert_event($data)) {
            $this->session->set_flashdata('sukses','Sukses menambahkan event');

            //kirim email otomatis
            $this->load->library('email'); // Ini otomatis load config/email.php

            //email ke user
            $this->email->from('wistakatrip@gmail.com', 'Admin Wisata');
            $this->email->to($this->input->post('email'));
            $this->email->subject('Konfirmasi Penambahan Event di Wistakatrip.com');

            $message = "
                <h3>Terima kasih telah menambahkan event!</h3>
                <p>Berikut detail event Anda:</p>
                <ul>
                    <li><b>Nama Event:</b> {$data['nama_event']}</li>
                    <li><b>Mulai:</b> {$data['waktu_mulai']}</li>
                    <li><b>Hingga:</b> {$data['waktu_selesai']}</li>
                    <li><b>Deskripsi:</b> {$data['teks']}</li>
                </ul>
                <p>Event Anda akan segera kami review sebelum dipublish.</p>
            ";

            $this->email->message($message);

            if (!$this->email->send()) {
                log_message('error', 'Email gagal dikirim: ' . $this->email->print_debugger());
            }

            //email ke admin
            $this->email->from('wistakatrip@gmail.com', 'Admin Wisata');
            $this->email->to('wistakatrip@gmail.com');
            $this->email->subject('Konfirmasi Penambahan Event di Wistakatrip.com');

            $message = "
                <h3>".$this->input->post('email')." barusaja menambahkan event!</h3>
                <p>Berikut detail event:</p>
                <ul>
                    <li><b>Nama Event:</b> {$data['nama_event']}</li>
                    <li><b>Mulai:</b> {$data['waktu_mulai']}</li>
                    <li><b>Hingga:</b> {$data['waktu_selesai']}</li>
                    <li><b>Deskripsi:</b> {$data['teks']}</li>
                </ul>
                <p>Event segera direview sebelum dipublish.</p>
            ";

            $this->email->message($message);

            if (!$this->email->send()) {
                log_message('error', 'Email gagal dikirim: ' . $this->email->print_debugger());
            }
        } else {
            $this->session->set_flashdata('gagal','Gagal menambahkan event');
        }

        redirect('kontribusi/konfirmasi');
    }

    public function konfirmasi()
    {
        $this->load->view('user/kontribusi/konfirmasi');
    }
}