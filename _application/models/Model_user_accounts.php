<?php

class Model_user_accounts extends Ci_Model{
   //get all data
    function get_users($limit, $offset) {
        $data=$this->dbmodel->select("
            user_account_id AS id,
            user_account_username AS name,
            group_name AS group,
            user_account_picture AS picture,
            user_account_is_active AS is_active
        ")
        ->from("mo_info_user_account,mo_info_group")
        ->where("user_account_group_id = group_id")
        ->limit($limit)
        ->offset($offset)
        ->execute();
        return $data;
    }
   //get data by id
    function get_user($id = null) {
        $data= $this->dbmodel->select("
            user_account_id AS id,
            user_account_username AS name,
            group_name AS group,
            user_account_picture AS picture,
            user_account_is_active AS is_active
        ")
        ->from("mo_info_user_account,mo_info_group")
        ->where("user_account_id =". $id)
        ->is_single_row(true)
        ->execute();
        return $data;
    }
}
