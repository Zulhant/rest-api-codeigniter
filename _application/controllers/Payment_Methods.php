<?php
class Payment_Methods extends My_Controller 
{
    
    function __construct() 
    {
        parent::__construct();
        $this->load->model('model_payment');
    }

    protected function middleware() 
    {
        return array('token_auth', 'parameter_validation');
    }

    function index_get($id='') 
    { 
        if(empty($id)) {
            $data=$this->model_payment->get_payments($this->middlewares['parameter_validation']->get_to(),$this->middlewares['parameter_validation']->get_from());
            if ($data){
                $this->send_response(REST_Controller::HTTP_OK, $data);
            }else{
                $this->send_response(REST_Controller::HTTP_NO_CONTENT);
            }
        }else{
            $data=$this->model_payment->get_payment($id);
            $this->send_response(REST_Controller::HTTP_OK, $data);
        }
    }

    function units_get($id = null)
    {
        $data = $this->model_payment->get_payment_units(
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
        $param=array(
            'payment_method_name'=>$this->post('payment_method_name'),
            'payment_method_datetime'=>$this->post('payment_method_datetime'),
            'payment_method_is_active'=>$this->post('payment_method_is_active')
        );
        $id = $this->dbmodel->insert('mo_info_payment_method',$param);
        if ($insert){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_put()
    {
        $id=$this->put('payment_method_id');
        $param=array(
            'payment_method_name'=>$this->put('payment_method_name'),
            'payment_method_datetime'=>$this->put('payment_method_datetime'),
            'payment_method_is_active'=>$this->put('payment_method_is_active')
        );
        $update=$this->dbmodel->update($param,'mo_info_payment_method','payment_method_id',$id);
        if ($update){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_delete($id = null)
    {
        if (!empty($id)){
            if ($this->model_payment->get_payment($id)){
                $delete=$this->dbmodel->delete('mo_info_payment_method','payment_method_id='. $id .'');
                $this->send_response(REST_Controller::HTTP_OK);
            }else{
                $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
