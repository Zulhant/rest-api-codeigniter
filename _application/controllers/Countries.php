<?php
class Countries extends My_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('model_countries');
    }

    protected function middleware() {
        return array('token_auth', 'parameter_validation');
    }

    function index_get($id ='') { 
        if(empty($id)) {
            $data=$this->model_countries->get_countries($this->middlewares['parameter_validation']->get_to(),$this->middlewares['parameter_validation']->get_from());
            if ($data){
                $this->send_response(REST_Controller::HTTP_OK, $data);
            }else{
                $this->send_response(REST_Controller::HTTP_NO_CONTENT);
            }
        }else{
            $data=$this->model_countries->get_country($id);
            $this->send_response(REST_Controller::HTTP_OK, $data);
        }
    }

    function index_post(){
        $param=array(
            'country_name'=>$this->post('country_name')
        );
        $insert=$this->dbmodel->insert('mo_info_country',$param);
        if ($insert){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_put(){
        $id=$this->put('country_id');
        $param=array(
            'country_name'=>$this->put('country_name')
        );
        $update=$this->dbmodel->update($param,'mo_info_country','country_id',$id);
        if ($update){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function province_get($id=null){
        $data=$this->model_countries->get_country_province($id);
        $this->send_response(REST_Controller::HTTP_OK, $data);
    } 

    function index_delete($id = null){
        if (!empty($id)){
            if ($this->model_countries->get_country($id)){
                $delete=$this->dbmodel->delete('mo_info_country','country_id='. $id);
                $this->send_response(REST_Controller::HTTP_OK);
            }else{
                $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
