<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('user/welcome');
	}

	public function home()
	{
		$data['kategori'] = $this->kategori_model->get_kategori();
		$data['unggulan'] = $this->kategori_model->get_kategori_by_unggulan();
		$data['artikel'] = $this->artikel_model->get_artikel();
		$data['iklan'] = $this->iklan_model->get_iklan();
		$this->load->view('user/home',$data);
	}

	public function kategori($slug)
	{
		$data['kategori'] = $this->kategori_model->get_kategori_by_slug($slug);
		$data['wisata'] = $this->wisata_model->get_wisata_by_kategori($data['kategori']->id_kategori);
		$this->load->view('user/kategori',$data);
	}

	public function wisata($slug)
	{
		$data['wisata'] = $this->wisata_model->get_wisata_by_slug($slug);
		$data['wisata_serupa'] = $this->wisata_model->get_wisata_by_kategori($data['wisata']->kategori);
		$data['galeri'] = $this->galeri_model->get_galeri_by_wisata($data['wisata']->id_wisata);
		$this->load->view('user/wisata',$data);
	}
}
