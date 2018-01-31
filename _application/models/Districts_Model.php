<?php

Class Districts_Model extends Ci_Model{

    function  get_districts($limit,$ofset){
        return $this->dbmodel->select("
            district_id AS id,
            district_name AS name
        ")
        ->from("mo_info_district")
        ->limit($limit)
        ->offset($ofset)
        ->execute();
    }

    function get_district($id = null){
        return $this->dbmodel->select("
            district_id AS id,
            district_name AS name
         ")
        ->from("mo_info_district")
        ->where("district_id =". $id)
        ->is_single_row(true)
        ->execute();     
    }

}
