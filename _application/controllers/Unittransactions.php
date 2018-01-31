<?php
class Unittransactions extends My_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('modelunit_transactions');
    }

    protected function middleware() {
        return array('token_auth', 'parameter_validation');
    }

    function index_get($id ='') { 
        if(empty($id)) {
            $data=$this->modelunit_transactions->get_unit_transactions($this->middlewares['parameter_validation']->get_to(),$this->middlewares['parameter_validation']->get_from());
            if ($data){
                $this->send_response(REST_Controller::HTTP_OK, $data);
            }
        }else{
            $data=$this->modelunit_transactions->get_unit_transaction($id);
            $this->send_response(REST_Controller::HTTP_OK, $data);
        }
    }

    function index_post(){
        $param=array(
            'apartment_unit_transaction_customer_id'=>$this->post('apartment_unit_transaction_customer_id'),
            'apartment_unit_transaction_marketing_id'=>$this->post('apartment_unit_transaction_marketing_id'),
            'apartment_unit_transaction_apartment_unit_id'=>$this->post('apartment_unit_transaction_apartment_unit_id'),
            'apartment_unit_transaction_datetime'=>$this->post('apartment_unit_transaction_datetime'),
            'apartment_unit_transaction_price'=>$this->post('apartment_unit_transaction_price'),
            'apartment_unit_transaction_status'=>$this->post('apartment_unit_transaction_status'),
            'apartment_unit_transaction_expired_datetime'=>$this->post('apartment_unit_transaction_expired_datetime'),
            'apartment_unit_transaction_info'=>$this->post('apartment_unit_transaction_info')  
        );
        $insert=$this->dbmodel->insert('mo_info_promo',$param);
        if ($insert){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_put(){
        $id=$this->put('apartment_unit_transaction_id');
        $param=array(
            'apartment_unit_transaction_customer_id'=>$this->put('apartment_unit_transaction_customer_id'),
            'apartment_unit_transaction_marketing_id'=>$this->put('apartment_unit_transaction_marketing_id'),
            'apartment_unit_transaction_apartment_unit_id'=>$this->put('apartment_unit_transaction_apartment_unit_id'),
            'apartment_unit_transaction_datetime'=>$this->put('apartment_unit_transaction_datetime'),
            'apartment_unit_transaction_price'=>$this->put('apartment_unit_transaction_price'),
            'apartment_unit_transaction_status'=>$this->put('apartment_unit_transaction_status'),
            'apartment_unit_transaction_expired_datetime'=>$this->put('apartment_unit_transaction_expired_datetime'),
            'apartment_unit_transaction_info'=>$this->put('apartment_unit_transaction_info')  
        );
        $update=$this->dbmodel->update($param,'mo_info_apartment_unit_transaction','apartment_unit_transaction_id',$id);
        if ($update){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_delete($id = null){
        if (!empty($id)){
            if ($this->modelunit_transactions->get_unit_transaction($id)){
                $delete=$this->dbmodel->delete('mo_info_apartment_unit_transaction','apartment_unit_transaction_id='. $id);
                $this->send_response(REST_Controller::HTTP_OK);
            }else{
                $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
