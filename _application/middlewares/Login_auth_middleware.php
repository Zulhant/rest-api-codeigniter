<?php

class Login_auth_middleware {

    protected $controller;
    protected $ci;
    private $user_account = array();
    
    public function __construct($controller, $ci) {
        $this->controller = $controller;
        $this->ci = $ci;
    }
    
    public function run() {
        $this->ci->load->model("login_model");
        
        $user_account = $this->ci->login_model->verify($this->controller->post('username'), $this->controller->post('password'));

        if($user_account) {
            $jwt = $this->controller->create_token($user_account['user_account_id'], $user_account['user_account_username']);
            $this->controller->add_auth_bearer_token($jwt);
            $this->user_account = array(
                "username" => $user_account['user_account_username'],
                "picture" => $user_account['user_account_picture']
            );
        } else 
            $this->controller->send_response(REST_Controller::HTTP_UNAUTHORIZED);
    }

    public function get_user_account() {
        return $this->user_account;
    }
}

?>