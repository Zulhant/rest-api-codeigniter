<?php

Class Model_countries extends Ci_Model{

    function  get_countries($limit,$ofset){
        return $this->dbmodel->select("
            country_id AS id,
            country_name AS name
        ")
        ->from("mo_info_country")
        ->limit($limit)
        ->offset($ofset)
        ->execute();
    }

    function get_country($id = null){
        return $this->dbmodel->select("
            country_id AS id,
            country_name AS name
         ")
        ->from("mo_info_country")
        ->where("country_id=". $id)
        ->is_single_row(true)
        ->execute();     
    }

    function get_country_province($id = null){
        $data=array(
            $this->dbmodel->select("
            province_id AS id,
            province_name AS name
        ")
        ->from("mo_info_country,mo_info_province")
        ->where('province_country_id=country_id AND province_country_id='. $id)
        ->execute()
        );
        return $data;
    }
}
