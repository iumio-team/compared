<?php

/**
 * Class Autoloader
 * This class loads a class when is calling
 */
class AutoloaderPa {

    /** Register this class
     * @param $class Class name
     */
    static public function register(String $class)
    {
        /// Je donne le chemin du projet
        $path = realpath('../../');
        $array2 = explode(chr(92), $class);
        $count2 = count($array2) - 1;
        $class = $array2[$count2].".php";
        foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path)) as $filename) {
            if (strpos($filename, '.php') !== false && !strpos($filename, 'ENGINE_TEMPLATES')
                && !strpos($filename, 'PRIVATE') && !strpos($filename, 'VIEWS')) {
                $array = explode("/", $filename);
                $count = count($array) - 1;
                if ($array[$count] == $class)
                    require_once $filename;
                //echo $filename."\n";
            }
        }
    }
}
spl_autoload_register('\AutoloaderPa::register');