<?php

Class Model_marketings extends Ci_Model
{

    function  get_marketings($limit, $ofset)
    {
        return $this->dbmodel->select("
            marketing_id AS id,
            marketing_name AS name,
            marketing_agency_name AS agency,
            marketing_datetime AS date
        ")
        ->from("mo_info_marketing,mo_info_marketing_agency")
        ->where('mo_info_marketing_agency.marketing_agency_id = mo_info_marketing.marketing_agency_id')
        ->limit($limit)
        ->offset($ofset)
        ->execute();
    }

    function get_marketing($id = null)
    {
        return $this->dbmodel->select("
            marketing_id AS id,
            marketing_name AS name,
            marketing_agency_name AS agency,
            marketing_datetime AS date,
            marketing_gender AS gender,
            marketing_date_of_birth AS date_of_birth,
            marketing_religion AS religion,
            marketing_rating AS rating
         ")
        ->from("mo_info_marketing,mo_info_marketing_agency")
        ->where('marketing_id ='. $id .' AND    
          mo_info_marketing_agency.marketing_agency_id=mo_info_marketing.marketing_agency_id')
        ->is_single_row(true)
        ->execute();     
    }
    
    function get_referals($id=null,  $offset, $limit)
    {
        return $this->dbmodel->select("
           customer_id AS id,
           customer_first_name AS first_name,
           customer_last_name AS last_name,
           customer_address AS address,
           customer_job AS Jobs,
           customer_email AS email,
           customer_phone AS phone
        ")
        ->from('mo_info_customer')
        ->where('customer_id='. $id)
        ->limit($limit)
        ->offset($offset)
        ->execute();
    }
    
    function get_unit_transaction($id = null, $limit, $offset)
    {
        return $this->dbmodel->select("
             apartment_unit_transaction_id AS id,
             customer_first_name AS customer_name,
             marketing_name AS marketing_name,
             apartment_unit_transaction_datetime AS date
        ")
        ->from('mo_info_apartment_unit_transaction,mo_info_marketing,mo_info_customer')
        ->where('apartment_unit_transaction_marketing_id='. $id . ' AND marketing_id = apartment_unit_transaction_marketing_id AND  customer_id  = apartment_unit_transaction_customer_id')
        ->limit($limit)
        ->offset($offset)
        ->execute();
    }
    
    function get_unit_transaction2($id = null, $id2=null, $limit, $offset)
    {
        return $this->dbmodel->select("
             apartment_unit_transaction_id AS id,
             customer_first_name AS customer_name,
             marketing_name AS marketing_name,
             apartment_unit_transaction_datetime AS date,
             apartment_unit_name AS unit,
             apartment_unit_type_name AS type,
             apartment_unit_price AS price,
             apartment_unit_transaction_price AS price_after,
             apartment_unit_transaction_status AS status,
             apartment_unit_transaction_expired_datetime AS exp_paid,
             apartment_unit_transaction_info AS note
        ")
        ->from('mo_info_apartment_unit_transaction,mo_info_marketing,mo_info_customer,mo_info_apartment_unit,mo_info_apartment_unit_type')
        ->where('apartment_unit_transaction_marketing_id='. $id . ' AND apartment_unit_transaction_id='. $id2 .' AND marketing_id = apartment_unit_transaction_marketing_id AND  customer_id  = apartment_unit_transaction_customer_id AND apartment_unit_id = apartment_unit_transaction_apartment_unit_id AND apartment_unit_type_id=apartment_unit_apartment_unit_type_id')
        ->limit($limit)
        ->offset($offset)
        ->execute();
    }
}
