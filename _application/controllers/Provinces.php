<?php
class Provinces extends My_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('province_model');
    }

    protected function middleware() {
        return array('token_auth', 'parameter_validation');
    }

    function index_get($id ='') { 
        if(empty($id)) {
            $data=$this->province_model->get_provinces($this->middlewares['parameter_validation']->get_to(),$this->middlewares['parameter_validation']->get_from());
            if ($data){
                $this->send_response(REST_Controller::HTTP_OK, $data);
            }else{
                $this->send_response(REST_Controller::HTTP_NO_CONTENT);
            }
        }else{
            $data=$this->province_model->get_province($id);
            $this->send_response(REST_Controller::HTTP_OK, $data);
        }
    }

    function index_post(){
        $param=array(
            'province_name'=>$this->post('province_name'),
            'province_country_id'=>$this->post('province_country_id')
        );
        $insert=$this->dbmodel->insert('mo_info_province',$param);
        if ($insert){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function cities_get($id=null){
        $data=$this->province_model->get_provinces_cities($id);
        $this->send_response(REST_Controller::HTTP_OK, $data);
    } 

    function index_put(){
        $id=$this->put('province_id');
        $param=array(
            'province_name'=>$this->put('province_name'),
            'province_country_id'=>$this->put('province_country_id')
        );
        $update=$this->dbmodel->update($param,'mo_info_province','province_id',$id);
        if ($update){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_delete($id = null){
        if (!empty($id)){
            if ($this->province_model->get_apartment($id)){
                 $delete=$this->dbmodel->delete('mo_info_province','province_id='. $id .'');
                 $this->send_response(REST_Controller::HTTP_OK);
            }else{
                 $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
