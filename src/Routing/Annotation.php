<?php

namespace Routing;

class Annotation {
    
    public $method;
    public $class;
    public $annotation;
    public $baseAnnotation;
    
    public function getValue( $key ){
        preg_match_all('#@(.*?)\n#s', $this->annotation, $bulk);
        foreach( $bulk as $item ){
            foreach( $item as $annotation ){
                if( $annotation[0] == "@" ) continue;
                
                $value = explode("('", $annotation );
                
                if( $value[0] === $key ){
                    $value = explode("')", $value[1] );
                    return $value[0];
                }
            } 
        }
    }
    
    public function getBaseValue( $key ){
        preg_match_all('#@(.*?)\n#s', $this->baseAnnotation, $bulk);
        foreach( $bulk as $item ){
            foreach( $item as $annotation ){
                if( $annotation[0] == "@" ) continue;
                
                $value = explode("('", $annotation );
                
                if( $value[0] === $key ){
                    $value = explode("')", $value[1] );
                    return $value[0];
                }
            } 
        }
    }
}