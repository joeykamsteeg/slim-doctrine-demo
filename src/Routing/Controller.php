<?php

namespace Routing;

use API\App;
use Slim\Slim;
use API\Core\Applications;
use API\Core\Config;

abstract class Controller {

    /**
     * @var App
     */
    protected $app;
    protected $requestData;

    public function __construct(){
        $this->app = Slim::getInstance();
        
        if( $this->app->request()->isPost() || $this->app->request()->isPut() ){
            $this->requestData = $this->app->request()->params();
        }
    }
    
    public static function __callStatic($name, $arguments) {
        $calledClass = get_called_class();
        $obj         = new $calledClass;
        $name        = preg_replace('/^___/','',$name);
        call_user_func_array(array($obj, $name), $arguments);
    }
    
    /**
     *  @return App
     */
    protected function getApp(){
        return $this->app;
    }
    
    /**
     * @return string
     */
    protected function getName(){
        return $this->app->router()->getCurrentRoute()->getName();
    }
    
    /**
     * @return array
     */
    protected function getQueryVars( $key = null ){
        if( $key != null ){
            return $this->app->request()->get( $key );
        }

        return $this->app->request()->get();
    }

    /**
     * @return array
     */
    protected function getRequestData( $value = null ){
        if( !is_null( $value ) ){
            if( array_key_exists($value, $this->requestData ) ){
                return $this->requestData[$value];
            }

            return '';
        }
        return $this->requestData;
    }

    /**
     *  @return Json Object
     */
    protected function getRequestBody(){
        return json_decode( $this->app->request()->getBody() );
    }

    /**
     *
     */
    protected function getCurrentService(){
        $appId = 0;
        if( Config::getOption("environment") === "development" ){
            $appId = Config::getOption("appId");
        }

        $applications = new Applications();
        $application = $applications->getServiceConfig( $appId );
        return $application;
    }
    
    public static function getNamespace(){
        $reflectionClass = new \ReflectionClass( $this );
        var_dump( $reflectionClass );
    }
    
    public function getAnnotations(){
        $rc = new \ReflectionClass( get_class( $this ) );   
        $baseAnnotation = $rc->getDocComment(); 
        $methods = $rc->getMethods();
        
        $annotations = array();
        
        foreach( $methods as $method ){
            if( $method->class == get_class( $this ) ){
                $annotation = new Annotation();
                $annotation->class = get_class( $this );
                $annotation->baseAnnotation = $baseAnnotation;                
                $annotation->method = $method->name;
                $annotation->annotation = $rc->getMethod( $annotation->method )->getDocComment();

                array_push( $annotations, $annotation );
            }
        }   
        return $annotations;
    }
}