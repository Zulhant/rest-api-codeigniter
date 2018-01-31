<?php
class Districts extends My_Controller 
{
    
    function __construct() 
    {
        parent::__construct();
        $this->load->model('districts_model');
    }

    protected function middleware()
    {
        return array('token_auth', 'parameter_validation');
    }

    function index_get($id ='')
    { 
        if(empty($id)) {
            $data=$this->districts_model->get_districts($this->middlewares['parameter_validation']->get_to(),$this->middlewares['parameter_validation']->get_from());
            if ($data){
                $this->send_response(REST_Controller::HTTP_OK, $data);
            }else{
                $this->send_response(REST_Controller::HTTP_NO_CONTENT);
            }
        }else{
            $data=$this->districts_model->get_district($id);
            $this->send_response(REST_Controller::HTTP_OK, $data);
        }
    }

    function index_post()
    {
        $param=array(
            'district_name'=>$this->post('district_name'),
            'district_city_id'=>$this->post('district_city_id')
        );
        $insert=$this->dbmodel->insert('mo_info_district',$param);
        if ($insert){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_put()
    {
        $id=$this->put('district_id');
        $param=array(
            'district_name'=>$this->put('district_name'),
            'district_city_id'=>$this->put('district_city_id')
        );
        $update=$this->dbmodel->update($param,'mo_info_district','district_id',$id);
        if ($update){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    
    function index_delete($id = null)
    {
        if (!empty($id)){
            if ($this->district_model->get_district($id)){
                $delete=$this->dbmodel->delete('mo_info_district','district_id='. $id);
                $this->send_response(REST_Controller::HTTP_OK);
            }else{
                $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
