<?php

Class Province_model extends Ci_Model{

    function  get_provinces($limit,$ofset){
        return $this->dbmodel->select("
            province_id AS id,
            province_name AS name
        ")
        ->from("mo_info_province")
        ->limit($limit)
        ->offset($ofset)
        ->execute();
    }

    function get_province($id = null){
        return $this->dbmodel->select("
            province_id AS id,
            province_name AS name
         ")
        ->from("mo_info_province")
        ->where("province_id=". $id)
        ->is_single_row(true)
        ->execute();     
    }

    function get_provinces_cities($id = null){
        $data = array(
            $this->dbmodel->select("
            city_id AS id,
            city_name AS name
        ")
        ->from("mo_info_city")
        ->where('city_province_id='. $id)
        ->execute()
        );
        return $data;
    }
}
