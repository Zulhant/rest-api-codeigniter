<?php

Class Model_managements extends Ci_Model{

    function  get_managements($limit,$ofset){
        return $this->dbmodel->select("
            management_id AS id,
            management_name AS name,
            management_desc AS desc,
            management_picture AS picture,
            management_address AS address,
            management_latitude AS latitude,
            management_longitude AS longitude,
            management_postal_code AS postal_code,
            management_street_name AS street_name,
            district_name as district
        ")
        ->from("mo_info_management,mo_info_district")
        ->where("management_district_id=district_id")
        ->limit($limit)
        ->offset($ofset)
        ->execute();
    }

    function get_management($id = null){
        return $this->dbmodel->select("
            management_id AS id,
            management_name AS name,
            management_desc AS desc,
            management_picture AS picture,
            management_address AS address,
            management_latitude AS latitude,
            management_longitude AS longitude,
            management_postal_code AS postal_code,
            management_street_name AS street_name,
            district_name as district
        ")
        ->from("mo_info_management,mo_info_district")
        ->where("management_id =". $id)
        ->is_single_row(true)
        ->execute();     
    }
}
