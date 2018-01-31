<?php

Class Modelapartment_types extends Ci_Model{

    function  get_types($limit,$ofset){
        return $this->dbmodel->select("
            apartment_unit_type_id AS id,
            apartment_unit_type_name AS name
        ")
        ->from("mo_info_apartment_unit_type")
        ->limit($limit)
        ->offset($ofset)
        ->execute();
    }

    function get_type($id = null){
        return $this->dbmodel->select("
            apartment_unit_type_id AS id,
            apartment_unit_type_name AS name
         ")
        ->from("mo_info_apartment_unit_type")
        ->where("apartment_unit_type_id = ". $id)
        ->is_single_row(true)
        ->execute();     
    }
}
