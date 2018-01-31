<?php

Class Banks_Model extends Ci_Model{

    function  get_banks($limit,$ofset){
        return $this->dbmodel->select("
            bank_id AS id,
            bank_name AS name,
            bank_picture AS picture
        ")
        ->from("mo_info_bank")
        ->limit($limit)
        ->offset($ofset)
        ->execute();
    }
}
