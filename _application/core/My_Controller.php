<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
class My_Controller extends REST_Controller {

    protected $jwt_key = "oeSvNzH5W3Dl0QshsvxlB5YV+19/f79Fu6rfmfUvl62sJAJFpgAFLga1av+XCE1XRe6u+9OkGBvzZyWKASOBYg==";
    protected $jwt_err_message = '';
    public static $response_code = array(
        200 => 'OK',
        201 => 'Created',
        204 => 'No Content',
        304 => 'Not Modified',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        409 => 'Conflict',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
    );
    protected $middlewares = array();

    public function __construct() {
        parent::__construct();

        $this->run_middlewares();
    }

    protected function middleware(){
        return array();
    }

    protected function run_middlewares(){
        $this->load->helper('inflector');

        $middlewares = $this->middleware();

        foreach($middlewares as $middleware) {
            $middleware_array = explode('|', str_replace(' ', '', $middleware));
            $middleware_name = $middleware_array[0];
            $run_middleware = true;
            
            if(isset($middleware_array[1])){
                $options = explode(':', $middleware_array[1]);
                $type = $options[0];
                $methods = explode(',', $options[1]);
                
                if ($type == 'except') {
                    if (in_array($this->router->method, $methods)) 
                        $run_middleware = false;
                } else if ($type == 'only') {
                    if (!in_array($this->router->method, $methods)) 
                        $run_middleware = false;
                }
            }

            $filename = ucfirst($middleware_name) .'_middleware';

            if ($run_middleware) {
                if (file_exists(APPPATH .'middlewares\\' . $filename . '.php')) {
                    require APPPATH .'middlewares\\' . $filename . '.php';

                    $ci = &get_instance();
                    $object = new $filename($this, $ci);
                    
                    $object->run();
                    $this->middlewares[$middleware_name] = $object;
                } else {
                    if (ENVIRONMENT == 'development')
                        show_error('Unable to load middleware: ' . $filename . '.php');
                    else 
                        show_error('Sorry something went wrong.');
                }
            }
        }

    }

    public function get_jwt_err_message() {
        return $this->jwt_err_message;
    }

    public function get_jwt_key() {
        return $this->jwt_key;
    }

    public function send_response($code = REST_Controller::HTTP_OK, $data = array(),  $message = '') {
        $this->add_cors_domain_headers();
        
        $this->response(
            array(
                'code' => $code,
                'message' => (empty($message) ? My_Controller::$response_code[$code] : $message),
                'data' => ((empty($data)) ? new stdClass() : $data)
            ),
            $code,
            false
        );
    }

    public function get_bearer_token() {
        $header = $this->input->get_request_header('Authorization');
        
        if (!empty($header)) 
            return preg_match('/Bearer\s(\S+)/', $header, $matches) ? $matches[1] : null;
        else 
            return null;
    }

    public function validate_token() {
        try {
            $bearer_token = $this->get_bearer_token();

            if(!empty($bearer_token)) {
                $jwt = $this->jwt->decode($bearer_token, $this->jwt_key, array("HS256"));

                $user_account = $this->dbmodel->select("user_account_id")
                    ->from("mo_info_user_account")
                    ->where("user_account_id=". $jwt->id)
                    ->is_single_row(true)
                    ->execute();

                return !empty($user_account);
            } else {
                $this->jwt_err_message = My_Controller::$response_code[401];

                return false;
            }
        } catch (Exception $e) {
            $this->jwt_err_message = $e->getMessage();
            return false;
        }
    }

    public function add_extra_time($jwt) {
        $next_exp = strtotime("+1 hour", $jwt->exp);
        
        return $this->create_token($jwt->id, $jwt->username, $next_exp);
    }

    public function create_token($id, $username, $extra_time = 0) {
        $date = new Datetime();
        
        $payload['id'] = $id;
        $payload['username']= $username;
        $payload['iat'] = $date->getTimestamp();
        $payload['exp'] = ($extra_time == 0 ? ($date->getTimestamp() + 3600) : $extra_time);
        $output['token'] = $this->jwt->encode($payload, $this->jwt_key);
        
        return $output['token'];
    }

    public function add_auth_bearer_token($jwt) {
        header("Content-Type: application/json");
        header("HTTP/1.1 200 OK");
        header("Authorization: Bearer ". $jwt);
    }

    public function add_cors_domain_headers() {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
        header('Access-Control-Expose-Headers: Authorization, X-Custom-Header');
    }
}


