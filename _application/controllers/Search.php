<?php
class Search extends My_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('Search_Model');
    }

    protected function middleware() {
        return array('token_auth', 'parameter_validation');
    }

    function index_get($id = null) { 
        if($id != null) {
            $data=$this->Search_Model->get_customer($id);
            $this->send_response(REST_Controller::HTTP_OK, $data);
        }
    }
}
