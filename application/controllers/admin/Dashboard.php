<?php
class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user')) {
            redirect('auth');
        }
    }

    public function index(){
         $this->load->view('admin/dashboard/dashboard_view');
    }
}