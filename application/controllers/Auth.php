<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		$this->load->view('admin/login');
	}

	public function login()
	{
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->auth_model->login($username, $email, $password);
		if ($user) {
			$this->session->set_userdata('user',$user);
			redirect('admin/dashboard');
		} else {
			$this->session->set_flashdata('gagal','Data login yang dimasukkan salah');
			redirect('auth');
		}
	}
}