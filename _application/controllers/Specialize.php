<?php
class Specialize extends My_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('model_specialize');
    }

    protected function middleware() {
        return array('token_auth', 'parameter_validation');
    }

    function index_get($id ='') { 
        if(empty($id)) {
            $data=$this->model_specialize->get_specializes($this->middlewares['parameter_validation']->get_to(),$this->middlewares['parameter_validation']->get_from());
            if ($data){
                $this->send_response(REST_Controller::HTTP_OK, $data);
            }else{
                $this->send_response(REST_Controller::HTTP_NO_CONTENT);
            }
        }else{
            $data=$this->model_specialize->get_specialize($id);
            $this->send_response(REST_Controller::HTTP_OK, $data);
        }
    }

    function index_post(){
        $param=array(
            'developer_specialize_name'=>$this->post('developer_specialize_name')
        );
        $insert=$this->dbmodel->insert('mo_info_developer_specialize',$param);
        if ($insert){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_put(){
        $id=$this->put('developer_specialize_id');
        $param=array(
            'developer_specialize_name'=>$this->put('developer_specialize_name')
        );
        $update=$this->dbmodel->update($param,'mo_info_developer_specialize','developer_specialize_id='. $id);
        if ($update){
            $this->send_response(REST_Controller::HTTP_OK);
        }
    }

    function index_delete($id = null){
        if (!empty($id)){
            if ($this->model_specialize->get_specialize($id)){
                $delete=$this->dbmodel->delete('mo_info_developer_specialize','developer_specialize_id', $id);
                if ($delete)
                    $this->send_response(REST_Controller::HTTP_OK);  
            }else{
                $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
