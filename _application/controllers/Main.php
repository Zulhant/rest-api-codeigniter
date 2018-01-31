<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $data['heading'] = 'PT. Nusantara Sukses Teknologi';
        $data['message'] = '<p>If your see this page, congratulation your web api is ready</p>';
        $this->load->view('errors/html/error_general', $data);
    }
    
}