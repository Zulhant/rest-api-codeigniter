<?php

class Menus extends My_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('menus_model');
    }
    
    protected function middleware() {
        return array('token_auth', 'parameter_validation');
    }

    function index_get($id ='') { 
        if(empty($id)) {
            $data=$this->menus_model->get_menus($this->middlewares['parameter_validation']->get_to(),$this->middlewares['parameter_validation']->get_from());
            if ($data){
                $this->send_response(REST_Controller::HTTP_OK, $data);
            }else{
                $this->send_response(REST_Controller::HTTP_NO_CONTENT);
            }
        }else{
            $data=$this->menus_model->get_menu($id);
            $this->send_response(REST_Controller::HTTP_OK, $data);
        }
    }

    function index_post(){
        $param=array(
            'menu_parent_id'=>$this->post('menu_parent_id'),
            'menu_name'=>$this->post('menu_name'),
            'menu_is_active'=>$this->post('menu_is_active'),
            'menu_order'=>$this->post('menu_order')
        );
        $insert=$this->dbmodel->insert('mo_info_menu',$param);
        if ($insert){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function cities_get($id=null){
        $data=$this->province_model->get_provinces_cities($id);
        $this->send_response(REST_Controller::HTTP_OK, $data);
    } 

    function index_put(){
        $id=$this->put('menu_id');
        $param=array(
            'menu_parent_id'=>$this->put('menu_parent_id'),
            'menu_name'=>$this->put('menu_name'),
            'menu_is_active'=>$this->put('menu_is_active'),
            'menu_order'=>$this->put('menu_order')
        );
        $update=$this->dbmodel->update($param,'mo_info_menu','menu_id',$id);
        if ($update){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_delete($id = null){
        if (!empty($id)){
            if ($this->menus_model->get_menu($id)){
                 $delete=$this->dbmodel->delete('mo_info_menu','menu_id='. $id .'');
                 $this->send_response(REST_Controller::HTTP_OK);
            }else{
                 $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
