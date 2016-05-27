<?php

namespace GException;

class MaintenanceException extends AbstractException{

    public function __construct(string $message)
    {
        if( $_REQUEST['run'] == "getLoginView" && $_REQUEST['argument'] == "void")
            header("Location:http://".$_SERVER['SERVER_ADDR']."/COMPARED/MAINTENANCE/Gui.php");
        else
            parent::__construct($message, 'Maintenance');
    }
}