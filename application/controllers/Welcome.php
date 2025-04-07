<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$data['kategori'] = $this->kategori_model->get_kategori();
		$data['unggulan'] = $this->kategori_model->get_kategori_by_unggulan();
		// var_dump($data['unggulan']);
		// die();
		// $data['wisata'] = $this->wisata_model->get_wisata();
		$data['iklan'] = $this->iklan_model->get_iklan();
		$this->load->view('user/home',$data);
	}

	public function kategori($nama_kategori)
	{
		$data['kategori'] = $this->kategori_model->get_kategori_by_nama_kategori($nama_kategori);
		$data['wisata'] = $this->wisata_model->get_wisata_by_kategori($data['kategori']->id_kategori);
		$this->load->view('user/kategori',$data);
	}

	public function wisata($nama_wisata)
	{
		$data['wisata'] = $this->wisata_model->get_wisata_by_nama_wisata($nama_wisata);
		$data['wisata_serupa'] = $this->wisata_model->get_wisata_by_kategori($data['wisata']->kategori);
		$data['galeri'] = $this->galeri_model->get_galeri_by_id_wisata($data['wisata']->id_wisata);
		$this->load->view('user/wisata',$data);
	}
}
