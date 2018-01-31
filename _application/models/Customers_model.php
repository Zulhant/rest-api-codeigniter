<?php

class Customers_model extends Ci_Model{

   //get all customers
    function get_customers($limit, $offset) {
        $masterdata = array();
        $data = $this->dbmodel->select("
                customer_id,
                customer_address,
                customer_job,
                customer_email,
                customer_phone,
                customer_latitude,
                customer_longitude,
                customer_street_name,
                district_name,
                customer_postal_code,
                customer_first_name,
                customer_last_name,
                customer_date_of_birth,
                customer_gender
            ")
        ->from("mo_info_customer,mo_info_district")
        ->where("customer_district_id=district_id")
        ->limit($limit)
        ->offset($offset)
        ->execute();
        
         $i = 0;
         foreach($data as $item){
            $id = $item['customer_id'];
            $masterdata[$i]['id']=$id;
            $masterdata[$i]['address'] = $item['customer_address'];
            $masterdata[$i]['job'] = $item['customer_job'];
            $masterdata[$i]['email'] = $item['customer_email'];
            $masterdata[$i]['phone'] = $item['customer_phone'];
            $masterdata[$i]['latitude'] = $item['customer_latitude'];
            $masterdata[$i]['longitude'] = $item['customer_longitude'];
            $masterdata[$i]['street_name'] = $item['customer_street_name'];
            $masterdata[$i]['distinct'] = $item['district_name'];
            $masterdata[$i]['postal_code'] = $item['customer_postal_code'];
            $masterdata[$i]['first_name'] = $item['customer_first_name'];
            $masterdata[$i]['last_name'] = $item['customer_last_name'];
            $masterdata[$i]['date_of_birth'] = $item['customer_date_of_birth'];
            $masterdata[$i]['gender'] = $item['customer_gender'];

            $sosial_media = $this->dbmodel->select('
                                                   customer_social_media_customer_id,
                                                   customer_social_media_social_type_id,
                                                   customer_social_media_link
            ')
            ->from("mo_info_customer_social_media,mo_info_social_media_type")
            ->where("customer_social_media_customer_id = ". $id .
            ' AND social_media_type=customer_social_media_social_type_id' 
            )
            ->execute();
            $data_sosial_media = array();

            $sos = 0;
            foreach($sosial_media as $sosial_ittem){
                $data_sosial_media[$sos]['id'] = $sosial_ittem['customer_social_media_customer_id'];
                $data_sosial_media[$sos]['type'] = $sosial_ittem['customer_social_media_social_type_id'];
                $data_sosial_media[$sos]['link'] = $sosial_ittem['customer_social_media_link'];
                $sos++;
            }

            $masterdata[$i]['sosial_media'] = $data_sosial_media;
            $i++;
        }
        return $masterdata;
    }
   //get customers by customer_id
    function get_customer($id) {
        $data = $this->dbmodel->select("
            customer_id,
            customer_address,
            customer_job,
            customer_email,
            customer_phone,
            customer_latitude,
            customer_longitude,
            customer_street_name,
            district_name,
            customer_postal_code,
            customer_first_name,
            customer_last_name,
            customer_date_of_birth,
            customer_gender
        ")
        ->from("mo_info_customer, mo_info_district")
        ->where("customer_district_id=district_id AND customer_id=". $id)
        //->is_single_row(true)
        ->execute();
        $i = 0;
        foreach($data as $item){
           $id = $item['customer_id'];
           $masterdata[$i]['id']=$id;
           $masterdata[$i]['address'] = $item['customer_address'];
           $masterdata[$i]['job'] = $item['customer_job'];
           $masterdata[$i]['email'] = $item['customer_email'];
           $masterdata[$i]['phone'] = $item['customer_phone'];
           $masterdata[$i]['latitude'] = $item['customer_latitude'];
           $masterdata[$i]['longitude'] = $item['customer_longitude'];
           $masterdata[$i]['street_name'] = $item['customer_street_name'];
           $masterdata[$i]['distinct'] = $item['district_name'];
           $masterdata[$i]['postal_code'] = $item['customer_postal_code'];
           $masterdata[$i]['first_name'] = $item['customer_first_name'];
           $masterdata[$i]['last_name'] = $item['customer_last_name'];
           $masterdata[$i]['date_of_birth'] = $item['customer_date_of_birth'];
           $masterdata[$i]['gender'] = $item['customer_gender'];

           $sosial_media = $this->dbmodel->select('
                                                  customer_social_media_customer_id,
                                                  customer_social_media_social_type_id,
                                                  customer_social_media_link
           ')
           ->from("mo_info_customer_social_media,mo_info_social_media_type")
           ->where("customer_social_media_customer_id = ". $id .
           ' AND social_media_type=customer_social_media_social_type_id' 
           )
           ->execute();
           $data_sosial_media = array();

           $sos = 0;
           foreach($sosial_media as $sosial_ittem){
               $data_sosial_media[$sos]['id'] = $sosial_ittem['customer_social_media_customer_id'];
               $data_sosial_media[$sos]['type'] = $sosial_ittem['customer_social_media_social_type_id'];
               $data_sosial_media[$sos]['link'] = $sosial_ittem['customer_social_media_link'];
               $sos++;
           }

           $masterdata[$i]['sosial_media'] = $data_sosial_media;
           $i++;
       }
           return $masterdata;
    }
}
