<?php

class Facilities_model extends Ci_Model{
   //get all facilities
    function get_facilities($limit, $offset) {
        return $this->dbmodel->select("
            apartment_facility_type_id AS id,
            apartment_facility_type_name AS name
        ")
        ->from("mo_info_apartment_facility_type")
        ->limit($limit)
        ->offset($offset)
        ->execute();
    }
   //get facility by id
    function get_faciliti($id) {
        return $this->dbmodel->select("
            apartment_facility_type_id AS id,
            apartment_facility_type_name AS name
        ")
        ->from("mo_info_apartment_facility_type")
        ->where("apartment_facility_type_id =". $id)
        ->is_single_row(true)
        ->execute();
    }
}
