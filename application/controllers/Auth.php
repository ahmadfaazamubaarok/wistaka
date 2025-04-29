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
			$this->session->set_userdata('admin',$user);
			redirect('admin/dashboard');
		} else {
			$this->session->set_flashdata('gagal','Data login yang dimasukkan salah');
			redirect('auth');
		}
	}

	public function login_user()
	{
		include_once FCPATH . 'vendor/autoload.php';

		$google_client = new Google_Client();

		$google_client->setClientId('376969434539-0eeg3cdjqlsbcmticf1dfsuf4j2ng853.apps.googleusercontent.com');
		$google_client->setClientSecret('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');
		$google_client->setRedirectUri('http://localhost/wistaka/auth/login_user');

		$google_client->addScope('email');
		$google_client->addScope('profile');

		if (isset($_GET['code'])) {
			$token = $google_client->fetchAccessTokenWithAuthCode($_GET['code']);

			if (!isset($token['error'])) {
				$google_client->setAccessToken($token['access_token']);
				$this->session->userdata('access_token',$token['access_token']);

				$google_service = new Google_Service_Oauth2($google_client);

				$data = $google_service->userinfo->get();

				$current_datetime = date('Y-m-d H:i:s');

				if($this->google_login_model->Is_already_register($data['id'])){
					//update data
					$user_data = array(
						'first_name'		=> $data['given_name'],
						'last_name'			=> $data['family_name'],
						'email_address'		=> $data['email'],
						'profile_picture'	=> $data['picture'],
						'update_at'			=> $current_datetime
					);
					$this->google_login_model->update_user_data($user_data,$data['id']);
				} else {
					//tambah data
					$user_data = array(
						'id_user'			=> 'US'.date('ymdhis'),
						'login_oauth_uid'	=> $data['id'],
						'first_name'		=> $data['given_name'],
						'last_name'			=> $data['family_name'],
						'email_address'		=> $data['email'],
						'profile_picture'	=> $data['picture'],
						'created_at'		=> $current_datetime
					);
					$this->google_login_model->insert_user_data($user_data);
				}
				$this->session->set_userdata('user',$user_data);
				redirect('kontribusi/');
			}
		}
		if (!$this->session->userdata('access_token')) {
			$login_url = $google_client->createAuthUrl();
		}
		$data['login_url'] = $login_url;
		$this->load->view('user/google_login',$data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}

	public function logout_user()
	{
		$this->session->unset_userdata('access_token');
		$this->session->unset_userdata('user');
		redirect('welcome');
	}
}