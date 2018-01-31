<?php

class Token_auth_middleware {

    protected $controller;
    protected $ci;
    
    public function __construct($controller, $ci) {
        $this->controller = $controller;
        $this->ci = $ci;
    }
    
    public function run(){
        if(!$this->controller->validate_token()) {
            header("Content-Type: application/json");
            header("HTTP/1.1 401 Unauthorized");
            

            $this->controller->add_cors_domain_headers();

            $this->controller->send_response(REST_Controller::HTTP_UNAUTHORIZED, array(), $this->controller->get_jwt_err_message());
        } else {
            $jwt = $this->ci->jwt->decode(
                $this->controller->get_bearer_token(), 
                $this->controller->get_jwt_key(), 
                array("HS256")
            );

            $this->controller->add_auth_bearer_token($this->controller->add_extra_time($jwt));
        }
    }
}

?>