<?php
class Facilities extends My_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('facilities_model');
    }

    protected function middleware() {
        return array('token_auth', 'parameter_validation');
    }

    function index_get($id ='') { 
        if(empty($id)) {
            $data=$this->facilities_model->get_facilities($this->middlewares['parameter_validation']->get_to(),$this->middlewares['parameter_validation']->get_from());
            if ($data){
                $this->send_response(REST_Controller::HTTP_OK, $data);
            }else{
                $this->send_response(REST_Controller::HTTP_NO_CONTENT);
            }
        }else{
            $data=$this->facilities_model->get_faciliti($id);
            $this->send_response(REST_Controller::HTTP_OK, $data);
        }
    }


    function index_post(){
        $param=array(
            ' apartment_facility_type_name'=>$this->post('apartment_facility_type_name')
        );
        $insert=$this->dbmodel->insert('mo_info_apartment_facility_type',$param);
        if ($insert){
            $this->send_response(REST_Controller::HTTP_OK, $data);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_put(){
        $id=$this->put('apartment_facility_type_id');
        $param=array(
            ' apartment_facility_type_name'=>$this->post('apartment_facility_type_name')
        );
        $update=$this->dbmodel->update($param,'mo_info_apartment_facility_type','apartment_facility_type_id',$id);
        if ($update){
            $this->send_response(REST_Controller::HTTP_OK, $update);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_delete($id = null){
        if (!empty($id)){
            if ($this->apartment_model->get_apartment($id)){
                 $delete=$this->dbmodel->delete('mo_info_apartment_facility_type','apartment_facility_type_id='. $id .'');
                 $this->send_response(REST_Controller::HTTP_OK);
            }else{
                 $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
