<?php
/**
 * Created by PhpStorm.
 * User: rafina
 * Date: 02/02/16
 * Time: 09:09
 */

namespace Compared\Services;
use Twig_Environment, Twig_Loader_Filesystem, Twig_Extension_Debug;
use Compared\Tools\UtilityFunction as UF;

class TwigServices
{

    private $dirViews;
    private $cache;
    private $debug;

    public function __construct(String $dirViews = null, bool $cache = false, bool $debug = true)
    {
       $this->dirViews = $dirViews;
        $this->cache = $cache;
        $this->debug = $debug;
    }

    protected function declare_twig():int
    {
        try {
            include_once UF::getRootProject().'/ENGINE_TEMPLATES/Twig/vendor/autoload.php';
            $_SESSION['twig'] = $e = new Twig_Environment(new Twig_Loader_Filesystem(($this->dirViews == null)? array(UF::getRootProject().'/VIEWS_N', UF::getRootProject().'/VIEWS_N/modules') : $this->dirViews), array('cache' => $this->cache, 'debug' => $this->debug));
            $_SESSION['twig']->addExtension(new Twig_Extension_Debug());
            return 1;
        } catch (Exception $e) {
            $error = "Twig n'est pas disponible";
            include UF::getRootProject().'/VIEWS/viewError.html.twig';
            return 0;
        }
    }

    public function start():int
    {
        return ($this->declare_twig());
    }
}