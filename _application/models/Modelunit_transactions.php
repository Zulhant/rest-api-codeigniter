<?php

Class Modelunit_transactions extends Ci_Model{

    function  get_unit_transactions($limit,$ofset){
        return $this->dbmodel->select("
            apartment_unit_transaction_id AS id,
            customer_first_name AS customer_name,
            marketing_name AS marketing_name,
            apartment_unit_name AS unit_name,
            apartment_unit_transaction_datetime AS date,
            apartment_unit_transaction_price AS price,
            apartment_unit_transaction_status AS status,
            apartment_unit_transaction_expired_datetime AS exp_date,
            apartment_unit_transaction_info AS info
        ")
        ->from("mo_info_apartment_unit_transaction,mo_info_customer,mo_info_marketing,mo_info_apartment_unit")
        ->where("customer_id=apartment_unit_transaction_customer_id")
        ->limit($limit)
        ->offset($ofset)
        ->execute();
    }

    function get_unit_transaction($id = null){
        return $this->dbmodel->select("
            apartment_unit_transaction_id AS id,
            customer_first_name AS customer_name,
            marketing_name AS marketing_name,
            apartment_unit_name AS unit_name,
            apartment_unit_transaction_datetime AS date,
            apartment_unit_transaction_price AS price,
            apartment_unit_transaction_status AS status,
            apartment_unit_transaction_expired_datetime AS exp_date,
            apartment_unit_transaction_info AS info
         ")
        ->from("mo_info_apartment_unit_transaction,mo_info_customer,mo_info_marketing,mo_info_apartment_unit")
        ->where("customer_id=apartment_unit_transaction_customer_id AND apartment_unit_transaction_id=". $id)
        ->is_single_row(true)
        ->execute();     
    }
}
