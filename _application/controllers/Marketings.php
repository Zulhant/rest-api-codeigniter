<?php
class Marketings extends My_Controller 
{
    
    function __construct() 
    {
        parent::__construct();
        $this->load->model('model_marketings');
    }

    protected function middleware() {
        
        return array('token_auth', 'parameter_validation');
    }

    function index_get($id ='')
    { 
        
        if(empty($id)) {
            $data=$this->model_marketings->get_marketings($this->middlewares['parameter_validation']->get_to(),$this->middlewares['parameter_validation']->get_from());
            if ($data){
                $this->send_response(REST_Controller::HTTP_OK, $data);
            }else{
                $this->send_response(REST_Controller::HTTP_NO_CONTENT);
            }
        }else{
            $data=$this->model_marketings->get_marketing($id);
            $this->send_response(REST_Controller::HTTP_OK, $data);
        }
    }
    
    function referals_get($id = null)
    {
        
        $data = $this->model_marketings->get_referals(
            $id, 
            $this->middlewares['parameter_validation']->get_from(),
            $this->middlewares['parameter_validation']->get_to()
        );
        if($data)
            $this->send_response(REST_Controller::HTTP_OK, $data);
        else
            $this->send_response(REST_Controller::HTTP_NO_CONTENT);
    }
    
    function unittransactions_get($id = null, $id2 = null)
    {
        
        if ($id2 == null){
             $data = $this->model_marketings->get_unit_transaction(
             $id, 
             $this->middlewares['parameter_validation']->get_from(),
             $this->middlewares['parameter_validation']->get_to()
             );
        }else{
             $data = $this->model_marketings->get_unit_transaction2(
             $id,$id2, 
             $this->middlewares['parameter_validation']->get_from(),
             $this->middlewares['parameter_validation']->get_to()
             );
           
        }
        
        if($data)
            $this->send_response(REST_Controller::HTTP_OK, $data);
        else
            $this->send_response(REST_Controller::HTTP_NO_CONTENT);
    }

    function index_post()
    {
        
        $param=array(
            'marketing_name'=>$this->post('marketing_name'),
            'marketing_user_account_id'=>$this->post('marketing_user_account_id'),
            'marketing_agency_id'=>$this->post('marketing_agency_id'),
            'marketing_is_active'=>$this->post('marketing_is_active'),
            'marketing_datetime'=>$this->post('marketing_datetime'),
            'marketing_gender'=>$this->post('marketing_gender'),
            'marketing_date_of_birth'=>$this->post('marketing_date_of_birth'),
            'marketing_religion'=>$this->post('marketing_religion')
        );
        $id = $this->dbmodel->insert('mo_info_marketing',$param);
        if ($insert){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_put()
    {
        
        $id=$this->put('marketing_id');
        $param=array(
            'marketing_name'=>$this->put('marketing_name'),
            'marketing_user_account_id'=>$this->put('marketing_user_account_id'),
            'marketing_agency_id'=>$this->put('marketing_agency_id'),
            'marketing_is_active'=>$this->put('marketing_is_active'),
            'marketing_datetime'=>$this->put('marketing_datetime'),
            'marketing_gender'=>$this->put('marketing_gender'),
            'marketing_date_of_birth'=>$this->put('marketing_date_of_birth'),
            'marketing_religion'=>$this->put('marketing_religion')
        );
        $update=$this->dbmodel->update($param,'mo_info_marketing','marketing_id',$id);
        if ($update){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_delete($id = null)
    {
        if (!empty($id)){
            if ($this->model_marketings->get_marketing($id)){
                $delete=$this->dbmodel->delete('mo_info_marketing','marketing_id='. $id .'');
                $this->send_response(REST_Controller::HTTP_OK);
            }
        }
    }
}
