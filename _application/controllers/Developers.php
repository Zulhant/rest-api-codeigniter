<?php
class Developers extends My_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('developers_model');
    }

    protected function middleware() {
        return array('token_auth', 'parameter_validation');
    }
    //get data customers by id or all
    function index_get($id = null, $limit = null,  $offset = null) { 
        if ($id == null){
            $data=$this->developers_model->get_developers($this->middlewares['parameter_validation']->get_to(),$this->middlewares['parameter_validation']->get_from());
            $this->send_response(REST_Controller::HTTP_OK, $data);
        }else{
            $data=$this->developers_model->get_developer($id);
            $this->send_response(REST_Controller::HTTP_OK, $data);
        }
    }
   //get data apartment by developer_id
    function apartments_get($id=null){
        $data=$this->developers_model->get_developer_apartment($id);
        $this->send_response(REST_Controller::HTTP_OK, $data);
    }
   //post data developers
    function index_post(){
        $param=array(
            'developer_name'=>$this->post('developer_name'),
            'developer_desc'=>$this->post('developer_desc'),
            'developer_picture'=>$this->post('developer_picture'),
            'developer_address'=>$this->post('developer_address'),
            'developer_district_id'=>$this->post('developer_district_id'),
            'developer_street_name'=>$this->post('developer_street_name'),
            'developer_postal_code'=>$this->post('developer_postal_code'),
            'developer_developer_specialize_id'=>$this->post('developer_developer_specialize_id')
        );
        $save=$this->dbmodel->insert('mo_info_developer',$param);
        if ($save){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
        }
    }  
    //update data developers
    function index_put(){
        $id=$this->put('developer_id');
        $param=array(
            'developer_name'=>$this->put('developer_name'),
            'developer_desc'=>$this->put('developer_desc'),
            'developer_picture'=>$this->put('developer_picture'),
            'developer_address'=>$this->put('developer_address'),
            'developer_district_id'=>$this->put('developer_district_id'),
            'developer_street_name'=>$this->put('developer_street_name'),
            'developer_postal_code'=>$this->put('developer_postal_code'),
            'developer_developer_specialize_id'=>$this->put('developer_developer_specialize_id')
        );
        $update=$this->dbmodel->update($param,'mo_info_developer','developer_id',$id);
        if ($update){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
           $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    //delete data by developer_id
    function index_delete($id = null){
        if ($id != null){
            $delete=$this->dbmodel->delete('mo_info_developer','developer_id='. $id);
            if ($delete){
                $this->send_response(REST_Controller::HTTP_OK);
            }
        } 
    }
}
