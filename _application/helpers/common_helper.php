<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Copyright 2017 NST.
 */

if (!function_exists('convert_month')) {

    function convert_month($month, $lang = 'id') {
        $month = (int) $month;
        switch ($lang) {
            case 'id':
                $arr_month = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember');
                break;

            default:
                $arr_month = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
                break;
        }
        
        if(array_key_exists($month - 1, $arr_month)) {
            $month_converted = $arr_month[$month - 1];
        } else {
            $month_converted = '';
        }

        return $month_converted;
    }

}


if (!function_exists('convert_date')) {

    function convert_date($date, $lang = 'id', $type = 'num', $format = '-') {
        if (!empty($date) && $date != '0000-00-00') {
            
            $date = substr($date, 0, 10);
            $year = substr($date, 0, 4);
            $month = substr($date, 5, 2);
            $day = substr($date, 8, 2);
            
            $sparated = ($type == 'text') ? ' ' : $format;
            if($type == 'text') $month = convert_month($month, $lang);
                    
            if($lang == 'id') {
                $date_converted = $day . $sparated . $month . $sparated . $year;
            } else if($lang == 'en') {
                if($type == 'text') $date_converted = $month . $sparated . $day . ', ' . $year;
                else $date_converted = $month . $sparated . $day . $sparated . $year;
            } else {
                $date_converted = $date;
            }
        } else {
            $date_converted = '-';
        }
        return $date_converted;
    }

}


if (!function_exists('convert_datetime')) {

    function convert_datetime($date, $lang = 'id', $type = 'num', $formatdate = '.', $formattime = ':') {
        if (!empty($date) && $date != '0000-00-00 00:00:00') {
            
            $year = substr($date, 0, 4);
            $month = substr($date, 5, 2);
            $day = substr($date, 8, 2);
            $time = strlen($date) > 10 ? substr($date, 11, 8) : '';
            $time = str_replace(':', $formattime, $time);
            
            $sparated = ($type == 'text') ? ' ' : '-';
            if($type == 'text') $month = convert_month($month, $lang);
                    
            if($lang == 'id') {
                $date_converted = $day . $sparated . $month . $sparated . $year . ' ' . $time;
            } else if($lang == 'en') {
                if($type == 'text') $date_converted = $month . $sparated . $day . ', ' . $year. ' ' . $time;
                else $date_converted = $month . $sparated . $day . $sparated . $year . ' ' . $time;
            } else {
                $date_converted = $date;
            }
        } else {
            $date_converted = '-';
        }
        return $date_converted;
    }

}

if (!function_exists('convertNullToString')) {
    function convertNullToString($v) {
        return (is_null($v)) ? "" : $v;
    }
}

?>
