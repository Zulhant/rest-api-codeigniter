<?php
class Cities extends My_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('model_city');
    }

    protected function middleware() {
        return array('token_auth', 'parameter_validation');
    }

    function index_get($id ='') { 
        if(empty($id)) {
            $data=$this->model_city->get_cities($this->middlewares['parameter_validation']->get_to(),$this->middlewares['parameter_validation']->get_from());
            if ($data){
                $this->send_response(REST_Controller::HTTP_OK, $data);
            }else{
                $this->send_response(REST_Controller::HTTP_NO_CONTENT);
            }
        }else{
            $data=$this->model_city->get_city($id);
            $this->send_response(REST_Controller::HTTP_OK, $data);
        }
    }

    function index_post(){
        $param=array(
            'city_name'=>$this->post('city_name'),
            'city_province_id'=>$this->post('city_province_id')
        );
        $insert=$this->dbmodel->insert('mo_info_city',$param);
        if ($insert){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_put(){
        $id=$this->put('city_id');
        $param=array(
            'city_name'=>$this->put('city_name'),
            'city_province_id'=>$this->put('city_province_id')
        );
        $update=$this->dbmodel->update($param,'mo_info_city','city_id',$id);
        if ($update){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function districts_get($id=null){
        $data=$this->model_city->get_cities_districtst($id);
        $this->send_response(REST_Controller::HTTP_OK, $data);
    } 

    function index_delete($id = null){
        if (!empty($id)){
            if ($this->model_city->get_city($id)){
                $delete=$this->dbmodel->delete('mo_info_city','city_id='. $id);
                $this->send_response(REST_Controller::HTTP_OK);
            }else{
                $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
