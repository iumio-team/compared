<?php


/**
 * Description of AutoLoad
 *
 * @author RAFINA DANY <danyrafina@gmail.com>  
 */
class Autoloader {
    
    static function register(string $class):int
    {
        require_once $class;
        return (0);
    }
}
