<?php

/** This is the pointer which enables to redirect 
 * @author  RAFINA DANY <danyrafina@gmail.com>
 * 
 */
use GException\{RuntimeError,LoadingError};
class Pointer {

    public function __construct($run,$arg) {
        if($run == "show") {
            echo self::showView($arg);
        }
        else {
            echo self::__callController('getHomePage',NULL);
        }
    }
    
    public static function runnable($run,$arg) {
        echo self::__callController($run, $arg);
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
            case 'viewHomePage':
                try {
                   // print_r($argArray[1]);
                //echo $argArray[2];
                     return $_SESSION['twig']->render('viewHomePage.html.twig',$argArray[1]);
                } catch (Exception $exc) {
                   new LoadingError("Erreur d'importation de la vue par défaut: \n ".$exc);
                }
                break;
            case 'viewStartCompared':
                return $_SESSION['twig']->render('viewStartCompared.html.twig', array('phoneList' => $argArray[1]));
                break;
            case 'viewPhoneList':
                    return $_SESSION['twig']->render('viewPhoneList.html.twig', array('phoneList' => $argArray[1],'constructor'=>  $argArray[2],'countSm'=>$argArray[3]));
                break;
            case 'viewSmSpec':
                return $_SESSION['twig']->render('viewSmSpec.html.twig', array('sm' => $argArray[1]));
                break;
            case 'viewLegalNotice':
                return $_SESSION['twig']->render('viewLegalNotice.html.twig');
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
            case 'viewCompared':
                return $_SESSION['twig']->render('viewCompared.html.twig', array('sm1' => $argArray[1], 'sm2' => $argArray[2], 'count1' => $argArray[3], 'count2' => $argArray[4], 'winner' => $argArray[5], 'processor' => $argArray[6], 'screen' => $argArray[7], 'gpu' => $argArray[8], 'os' => $argArray[9], 'dimens' => $argArray[10], 'network' => $argArray[11], 'ram' => $argArray[12], 'storage' => $argArray[13], 'photo' => $argArray[14], 'video' => $argArray[15], 'battery' => $argArray[16]));
                break;
             case 'viewInfoComparator':
                return $_SESSION['twig']->render('viewInfoComparator.html.twig', array('comparator_name'=>$argArray[1],'comparator_version'=>$argArray[2],'comparator_slogan'=>$argArray[3],'comparator_link'=>$argArray[4],'comparator_token'=>$argArray[5],'comparator_status'=>  $argArray[6],'userLastName' => $_SESSION['lastName'], 'userFirstName' => $_SESSION['firstName'], 'userType' => $_SESSION['userType'], 'id' => $_SESSION['idU'],'comparator_mod'=>$argArray[7]));
               break;
           case 'viewModInfoComparator':
                return $_SESSION['twig']->render('viewModInfoComparator.html.twig', array('comparator_name'=>$argArray[1],'comparator_version'=>$argArray[2],'comparator_slogan'=>$argArray[3],'comparator_link'=>$argArray[4],'comparator_token'=>$argArray[5],'comparator_status'=>  $argArray[6],'userLastName' => $_SESSION['lastName'], 'userFirstName' => $_SESSION['firstName'], 'userType' => $_SESSION['userType'], 'id' => $_SESSION['idU'],'success'=>$argArray[7]));
               break;
            default:
                self::__callController('getHomePage',NULL);
                break;
        }
    }

    static public function __callController($run, $arg) {
        switch ($run) {
            case 'connectUser':
                $pseudo = $arg['id'];
                $password = $arg['password'];
                Controller::login($pseudo, $password);
                break;
            case 'logout':
                Controller::logout();
                break;
            case 'compared' :
                Controller::compare($arg['sm1'], $arg['sm2']);
                break;
            case 'search' :
                echo Controller::searchEngine();
                break;
            case 'phoneList' :
                Controller::phoneList($arg[0]);
                break;
            case 'getSpec':
                Controller::getSpec($arg[0]);
                break;
            case 'sendMessage':
                Controller::sendMessage($arg['name'], $arg['email'], $arg['subject'], $arg['content']);
                break;
            case 'getMessages':
                Controller::getMessages();
                break;
            case 'getNotices':
                Controller::getNotices();
                break;
            case 'getDashboard' :
                Controller::getDashboardInfo();
                break;
            case 'getInfoApp' :
                Controller::getInfoApp();
                break;
             case 'deleteMessage' :
                Controller::deleteMessage($arg[0]);
                break;
            case 'getMaintenanceStatus' :
                Controller::isMaintenance();
                break;
            case 'authFM' :
                Controller::authForMaintenance($arg['pin']);
                break;
            case 'getHomePage':
                Controller::prepareHomepageItem();
                break;
            case 'prepareComparison':
                Controller::prepareComparison();
                break;
            case 'getLegalNotice':
                Controller::getLegalNotice();
                break;
            case 'getLoginView':
                Controller::getLoginView();
                break;
            case 'getInfoComparator':
                Controller::getInfoComparator();
                break;
             case 'authCP' :
                Controller::switchStatusComparator($arg['pin'], $arg['mod']);
                break;
            case 'getModInfoComparator':
                Controller::getInfoComparatorToModify();
                break;
            case 'submitFormComparator':
                Controller::modifyInfoComparator($arg['name'],$arg['version'],$arg['slogan'],$arg['link'],$arg['token']);
                break;
            default :
                throw new RuntimeError("Erreur d'exécution de l'instruction demandé");
        }
    }

}
