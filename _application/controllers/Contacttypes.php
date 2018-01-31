<?php
class Contacttypes extends My_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('model_contact');
    }

    protected function middleware() {
        return array('token_auth', 'parameter_validation');
    }

    function index_get($id = null) { 
        if(empty($id)) {
            $data=$this->model_contact->get_contact_types($this->middlewares['parameter_validation']->get_to(),$this->middlewares['parameter_validation']->get_from());
            if ($data){
                $this->send_response(REST_Controller::HTTP_OK, $data);
            }else{
                $this->send_response(REST_Controller::HTTP_NO_CONTENT);
            }
        }else{
            $data=$this->model_contact->get_contact_type($id);
            $this->send_response(REST_Controller::HTTP_OK);
        }
    }

    function index_post(){
        $param=array(
            'contact_type_name'=>$this->post('contact_type_name')
        );
        $insert = $this->dbmodel->insert('mo_info_contact_type',$param);
        if ($insert){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_put(){
        $id=$this->put('contact_type_id');
        $param=array(
            'contact_type_name'=>$this->put('contact_type_name')
        );
        $update=$this->dbmodel->update($param,'mo_info_contact_type','contact_type_id',$id);
        if ($update){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_delete($id = null){
        if (!empty($id)){
            if ($this->Model_contact->get_contact_type($id)){
                $delete=$this->dbmodel->delete('mo_info_contact_type','contact_type_id='. $id .'');
                $this->send_response(REST_Controller::HTTP_OK);
            }else{
                $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
