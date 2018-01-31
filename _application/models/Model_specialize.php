<?php

Class Model_specialize extends Ci_Model{

    function  get_specializes($limit,$ofset){
        return $this->dbmodel->select("
            developer_specialize_id AS id,
            developer_specialize_name AS name
        ")
        ->from("mo_info_developer_specialize")
        ->limit($limit)
        ->offset($ofset)
        ->execute();
    }

    function get_specialize($id = null){
        return $this->dbmodel->select("
            developer_specialize_id AS id,
            developer_specialize_name AS name
         ")
        ->from("mo_info_developer_specialize")
        ->where("developer_specialize_id = ". $id)
        ->is_single_row(true)
        ->execute();     
    }
}
