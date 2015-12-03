<?php

namespace App;

use Slim\Slim;
use Routing\RoutingManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class App extends Slim {
    
    private $config = null;
    private $routingManager = null;
    private $entityManager = null;
    
    public function __construct( $config ){
        parent::__construct();
        
        $this->config = $config;

        $this->routingManager = new RoutingManager(
            array(
                "cache" => dirname(__FILE__)."/../../cache",
                "controllers" => dirname(__FILE__)."/Controllers",
                "controller_namespace" => "App\\Controllers"
            )
        );
        
        $this->add( $this->routingManager );
    }

    public function getEntityManager(){
        if( $this->entityManager == null ){
            $this->entityManager = $this->createEntityManager();
        }

        return $this->entityManager;
    }

    private function createEntityManager(){
        $path = array( dirname(__FILE__).'/Entities' );
        $devMode = true;

        $config = Setup::createAnnotationMetadataConfiguration( $path, $devMode );

        $connectionOptions = array(
            'driver' => $this->config['DB_DRIVER'],
            'host' => $this->config['DB_HOST'],
            'dbname' => $this->config['DB_NAME'],
            'user' => $this->config['DB_USER'],
            'password' => $this->config['DB_PASS']
        );

        return EntityManager::create( $connectionOptions, $config );
    }

    public function sendResponse( $data, $code = 200 ){
        if( $code === 401 ){
            $data = array(
                'message' => 'unauthorized user',
                'status' => 401
            );
        }

        $this->response()->header('Access-Control-Allow-Credentials', true);
        $this->response()->header('Access-Control-Allow-Origin','*');
        $this->response()->header('Access-Control-Allow-Methods',"GET,POST,DELETE,PUT,OPTIONS");
        $this->response()->header('Content-Type', 'application/json');
        $this->response()->body( json_encode( $data ) );
        $this->response()->status( $code );
    }

    public function redirect( $url, $code = 200 ){
        header('Location: '.$url);
    }
}