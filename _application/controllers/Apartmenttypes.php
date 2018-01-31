<?php
class Apartmenttypes extends My_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('modelapartment_types');
    }

    protected function middleware() {
        return array('token_auth', 'parameter_validation');
    }

    function index_get($id ='') { 
        if(empty($id)) {
            $data=$this->modelapartment_types->get_types($this->middlewares['parameter_validation']->get_to(),$this->middlewares['parameter_validation']->get_from());
            if ($data){
                $this->send_response(REST_Controller::HTTP_OK, $data);
            }else{
                $this->send_response(REST_Controller::HTTP_NO_CONTENT);
            }
        }else{
            $data=$this->modelapartment_types->get_type($id);
            $this->send_response(REST_Controller::HTTP_OK, $data);
        }
    }

    function index_post(){
        $param=array(
            'apartment_unit_type_name'=>$this->post('apartment_unit_type_name')
        );
        $insert=$this->dbmodel->insert('mo_info_apartment_unit_type',$param);
        if ($insert){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_put(){
        $id=$this->put('apartment_unit_type_id');
        $param=array(
            'apartment_unit_type_name'=>$this->put('apartment_unit_type_name'),
        );
        $update=$this->dbmodel->update($param,'mo_info_apartment_unit_type','apartment_unit_type_id',$id);
        if ($update){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_delete($id = null){
        if (!empty($id)){
            if ($this->modelapartment_types->get_type($id)){
                $delete=$this->dbmodel->delete('mo_info_apartment_unit_type','apartment_unit_type_id='. $id);
                $this->send_response(REST_Controller::HTTP_OK);
            }else{
                $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
