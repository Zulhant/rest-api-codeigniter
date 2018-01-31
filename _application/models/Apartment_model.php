<?php

Class Apartment_model extends Ci_Model{

    function get_apartments($limit,$ofset){
        return $this->dbmodel->select("
            apartment_id AS id,
            apartment_name AS name,
            management_name,
            developer_name,
            apartment_desc AS desc,
            apartment_address AS address,
            district_name AS district,
            city_name AS city,
            province_name AS province,
            apartment_postal_code AS postal_code,
            apartment_latitude AS latitude,
            apartment_longitude AS longitude
        ")
         ->from("mo_info_apartment,mo_info_management,mo_info_developer, mo_info_district,mo_info_city,mo_info_province")
        ->where("apartment_management_id = management_id")
        ->where("apartment_developer_id = developer_id")
        ->where("apartment_district_id = district_id")
        ->where("district_city_id=city_id")
        ->where("city_province_id=province_id")
        ->limit($limit)
        ->offset($ofset)
        ->execute();
    }

    function get_apartment($id=null){
        return $this->dbmodel->select("
            apartment_id AS id,
            apartment_name AS name,
            management_name,
            developer_name,
            apartment_desc AS desc,
            apartment_address AS address,
            district_name AS district,
            city_name AS city,
            province_name AS province,
            apartment_postal_code AS postal_code,
            apartment_latitude AS latitude,
            apartment_longitude AS longitude,
            apartment_street_name AS street_name
         ")
        ->from("mo_info_apartment,mo_info_management,mo_info_developer, mo_info_district,mo_info_city,mo_info_province")
        ->where("apartment_management_id = management_id AND apartment_id =". $id)
        ->where("apartment_developer_id = developer_id AND apartment_id =". $id)
        ->where("apartment_district_id = district_id AND apartment_id =". $id)
        ->where("district_city_id=city_id AND apartment_id =". $id)
        ->where("city_province_id=province_id AND apartment_id =". $id)
        ->is_single_row(true)
        ->execute();     
    }

    function get_apartmens_units($id=null,  $offset, $limit){
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
        ->from("mo_info_apartment_unit,mo_info_apartment_certificate,mo_info_apartment_unit_type")
        ->where('apartment_unit_id='. $id . ' AND apartment_unit_type_id=apartment_unit_apartment_unit_type_id '.' AND apartment_certificate_id=apartment_unit_certificate_id')
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

    function get_apartmens_towers($id = null, $offset, $limit){
        $master_data = array();
        $data = $this->dbmodel->select("
                apartment_tower_id,
                apartment_tower_name,
                apartment_tower_latitude,
                apartment_tower_longitude,
                apartment_tower_total_room,
                apartment_tower_total_floor  
            ")
        ->from("mo_info_apartment_tower")
        ->where('apartment_tower_apartment_id='. $id)
        ->offset($offset)
        ->limit($limit)
        ->execute();
        $i = 0;
        foreach($data as $item) {
            $id = $item['apartment_tower_id'];
            $master_data[$i]['id'] = $id;
            $master_data[$i]['name'] = $item['apartment_tower_name'];
            $master_data[$i]['latitude'] = $item['apartment_tower_latitude'];
            $master_data[$i]['longitude'] = $item['apartment_tower_longitude'];
            $master_data[$i]['total_room'] = $item['apartment_tower_total_room'];
            $master_data[$i]['total_floor'] = $item['apartment_tower_total_floor'];
            $master_data[$i]['facility'] = $this->dbmodel->select('
                                                apartment_tower_facility_id AS id,
                                                apartment_facility_type_name AS name,
                                                apartment_tower_facility_desc AS desc
                                            ')
                                            ->from("mo_info_apartment_tower_facility, mo_info_apartment_facility_type")
                                            ->where('
                                                apartment_tower_facility_apartment_tower_id='. $id .
                                                ' AND 
                                                apartment_facility_type_id=apartment_tower_facility_apartment_facility_type_id
                                            ') 
                                            ->execute();
            $picture = $this->dbmodel->select("
                            apartment_tower_picture_id,
                            apartment_tower_picture_value   
                        ")
                        ->from("mo_info_apartment_tower_picture")
                        ->where('apartment_tower_picture_apartment_tower_id='. $id)
                        ->execute();
            $data_picture = array();
            $j = 0;
            foreach($picture as $picture_item) {
                $data_picture[$j]['id'] = $picture_item['apartment_tower_picture_id'];
                $data_picture[$j]['url'] = 'http://localhost/mo-info-api/assets/img/'. $picture_item['apartment_tower_picture_value'];
                $j++;
            }
            $master_data[$i]['picture'] = $data_picture;
            $i++;
        }
        return $master_data;
    }
}
