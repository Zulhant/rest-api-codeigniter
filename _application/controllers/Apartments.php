<?php

class Apartments extends My_Controller 
{
    
    function __construct() 
    {
        parent::__construct();
        $this->load->model('apartment_model');
    }

    protected function middleware() 
    {
        return array('token_auth', 'parameter_validation');
    }

    function index_get($id = '') 
    { 
        if(empty($id)) {
            $data = $this->apartment_model->get_apartments($this->middlewares['parameter_validation']->get_to (),$this->middlewares['parameter_validation']->get_from());
            if ($data){
                $this->send_response(REST_Controller::HTTP_OK, $data);
            }else{
                $this->send_response(REST_Controller::HTTP_NO_CONTENT);
            }
        }else{
            $data = $this->apartment_model->get_apartment($id);
            $this->send_response(REST_Controller::HTTP_OK, $data);
        }
    }

    function towers_get($id = null)
    {
        $data = $this->apartment_model->get_apartmens_towers(
                    $id, 
                    $this->middlewares['parameter_validation']->get_from(),
                    $this->middlewares['parameter_validation']->get_to()
                );
        
        if($data)
            $this->send_response(REST_Controller::HTTP_OK, $data);
        else
            $this->send_response(REST_Controller::HTTP_NO_CONTENT);
    } 

    function units_get($id = null)
    {
        $data = $this->apartment_model->get_apartmens_units(
            $id, 
            $this->middlewares['parameter_validation']->get_from(),
            $this->middlewares['parameter_validation']->get_to()
        );
        if($data)
            $this->send_response(REST_Controller::HTTP_OK, $data);
        else
            $this->send_response(REST_Controller::HTTP_NO_CONTENT);
    } 

    function index_post()
    {
        $param = array(
            'management_id'=>$this->post('apartment_management_id'),
            'developer_id'=>$this->post('apartment_developer_id'),
            'name'=>$this->post('apartment_name'),
            'desc'=>$this->post('apartment_desc'),
            'address'=>$this->post('apartment_address'),
            'district_id'=>$this->post('apartment_district_id'),
            'postal_code'=>$this->post('apartment_postal_code'),
            'latitude'=>$this->post('apartment_latitude'),
            'longitude'=>$this->post('apartment_longitude'),
            'street_name'=>$this->post('apartment_street_name')
        );
        $insert = $this->dbmodel->insert('mo_info_apartment',$param);
        if ($insert){
            $this->send_response(REST_Controller::HTTP_OK, $data);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_put()
    {
        $id = $this->put('apartment_id');
        $param = array(
            'management_id'=>$this->put('apartment_management_id'),
            'developer_id'=>$this->put('apartment_developer_id'),
            'name'=>$this->put('apartment_name'),
            'desc'=>$this->put('apartment_desc'),
            'address'=>$this->put('apartment_address'),
            'district_id'=>$this->put('apartment_district_id'),
            'postal_code'=>$this->put('apartment_postal_code'),
            'latitude'=>$this->put('apartment_latitude'),
            'longitude'=>$this->put('apartment_longitude'),
            'street_name'=>$this->put('apartment_street_name')
        );
        $update = $this->dbmodel->update($param,'mo_info_apartment','apartment_id',$id);
        if ($update){
            $this->send_response(REST_Controller::HTTP_OK, $update);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_delete($id = null)
    {
        if (!empty($id)){
            if ($this->apartment_model->get_apartment($id)){
                 $delete = $this->dbmodel->delete('mo_info_apartment','apartment_id='. $id);
                 $this->send_response(REST_Controller::HTTP_OK);
            }else{
                 $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
