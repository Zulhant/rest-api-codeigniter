<?php

class App extends My_Controller {
    
    function __construct() {
        parent::__construct();
        
    }

    protected function middleware() {
        return array('token_auth|except:login', 'login_auth|only:login');
    }
    
    function login_post() {
    	$this->send_response(REST_Controller::HTTP_OK, array(
    		$this->middlewares['login_auth']->get_user_account()
    	));
    }
    
}
