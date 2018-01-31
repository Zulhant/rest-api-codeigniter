<?php
class Towers extends My_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('model_towers');
    }

    protected function middleware() {
        return array('token_auth', 'parameter_validation');
    }

    function units_get($id = null){
        $data = $this->model_towers->get_apartmens_units(
            $id, 
            $this->middlewares['parameter_validation']->get_from(),
            $this->middlewares['parameter_validation']->get_to()
        );
        if($data)
            $this->send_response(REST_Controller::HTTP_OK, $data);
        else
            $this->send_response(REST_Controller::HTTP_NO_CONTENT);
    } 

    function index_get($id ='') { 
        if(empty($id)) {
            $data=$this->model_towers->get_towers($this->middlewares['parameter_validation']->get_to(),$this->middlewares['parameter_validation']->get_from());
            if ($data){
                $this->send_response(REST_Controller::HTTP_OK, $data);
            }else{
                $this->send_response(REST_Controller::HTTP_NO_CONTENT);
            }
        }else{
            $data=$this->model_towers->get_tower($id);
            $this->send_response(REST_Controller::HTTP_OK, $data);
        }
    }

    function index_post(){
        $param=array(
            'apartment_tower_apartment_id'=>$this->post('apartment_tower_apartment_id'),
            'apartment_tower_name'=>$this->post('apartment_tower_name'),
            'apartment_tower_latitude'=>$this->post('apartment_tower_latitude'),
            'apartment_tower_longitude'=>$this->post('apartment_tower_longitude'),
            'apartment_tower_total_room'=>$this->post('apartment_tower_total_room'),
            'apartment_tower_total_floor'=>$this->post('apartment_tower_total_floor')
        );
        $id = $this->dbmodel->insert('mo_info_apartment_tower',$param);
        if ($insert){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_put(){
        $id=$this->put('apartment_tower_id');
        $param=array(
            'apartment_tower_apartment_id'=>$this->put('apartment_tower_apartment_id'),
            'apartment_tower_name'=>$this->put('apartment_tower_name'),
            'apartment_tower_latitude'=>$this->put('apartment_tower_latitude'),
            'apartment_tower_longitude'=>$this->put('apartment_tower_longitude'),
            'apartment_tower_total_room'=>$this->put('apartment_tower_total_room'),
            'apartment_tower_total_floor'=>$this->put('apartment_tower_total_floor')
        );
        $update=$this->dbmodel->update($param,'mo_info_apartment_tower','apartment_tower_id',$id);
        if ($update){
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_delete($id = null){
        if (!empty($id)){
            if ($this->model_towers->get_tower($id)){
                $delete=$this->dbmodel->delete('mo_info_apartment_tower','apartment_tower_id', $id);
                $this->send_response(REST_Controller::HTTP_OK);
            }else{
                $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
