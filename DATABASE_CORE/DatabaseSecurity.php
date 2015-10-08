<?php

/**
 * This class enables to have a better security 
 * @author RAFINA <danyrafina@gmail.com>
 * @since 0.09
 */

class DatabaseSecurity{
    
    private $element;
    
    public function __construct($element) {
        $this->element = $element;
    }
    
    
    public function clean() {
        addcslashes($this->element,'%_');
        return $this->element;
    } 
}