<?php

class Model_unit_types extends Ci_Model{
   //get all unit types
    function get_unit_types($limit, $offset) {
        $data = $this->dbmodel->select("
            apartment_unit_type_id AS id,
            apartment_unit_type_name AS name
        ")
        ->from("mo_info_apartment_unit_type")
        ->limit($limit)
        ->offset($offset)
        ->execute();
        return $data;
    }
   //get unit type by id
    function get_unit_type($id = null) {
       $data = $this->dbmodel->select("
            apartment_unit_type_id AS id,
            apartment_unit_type_name AS name
        ")
        ->from("mo_info_apartment_unit_type")
        ->where("apartment_unit_type_id =".$id)
        ->is_single_row(true)
        ->execute();
        return $data;
    }
}
