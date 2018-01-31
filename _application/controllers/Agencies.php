<?php
class Agencies extends My_Controller 
{
    
    function __construct() 
    {
        parent::__construct();
        $this->load->model('agencies_model');
    }

    protected function middleware() 
    {
        return array('token_auth', 'parameter_validation');
    }

    function index_get($id = '') 
    { 
        if(empty($id)) {
            $data = $this->agencies_model->get_agencies($this->middlewares['parameter_validation']->get_to (),$this->middlewares['parameter_validation']->get_from());
            if ($data){
                $this->send_response(REST_Controller::HTTP_OK, $data);
            }else{
                $this->send_response(REST_Controller::HTTP_NO_CONTENT);
            }
        }else{
            $data = $this->agencies_model->get_agenci($id);
            $this->send_response(REST_Controller::HTTP_OK, $data);
        }
    }
    
    function marketings_get($id = null){
        $data = $this->agencies_model->get_marketings(
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
            'marketing_agency_name'=>$this->post('marketing_agency_name'),
            'marketing_agency_desc'=>$this->post('marketing_agency_desc'),
            'marketing_agency_picture'=>$this->post('marketing_agency_picture')
        );
        $insert = $this->dbmodel->insert('mo_info_marketing_agency',$param);
        if ($insert){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_put()
    {
        $id=$this->put('apartment_id');
        $param = array(
            'marketing_agency_name'=>$this->put('marketing_agency_name'),
            'marketing_agency_desc'=>$this->put('marketing_agency_desc'),
            'marketing_agency_picture'=>$this->put('marketing_agency_picture')
        );
        $update = $this->dbmodel->update($param,'mo_info_marketing_agency','marketing_agency_id',$id);
        if ($update){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_delete($id = null)
    {
        if (!empty($id)){
            if ($this->agencies_model->get_agenci($id)){
                 $delete = $this->dbmodel->delete('mo_info_marketing_agency','marketing_agency_id='. $id);
                 $this->send_response(REST_Controller::HTTP_OK);
            }
        }else{
            $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
