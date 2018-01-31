<?php

class Parameter_validation_middleware {

    protected $controller;
    protected $ci;
    private $from = 0; //equal to offset
    private $to = 10; //equal to limit
    
    public function __construct($controller, $ci) {
        $this->controller = $controller;
        $this->ci = $ci;
    }
    
    public function run() {
        $from = $this->controller->get('from'); //offset
        $to = $this->controller->get('to'); //limit

        if(empty($to)) {
            if($from >= $this->to) 
                $this->to = $from * 2;
        }

        if(!empty($from)) 
            $this->from = $from;

        if(!empty($to))
            $this->to = $to;
    }

    public function get_from() {
        return $this->from;
    }

    public function get_to() {
        return $this->to;
    }

}

?>