<?php

class Units extends My_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('units_model');
    }
    
    protected function middleware() {
        return array('token_auth', 'parameter_validation');
    }

    function index_get($id ='') { 
        if(empty($id)) {
            $data = $this->units_model->get_units( 
                $this->middlewares['parameter_validation']->get_from(),
                $this->middlewares['parameter_validation']->get_to()
            );
            if($data)
                $this->send_response(REST_Controller::HTTP_OK, $data);
            else
                $this->send_response(REST_Controller::HTTP_NO_CONTENT);
        }else{
            $data = $this->units_model->get_units(
                $id, 
                $this->middlewares['parameter_validation']->get_from(),
                $this->middlewares['parameter_validation']->get_to()
            );
            if($data)
                $this->send_response(REST_Controller::HTTP_OK, $data);
            else
                $this->send_response(REST_Controller::HTTP_NO_CONTENT);
        }
    }

    function index_post(){
        $param=array(
            'apartment_unit_name'=>$this->post('apartment_unit_name'),
            'apartment_unit_apartment_tower_id'=>$this->post('apartment_unit_apartment_tower_id'),
            'apartment_unit_apartment_unit_type_id'=>$this->post('apartment_unit_apartment_unit_type_id'),
            'apartment_unit_certificate_id'=>$this->post('apartment_unit_certificate_id'),
            'apartment_unit_desc'=>$this->post('apartment_unit_desc'),
            'apartment_unit_Datetime'=>$this->post('apartment_unit_Datetime'),
            'apartment_unit_price'=>$this->post('apartment_unit_price'),
            'apartment_unit_floor'=>$this->post('apartment_unit_floor'),
            'apartment_unit_electric_power_capacity'=>$this->post('apartment_unit_electric_power_capacity'),
            'apartment_unit_room_number'=>$this->post('apartment_unit_room_number')
        );
        $id=$this->dbmodel->insert('mo_info_apartment_unit',$param);
        if ($id){
            $param2 = array(
                'apartment_unit_facility_apartment_unit_id'=>$id,
                'apartment_unit_facility_apartment_facility_type_id'=>$this->post('apartment_unit_facility_apartment_facility_type_id'),
                'apartment_unit_facility_desc'=>$this->post('apartment_unit_facility_desc')
            );
            $pacilities=$this->dbmodel->insert('mo_info_apartment_unit_facility',$param2);
            $param3 = array(
                'apartment_unit_picture_apartment_unit_id'=>$id,
                'apartment_unit_picture_value'=>$this->post('apartment_unit_picture_value'),
                'apartment_unit_picture_datetime'=>date('d-m-Y H:i:s')
            );
            $pictures =$this->dbmodel->insert('mo_info_apartment_unit_picture',$param3);
            $param4 = array(
                'apartment_unit_payment_option_apartment_unit_id'=>$id,
                'apartment_unit_payment_option_payment_method_id'=>$this->post('apartment_unit_payment_option_payment_method_id'),
                'apartment_unit_payment_option_bank_id'=>$this->post('apartment_unit_payment_option_bank_id'),
                'apartment_unit_payment_option_account_number'=>$this->post('apartment_unit_payment_option_account_number'),
                'apartment_unit_payment_option_Datetime'=>date('d-m-Y H:i:s')
            );
            $payments = $this->dbmodel->insert('mo_info_apartment_unit_payment_option',$param4);
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_put(){
        $id = $this->put('apartment_unit_id');
        $param = array(
            'apartment_unit_name'=>$this->put('apartment_unit_name'),
            'apartment_unit_apartment_tower_id'=>$this->put('apartment_unit_apartment_tower_id'),
            'apartment_unit_apartment_unit_type_id'=>$this->put('apartment_unit_apartment_unit_type_id'),
            'apartment_unit_certificate_id'=>$this->put('apartment_unit_certificate_id'),
            'apartment_unit_desc'=>$this->put('apartment_unit_desc'),
            'apartment_unit_Datetime'=>$this->put('apartment_unit_Datetime'),
            'apartment_unit_price'=>$this->put('apartment_unit_price'),
            'apartment_unit_floor'=>$this->put('apartment_unit_floor'),
            'apartment_unit_electric_power_capacity'=>$this->put('apartment_unit_electric_power_capacity'),
            'apartment_unit_room_number'=>$this->put('apartment_unit_room_number')
        );
        $result = $this->dbmodel->update($param, 'mo_info_apartment_unit', 'apartment_unit_id', $id);
        if ($result){
            $id_fasility=$this->put('apartment_unit_facility_id');
            $param2 = array(
                'apartment_unit_facility_apartment_facility_type_id'=>$this->put('apartment_unit_facility_apartment_facility_type_id'),
                'apartment_unit_facility_desc'=>$this->put('apartment_unit_facility_desc')
            );
            $pacilities = $this->dbmodel->update($param2,'mo_info_apartment_unit_facility', 'apartment_unit_facility_id', $id_fasility );
            $id_picture = $this->put('apartment_unit_picture_id');
            $param3 = array(
                'apartment_unit_picture_value'=>$this->put('apartment_unit_picture_value')
            );
            $pictures = $this->dbmodel->update($param3,'mo_info_apartment_unit_picture','apartment_unit_picture_id', $id_picture);
            $id_payment = $this->put('apartment_unit_payment_option_id');
            $param4 = array(
                'apartment_unit_payment_option_payment_method_id'=>$this->put('apartment_unit_payment_option_payment_method_id'),
                'apartment_unit_payment_option_bank_id'=>$this->put('apartment_unit_payment_option_bank_id'),
                'apartment_unit_payment_option_account_number'=>$this->put('apartment_unit_payment_option_account_number')
            );
            $payments = $this->dbmodel->update($param4,'mo_info_apartment_unit_payment_option','apartment_unit_payment_option_id', $id_payment);
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_IMPLEMENTED);
        }
    }

    function index_delete($id = null){
        if (!empty($id)){
            $data = $this->units_model->get_units(
                $id, 
                $this->middlewares['parameter_validation']->get_from(),
                $this->middlewares['parameter_validation']->get_to()
            );
            if($data){
                $delete = $this->dbmodel->delete('mo_info_apartment_unit','apartment_unit_id', $id);
                $this->send_response(REST_Controller::HTTP_OK);
            }else{
                $this->send_response(REST_Controller::HTTP_NO_CONTENT);
            }
        }else{
            $this->send_response(REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
