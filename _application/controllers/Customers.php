<?php

class Customers extends My_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model("customers_model");
        $this->load->model("apartment_model");
    }

    protected function middleware() {
        return array('token_auth', 'parameter_validation');
    }
    //get data customers and by customer_id
    function index_get($id='') { 
        if(empty($id)) {
            $customers = $this->customers_model->get_customers($this->middlewares['parameter_validation']->get_to(), $this->middlewares['parameter_validation']->get_from());
            if ($customers){
                $this->send_response(REST_Controller::HTTP_OK, $customers);
            }else{
                $this->send_response(REST_Controller::HTTP_NO_CONTENT);
            }
        } else {
            $customer = $this->customers_model->get_customer($id);
            if ($customer){
                $this->send_response(REST_Controller::HTTP_OK, $customer);
            }else{
                $this->send_response(REST_Controller::HTTP_NO_CONTENT);
            }
        }
    }
  //post data customers
    function index_post(){
        $param=array(
            'customer_user_account_id'=>$this->post('customer_user_account_id'),
            'customer_address'=>$this->post('customer_address'),
            'customer_job'=>$this->post('customer_job'),
            'customer_email'=>$this->post('customer_email'),
            'customer_phone'=>$this->post('customer_phone'),
            'customer_latitude'=>$this->post('customer_latitude'),
            'customer_longitude'=>$this->post('customer_longitude'),
            'customer_street_name'=>$this->post('customer_street_name'),
            'customer_district_id'=>$this->post('customer_district_id'),
            'customer_postal_code'=>$this->post('customer_postal_code'),
            'customer_first_name'=>$this->post('customer_first_name'),
            'customer_last_name'=>$this->post('customer_last_name'),
            'customer_date_of_birth'=>$this->post('customer_date_of_birth'),
            'customer_gender'=>$this->post('customer_gender')
        );
        $id=$this->dbmodel->insert('mo_info_customer',$param);
        if ($id){
            $param2 = array(
                'customer_social_media_customer_id'=>$id,
                'customer_social_media_social_type_id'=>$this->post('customer_social_media_social_type_id'),
                'customer_social_media_link'=>$this->post('customer_social_media_link')
            );
            $data = $this->dbmodel->insert('mo_info_customer_social_media',$param2);
            if ($data)
                $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_ACCEPTABLE);
        }
    }

    function units_get($id = null)
    {
        $data = $this->apartment_model->get_apartmens_units(
            $id, 
            $this->middlewares['parameter_validation']->get_from(),
            $this->middlewares['parameter_validation']->get_to()
        );
        if($data)
            $this->send_response(REST_Controller::HTTP_OK, $data);
        else
            $this->send_response(REST_Controller::HTTP_NO_CONTENT);
    } 

   //update data customers by customers_id
    function index_put(){
        $id=$this->put('customer_id');
        $param=array(
            'customer_user_account_id'=>$this->put('customer_user_account_id'),
            'customer_address'=>$this->put('customer_address'),
            'customer_job'=>$this->put('customer_job'),
            'customer_email'=>$this->put('customer_email'),
            'customer_phone'=>$this->put('customer_phone'),
            'customer_latitude'=>$this->put('customer_latitude'),
            'customer_longitude'=>$this->put('customer_longitude'),
            'customer_street_name'=>$this->put('customer_street_name'),
            'customer_district_id'=>$this->put('customer_district_id'),
            'customer_postal_code'=>$this->put('customer_postal_code'),
            'customer_first_name'=>$this->put('customer_first_name'),
            'customer_last_name'=>$this->put('customer_last_name'),
            'customer_date_of_birth'=>$this->put('customer_date_of_birth'),
            'customer_gender'=>$this->put('customer_gender')
        );
        $result= $this->dbmodel->update($param,'mo_info_customer','customer_id', $id);
        if ($result){
            $sm_id=$this->put('customer_social_media_social_type_id');
            $cek=$this->db->select('customer_social_media_social_type_id')
                          ->from('mo_info_customer_social_media')
                          ->where('customer_social_media_customer_id='. $result)
                          ->where('customer_social_media_social_type_id='. $sm_id);                                             
            if ($cek->row){
                $param3 = array(
                    'customer_social_media_customer_id'=>$id,
                    'customer_social_media_social_type_id'=>$sm_id,
                    'customer_social_media_link'=>$this->put('customer_social_media_link')
                );
                $this->dbmodel->insert('mo_info_customer_social_media',$param3); 
            }
            $this->send_response(REST_Controller::HTTP_OK);
        }else{
            $this->send_response(REST_Controller::HTTP_NOT_ACCEPTABLE);
        }
    } 
    //delete data customer by customer_id
    function index_delete($id = null){
       if ($id != null){
            $delete=$this->dbmodel->delete('mo_info_customer','customer_id='. $id .'');
            $this->send_response(REST_Controller::HTTP_OK);
       }
    }
}