<?php

Class Agencies_model extends Ci_Model
{

    function  get_agencies($limit,$ofset)
    {
        return $this->dbmodel->select("
            marketing_agency_id AS id,
            marketing_agency_name AS name,
            marketing_agency_desc AS desc,
            marketing_agency_picture AS picture
        ")
        ->from("mo_info_marketing_agency")
        ->limit($limit)
        ->offset($ofset)
        ->execute();
    }

    function get_agenci($id=null)
    {
        return $this->dbmodel->select("
            marketing_agency_id AS id,
            marketing_agency_name AS name,
            marketing_agency_desc AS desc,
            marketing_agency_picture AS picture
         ")
        ->from("mo_info_marketing_agency")
        ->where("marketing_agency_id=". $id)
        ->is_single_row(true)
        ->execute();     
    }
    
    function get_marketings($id = null, $limit, $offset)
    {
       return $this->dbmodel->select("
            marketing_id AS id,
            marketing_name AS name,
            marketing_agency_name AS agency,
            marketing_datetime AS date
       ")
        ->from('mo_info_marketing,mo_info_marketing_agency')
        ->where('mo_info_marketing.marketing_agency_id='. $id . ' AND mo_info_marketing.marketing_agency_id=mo_info_marketing_agency.marketing_agency_id')
        ->limit($limit)
        ->offset($offset)
        ->execute();  
    }
}
