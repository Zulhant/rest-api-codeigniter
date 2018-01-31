<?php

Class Model_city extends Ci_Model{

    function  get_cities($limit,$ofset){
        return $this->dbmodel->select("
            city_id AS id,
            city_name AS name
        ")
        ->from("mo_info_city")
        ->limit($limit)
        ->offset($ofset)
        ->execute();
    }

    function get_city($id = null){
        return $this->dbmodel->select("
            city_id AS id,
            city_name AS name
         ")
        ->from("mo_info_city")
        ->where("city_id =". $id)
        ->is_single_row(true)
        ->execute();     
    }

    function get_cities_districtst($id = null){
        $data=array(
            $this->dbmodel->select("
            district_id AS id,
            district_name AS name
        ")
        ->from("mo_info_district")
        ->where('dsitrict_city_id ='. $id)
        ->execute()
        );
        return $data;
    }
}
