<?php

class Model_contact extends Ci_Model{
   //get all contact_type
    function get_contact_types($limit, $offset) {
        $data = $this->dbmodel->select("
            contact_type_id AS id,
            contact_type_name AS name,
        ")
        ->from("mo_info_contact_type")
        ->limit($limit)
        ->offset($offset)
        ->execute();
        return $data;
    }
   //get contact_type by contact
    function get_contact_type($id = null) {
       $data = $this->dbmodel->select("
            contact_type_id AS id,
            contact_type_name AS name,
        ")
        ->from("mo_info_contact_type")
        ->where("contact_type_id =".$id)
        ->is_single_row(true)
        ->execute();
        return $data;
    }
}
