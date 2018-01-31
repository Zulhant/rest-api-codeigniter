<?php
class Managements extends My_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('model_managements');
    }

    protected function middleware() {
        return array('token_auth', 'parameter_validation');
    }

    function index_get($id = '') { 
        if(empty($id)) {
            $data = $this->model_managements->get_managements($this->middlewares['parameter_validation']->get_to(),$this->middlewares['parameter_validation']->get_from());
            if ($data){
                $this->send_response(REST_Controller::HTTP_OK, $data);
            }else{
                $this->send_response(REST_Controller::HTTP_NO_CONTENT);
            }
        }else{
            $data = $this->model_managements->get_management($id);
            $this->send_response(REST_Controller::HTTP_OK, $data);
        }
    }

    function index_post(){
        $param = array(
            'management_name'=>$this->post('management_name'),
            'management_desc'=>$this->post('management_desc'),
            'management_picture'=>$this->post('management_picture'),
            'management_address'=>$this->post('management_address'),
            'management_latitude'=>$this->post('management_latitude'),
            'management_longitude'=>$this->post('management_longitude'),
            'management_postal_code'=>$this->post('management_postal_code'),
            'management_district_id'=>$this->post('management_district_id'),
            'management_street_name'=>$this->post('management_street_name'),
            'street_name'=>$this->post('apartment_street_name')
        );
        $id = $this->dbmodel->insert('mo_info_management',$param);
        if ($id){
            $param2=array(
                'management_contact_management_id'=>$id,
                'management_contact_contact_type_id'=>$this->post('management_contact_contact_type_id'),
                'management_contact_value'=>$this->post('management_contact_value ')
            );
            $data = $this->dbmodel->insert('mo_info_management_contact',$param2);
            if ($data){
                $this->send_response(REST_Controller::HTTP_OK);
            }
            
        }
    }

    function index_put(){
        $id = $this->put('management_id');
        $param = array(
            'management_name'=>$this->put('management_name'),
            'management_desc'=>$this->put('management_desc'),
            'management_picture'=>$this->put('management_picture'),
            'management_address'=>$this->put('management_address'),
            'management_latitude'=>$this->put('management_latitude'),
            'management_longitude'=>$this->put('management_longitude'),
            'management_postal_code'=>$this->put('management_postal_code'),
            'management_district_id'=>$this->put('management_district_id'),
            'management_street_name'=>$this->put('management_street_name'),
            'street_name'=>$this->put('apartment_street_name')
        );
        $result = $this->dbmodel->update($param,'mo_info_management','management_id',$id);
        if ($id){
            $param2=array(
                'management_contact_contact_type_id'=>$this->put('management_contact_contact_type_id'),
                'management_contact_value'=>$this->put('management_contact_value ')
            );
            $data = $this->dbmodel->update($param2,'mo_info_management_contact','management_contact_management_id',$id);
            if ($data){
                $this->send_response(REST_Controller::HTTP_OK);
            }
            
        }
    }

    function index_delete($id = null){
        if (!empty($id)){
            if ($this->model_managements->get_managementt($id)){
                 $delete=$this->dbmodel->delete('mo_info_management','management_id='. $id .'');
                 $this->send_response(REST_Controller::HTTP_OK);
            }else{
                 $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }
}
