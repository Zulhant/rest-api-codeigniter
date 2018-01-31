<?php
class Useraccounts extends My_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('model_user_accounts');
    }

    protected function middleware() {
        return array('token_auth', 'parameter_validation');
    }

    function index_get($id = null) { 
        if(empty($id)){
            $data=$this->model_user_accounts->get_users($this->middlewares['parameter_validation']->get_to(),$this->middlewares['parameter_validation']->get_from());
            if ($data){
                $this->send_response(REST_Controller::HTTP_OK, $data);
            }else{
                $this->send_response(REST_Controller::HTTP_NO_CONTENT);
            }
        }else{
            $data=$this->model_user_accounts->get_user($id);
            $this->send_response(REST_Controller::HTTP_OK, $data);
        }
    }

    function index_post(){
        $this->load->library("encrypt");
        $param=array(
            'user_account_username'=>$this->post('user_account_username'),
            'user_account_password'=>$this->post($this->encryption->encrypt('user_account_password')),
            'user_account_group_id'=>$this->post('user_account_group_id'),
            'user_account_picture'=>$this->post('user_account_picture'),
            'user_account_is_active'=>$this->post('user_account_is_active')
        );
        $insert = $this->dbmodel->insert('mo_info_user_account',$param);
        if ($insert){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_put(){
        $id=$this->put('user_account_id');
        $param=array(
            'user_account_username'=>$this->put('user_account_username'),
            'user_account_password'=>$this->put($this->encryption->encrypt('user_account_password')),
            'user_account_group_id'=>$this->put('user_account_group_id'),
            'user_account_picture'=>$this->put('user_account_picture'),
            'user_account_is_active'=>$this->put('user_account_is_active')
        );
        $update=$this->dbmodel->update($param,'mo_info_user_account','user_account_id',$id);
        if ($update){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_delete($id = null){
        if (!empty($id)){
            if ($this->model_user_accounts->get_user($id)){
                $delete=$this->dbmodel->delete('mo_info_user_account','user_account_id='. $id .'');
                $this->send_response(REST_Controller::HTTP_OK);
            }else{
                $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
