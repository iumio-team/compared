<?php

/** This is the Router which enables to redirect 
 * @author  RAFINA DANY <danyrafina@gmail.com>
 * 
 */
use GException\RuntimeError;
class Router {

    public function __construct($run,$arg) {
        if($run == "show") {
            echo self::showView($arg);
        }
        else {
            echo self::__callMaster('getLoginView',NULL);
        }
    }
    
    public static function runnable($run,$arg) {
        echo self::__callMaster($run, $arg);
    }

    static public function showView($argArray) {
        switch ($argArray[0]) {
            case 'viewLogin':
                if (empty($argArray[1])) {
                    return $_SESSION['twig']->render('viewLogin.html.twig');
                } else {
                    return $_SESSION['twig']->render('viewLogin.html.twig', array('message' => $argArray[1]));
                }
                break;
            case 'viewDashboard':
                $countSmart = $argArray[1];
                $countUser = $argArray[2];
                $UserType = $argArray[3];
                $firstName = $argArray[4];
                $lastName = $argArray[5];
                $countCompared = $argArray[6];
                $countNotice = $argArray[7];
                $countHelp = $argArray[8];
                return $_SESSION['twig']->render('viewDashboard.html.twig', array('countSmart' => $countSmart, 'countUser' => $countUser, 'userType' => $UserType, 'userLastName' => $lastName, 'userFirstName' => $firstName, 'nbCompared' => $countCompared, 'nbNotice' => $countNotice, 'nbHelp' => $countHelp));
                break;
            case 'viewMessage':
                return $_SESSION['twig']->render('viewMessage.html.twig', array('messages' =>$argArray[1], 'userLastName' => $_SESSION['lastName'], 'userFirstName' => $_SESSION['firstName'], 'userType' => $_SESSION['userType'], 'id' => $_SESSION['idU']));
                break;
             case 'viewNotice':
                return $_SESSION['twig']->render('viewNotice.html.twig', array('notices' => $argArray[1], 'userLastName' => $_SESSION['lastName'], 'userFirstName' => $_SESSION['firstName'], 'userType' => $_SESSION['userType'], 'id' => $_SESSION['idU']));
                break;
             case 'viewInfoApp':
                return $_SESSION['twig']->render('viewInfoApp.html.twig', array('userLastName' => $_SESSION['lastName'], 'userFirstName' => $_SESSION['firstName'], 'userType' => $_SESSION['userType'], 'id' => $_SESSION['idU']));
                break;
            default:
                self::__callMaster('getLoginView',NULL);
                break;
        }
    }

    static public function __callMaster($run, $arg) {
        switch ($run) {
            case 'connectUser':
                $pseudo = $arg['id'];
                $password = $arg['password'];
                Master::login($pseudo, $password);
                break;
            case 'logout':
                Master::logout();
                break;
            case 'compared' :
                Master::compare($arg['sm1'], $arg['sm2']);
                break;
           
            case 'getSpec':
                Master::getSpec($arg[0]);
                break;
            case 'sendMessage':
                Master::sendMessage($arg['name'], $arg['email'], $arg['object'], $arg['content']);
                break;
            case 'getMessages':
                Master::getMessages();
                break;
            case 'getNotices':
                Master::getNotices();
                break;
            case 'getDashboard' :
                Master::getDashboardInfo();
                break;
            case 'getInfoApp' :
                Master::getInfoApp();
                break;
             case 'deleteMessage' :
                Master::deleteMessage($arg[0]);
                break;
            case 'getMaintenanceStatus' :
                Master::isMaintenance();
                break;
            case 'authPIN' :
                Master::authPIN($arg['pin']);
                break;
            case 'getLoginView':
                Master::getLoginView();
                break;
            default :
                throw new RuntimeError("(Maintenance) Erreur d'exécution de l'instruction demandé");
        }
    }

}
