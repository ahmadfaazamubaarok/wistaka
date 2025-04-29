<?php
class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('admin')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['total_wisata'] = $this->wisata_model->count_wisata();
        $data['total_artikel'] = $this->artikel_model->count_artikel();
        $data['total_kategori'] = $this->kategori_model->count_kategori();
        $data['total_iklan'] = $this->iklan_model->count_iklan();
        $this->load->view('admin/dashboard/dashboard_view',$data);
    }
}