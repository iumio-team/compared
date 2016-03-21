<?php
/**
 * This files enables to make verification of app .
 * @since 0.09
 * @author RAFINA DANY <danyrafina@gmail.com>
 * @version 0.30
 * @php_version 7.00 RTM
 */

use GException\{LoadingError};
use Compared\LayerConnector\MDA;

use Compared\Services\{TwigServices, MaintenanceServices, DatabaseServices, ComparatorServices};
class Starter {

    public $isReady = 0;
    public $isMaintenance = 0;

    public function __construct()
    {
        $this->__autoloader();
        $this->isReady = (new TwigServices())->start();
        $this->isMaintenance = (new MaintenanceServices())->start();
        $this->isReady = (new DatabaseServices())->start();
        $this->initApp();
        $this->isReady = (new ComparatorServices())->start("program");
    }
    
    
    private function __autoloader() {
        try
        {
            include_once 'Autoloader.php';
            $this->isReady = 1;
        }
        catch (Exception $e)
        {
            throw new LoadingError("Le chargeur de classe n'est pas disponible");
            $this->isReady = 0;
        }
    }

    private function initApp()
    {
        if (file_exists('Pointer.php'))
            $this->isReady = 1;
        else
        {
            $this->isReady = 0;
            $loadingError = "Le routeur de l'application n'existe pas.";
            throw new LoadingError($loadingError);
        }
    }

}
