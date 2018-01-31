<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Register extends My_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->library("encrypt");
    }

    function index_post(){
        $param=array(
            'user_account_username'=>$this->post('user_account_username'),
            'user_account_password'=>$this->encrypt->encode($this->post('user_account_password')),
            'user_account_group_id'=>$this->post('user_account_group_id'),
            'user_account_is_active'=>$this->post('user_account_is_active')
        );
        $insert = $this->dbmodel->insert('mo_info_user_account',$param);
        if ($insert){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }  
}

