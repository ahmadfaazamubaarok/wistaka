<?php
class Wisata extends CI_Controller {

    private function set_output($data)
    {
        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data, JSON_PRETTY_PRINT))
                ->_display();
        exit;
    }

    public function search()
    {
        $keyword = $this->input->post('search', TRUE); // atau bisa pakai POST
        $data['wisata'] = $this->wisata_model->search_wisata($keyword);

        $this->load->view('user/list_wisata',$data);
    }
}