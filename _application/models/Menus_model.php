<?php

Class Menus_model extends Ci_Model{
    
    function  get_menus(){

        $mastermenu = array();

        $data = $this->dbmodel->select("
            menu_id,
            menu_name
        ")
        ->from("mo_info_menu")
        ->where("menu_is_active='1' AND menu_parent_id ='0'")
        ->execute();

        $i = 0;
        foreach($data AS $subs){
            $id = $subs['menu_id'];
            $mastermenu[$i]['id']=$id;
            $mastermenu[$i]['name']= $subs['menu_name'];
            $masterparent= array();
            $data2=$this->dbmodel->select("
                    menu_id,
                    menu_name
                 ")
                 ->from("mo_info_menu")
                 ->where("menu_parent_id=". $id)
                 ->execute();
            $ii= 0;
            foreach($data2 as $sublist){
                $id2 = $sublist['menu_id'];
                $masterparent[$ii]['name']=$sublist['menu_name'];
                $masterparent[$ii]['sub_subname']=$this->dbmodel->select("
                    menu_id,
                    menu_name
                ")
                ->from("mo_info_menu")
                ->where("menu_parent_id=". $id2)
                ->execute();
                $ii++;
            }

            $mastermenu[$i]['sub_name']=$masterparent;
            $i++;

        }
        return $mastermenu;
    }

    function get_menu($id = null){
        return $this->dbmodel->select("
            menu_id AS id,
            menu_parent_id AS parent_id,
            menu_name AS name,
            menu_is_active AS active,
            menu_order AS order
         ")
        ->from("mo_info_menu")
        ->where("menu_id =". $id)
        ->is_single_row(true)
        ->execute();     
    }
}
