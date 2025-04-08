<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artikel extends CI_Controller {

	public function artikel_detail($slug)
	{
		$data['artikel'] = $this->artikel_model->get_artikel_by_slug($slug);
		$this->load->view('user/artikel/artikel_detail',$data);
	}
}