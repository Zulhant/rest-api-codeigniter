<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_function {

    var $CI;

    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->database();
    }
    
    function object_to_array($d) {
        if (is_object($d)) {
            // Gets the properties of the given object
            // with get_object_vars function
            $d = get_object_vars($d);
        }

        if (is_array($d)) {
            /*
             * Return array converted to object
             * Using __FUNCTION__ (Magic constant)
             * for recursive call
             */
            return array_map(__FUNCTION__, $d);
        } else {
            // Return array
            return $d;
        }
    }
    
    function array_to_object($d) {
        if (is_array($d)) {
            /*
             * Return array converted to object
             * Using __FUNCTION__ (Magic constant)
             * for recursive call
             */
            return (object) array_map(__FUNCTION__, $d);
        } else {
            // Return object
            return $d;
        }
    }
    
    function set_number_format($number, $is_int = true) {
        if((is_numeric($number) && floor($number) != $number) || $is_int == false) {
            return number_format($number, 2, '.', ',');
        } else {
            return number_format($number, 0, '.', ',');
        }
    }
    
    function set_gender_label($gender = '') {
        if($gender != '') {
            if($gender == 'male') {
                $label = 'Pria';
            } elseif($gender == 'female') {
                $label = 'Wanita';
            } else {
                $label = '-';
            }
        } else {
            $label = '-';
        }
        
        return $label;
    }

    function convert_to_arr($string) {
        $data = array();
        $src_array = explode(',', $string); 

        foreach($src_array as $tmp) {
            $data[] = trim(preg_replace('/\t+/', '', $tmp));
        }

        return $data;
    }

    function remove_unnecessary_chars($string) {
        return trim(preg_replace('/\t+/', '', $string));
    }


    function current_page_url() {
        $pageURL = 'http';
        
        if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
            $pageURL .= "://";
     
        if ($_SERVER["SERVER_PORT"] != "80") 
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        else 
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
     
     return $pageURL;
    }
    
}