<?php

Class Promos_model extends Ci_Model{

    function  get_promos($limit,$ofset){
        return $this->dbmodel->select("
            promo_id AS id,
            promo_name AS name,
            management_name AS management_name,
            promo_precentage AS precentage
        ")
        ->from("mo_info_promo,mo_info_management")
        ->limit($limit)
        ->offset($ofset)
        ->execute();
    }

    function get_promo($id = null){
        return $this->dbmodel->select("
            promo_id AS id,
            promo_name AS name,
            management_name AS management_name,
            promo_precentage AS precentage,
            user_account_username AS admin,
            promo_start_date AS start_date,
            promo_end_date AS end_date,
            promo_datetime AS date
         ")
        ->from("mo_info_promo,mo_info_management,mo_info_user_account")
        ->where("promo_id = ". $id)
        ->is_single_row(true)
        ->execute();     
    }

    function get_promo_units($id=null,  $offset, $limit){
        $master_data = array();
        $data = $this->dbmodel->select("
            apartment_unit_id,
            apartment_unit_name,
            apartment_unit_type_name,
            apartment_certificate_name,
            apartment_unit_desc,
            apartment_unit_Datetime,
            apartment_unit_price,
            apartment_unit_floor,
            apartment_unit_electric_power_capacity,
            apartment_unit_room_number  
        ")
        ->from("mo_info_promo,mo_info_apartment_unit,mo_info_apartment_certificate,mo_info_apartment_unit_type")
        ->where('promo_apartment_unit_id='. $id . ' AND apartment_unit_id=promo_apartment_unit_id '.' AND apartment_unit_type_id=apartment_unit_apartment_unit_type_id '.' AND apartment_certificate_id=apartment_unit_certificate_id')
        ->offset($offset)
        ->limit($limit)
        ->execute();
        $i = 0;
        foreach($data as $item) {
            $id = $item['apartment_unit_id'];
            $master_data[$i]['id'] = $id;
            $master_data[$i]['name'] = $item['apartment_unit_name'];
            $master_data[$i]['type'] = $item['apartment_unit_type_name'];
            $master_data[$i]['certificate'] = $item['apartment_certificate_name'];
            $master_data[$i]['desc'] = $item['apartment_unit_desc'];
            $master_data[$i]['Date'] = $item['apartment_unit_Datetime'];
            $master_data[$i]['price'] = $item['apartment_unit_price'];
            $master_data[$i]['floor'] = $item['apartment_unit_floor'];
            $master_data[$i]['electric_power_capacity'] = $item['apartment_unit_electric_power_capacity'];
            $master_data[$i]['room'] = $item['apartment_unit_room_number'];
            $master_data[$i]['pacility'] =$this->dbmodel->select("
                                                apartment_unit_facility_id AS id,
                                                apartment_facility_type_name AS name,
                                                apartment_unit_facility_desc AS desc,                      
            ")
            ->from("mo_info_apartment_unit_facility,mo_info_apartment_facility_type")
            ->where('apartment_unit_facility_apartment_unit_id='. $id .
            ' AND apartment_facility_type_id = apartment_unit_facility_apartment_facility_type_id')
            ->execute();
            $master_data[$i]['picture'] =$this->dbmodel->select("
                                            apartment_unit_picture_id AS id,
                                            apartment_unit_picture_value AS name,                   
            ")
            ->from("mo_info_apartment_unit_picture")
            ->where('apartment_unit_picture_apartment_unit_id='. $id)
            ->execute();
            $master_data[$i]['payment'] =$this->dbmodel->select("
                                            apartment_unit_payment_option_id AS id,
                                            payment_method_name AS name,
                                            bank_name AS bank_name,
                                            apartment_unit_payment_option_account_number AS account_number                  
            ")
            ->from("mo_info_apartment_unit_payment_option,mo_info_payment_method,mo_info_bank")
            ->where('apartment_unit_payment_option_apartment_unit_id='. $id . ' AND payment_method_id=apartment_unit_payment_option_payment_method_id'. ' AND bank_id=apartment_unit_payment_option_bank_id') 
            ->execute();
            $i++;
        }
        return $master_data;
    }
}
