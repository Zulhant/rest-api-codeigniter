<?php

class Developers_model extends Ci_Model{
   ///get apartment by develover id
    function get_developer_apartment($id) {
        return $this->dbmodel->select("
            apartment_id AS id,
            apartment_name AS name,
            management_name AS management,
            apartment_desc AS desc,
            apartment_address AS address,
            apartment_street_name AS street,
            district_name AS district,
            city_name AS city,
            province_name AS province,
            apartment_postal_code AS postal_code,
            apartment_latitude AS latitude,
            apartment_longitude AS longitude
            ")
        ->from("mo_info_apartment,mo_info_management,mo_info_district,mo_info_city,mo_info_province")
        ->where("apartment_management_id=management_id AND apartment_developer_id =". $id)
        ->where("apartment_district_id=district_id AND apartment_developer_id =". $id)
        ->where("district_city_id=city_id AND apartment_developer_id =". $id)
        ->where("city_province_id=province_id AND apartment_developer_id =". $id)
        ->execute();
    }
   //get developer by developer_id
    function get_developer($id) {
        $result= $this->dbmodel->select("
            developer_id AS id,
            developer_name AS name,
            developer_picture AS picture,
            developer_desc AS desc,
            developer_address AS address,
            district_name AS district,
            city_name AS city,
            province_name AS province,
            developer_street_name as street,
            developer_postal_code AS postal_code,
            developer_specialize_name AS specialize_name
         ")
        ->from("mo_info_developer,mo_info_district,mo_info_city,mo_info_province,mo_info_developer_specialize")
        ->where("developer_district_id=district_id AND developer_id = ". $id)
        ->where("district_city_id=city_id AND developer_id = ". $id)
        ->where("city_province_id=province_id AND developer_id = ". $id)
        ->where("developer_developer_specialize_id=developer_specialize_id AND developer_id=". $id)
        ->is_single_row(true)
        ->execute();
        return $result;
    }
    // get all developers data
    function get_developers($limit,$offset) {
        $result=$this->dbmodel->select("
            developer_id AS id,
            developer_name AS name,
            developer_picture AS picture,
            developer_desc AS desc,
            developer_address AS address,
            district_name AS district,
            city_name AS city,
            province_name AS province,
            developer_street_name as street,
            developer_postal_code AS postal_code,
            developer_specialize_name AS specialize_name
        ")
        ->from("mo_info_developer,mo_info_district,mo_info_city,mo_info_province,mo_info_developer_specialize")
        ->where("developer_district_id = district_id")
        ->where("district_city_id=city_id")
        ->where("city_province_id=province_id")
        ->where("developer_developer_specialize_id=developer_specialize_id")
        ->limit($limit)
        ->offset($offset)
        ->execute();
        return $result;
   }
}
