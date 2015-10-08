<?php


/**
 * Description of AutoLoad
 *
 * @author RAFINA DANY <danyrafina@gmail.com>  
 */
class Autoloader {
    
    static function register($class){
        require_once $class;
    }
}
