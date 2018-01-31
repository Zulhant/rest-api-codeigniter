<?php
class Promos extends My_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('promos_model');
    }

    protected function middleware() {
        return array('token_auth', 'parameter_validation');
    }

    function index_get($id ='') { 
        if(empty($id)) {
            $data=$this->promos_model->get_promos($this->middlewares['parameter_validation']->get_to(),$this->middlewares['parameter_validation']->get_from());
            if ($data){
                $this->send_response(REST_Controller::HTTP_OK, $data);
            }else{
                $this->send_response(REST_Controller::HTTP_NO_CONTENT);
            }
        }else{
            $data=$this->promos_model->get_promo($id);
            $this->send_response(REST_Controller::HTTP_OK, $data);
        }
    }

    function units_get($id = null){
        $data = $this->promos_model->get_promo_units(
            $id, 
            $this->middlewares['parameter_validation']->get_from(),
            $this->middlewares['parameter_validation']->get_to()
        );
        if($data)
            $this->send_response(REST_Controller::HTTP_OK, $data);
        else
            $this->send_response(REST_Controller::HTTP_NO_CONTENT);
    } 

    function index_post(){
        $param=array(
            'promo_management_id'=>$this->post('promo_management_id'),
            'promo_user_account_id'=>$this->post('promo_user_account_id'),
            'promo_name'=>$this->post('promo_name'),
            'promo_start_date'=>$this->post('promo_start_date'),
            'promo_end_date'=>$this->post('promo_end_date'),
            'promo_datetime'=>$this->post('promo_datetime'),
            'promo_precentage'=>$this->post('promo_precentage')  
        );
        $insert=$this->dbmodel->insert('mo_info_promo',$param);
        if ($insert){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_put(){
        $id=$this->put('promo_id');
        $param=array(
            'promo_management_id'=>$this->put('promo_management_id'),
            'promo_user_account_id'=>$this->put('promo_user_account_id'),
            'promo_name'=>$this->put('promo_name'),
            'promo_start_date'=>$this->put('promo_start_date'),
            'promo_end_date'=>$this->put('promo_end_date'),
            'promo_datetime'=>$this->put('promo_datetime'),
            'promo_precentage'=>$this->put('promo_precentage')  
        );
        $update=$this->dbmodel->update($param,'mo_info_promo','promo_id',$id);
        if ($update){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_delete($id = null){
        if (!empty($id)){
            if ($this->promos_model->get_promo($id)){
                $delete=$this->dbmodel->delete('mo_info_promo','promo_id='. $id);
                $this->send_response(REST_Controller::HTTP_OK);
            }else{
                $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
