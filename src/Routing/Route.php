<?php

namespace Routing;

class Route {
  
    public $class; 
    public $method;
    public $route;
    public $httpMethod;
    public $name;
    public $baseRoute;
    
    public function __construct(){
        $this->class = "";
        $this->method = "";
        $this->route = "";
        $this->httpMethod = "GET";
        $this->name = "";
        $this->baseRoute = "";
    }
    
}