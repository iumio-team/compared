<?php

/** This is the pointer which enables to redirect 
 * @author  RAFINA DANY <danyrafina@gmail.com>
 * 
 */

namespace Compared\Router;
use GException\{RuntimeError, LoadingError};
use Compared\Supervisor\Controller;

class Pointer {

    public function __construct(String $run, array $arg = null) {
        echo ($run == "show")? self::showView($arg) : self::__callController('getHomePage');
    }

    public static function runnable(String $run, array $arg) {
        echo self::__callController($run, $arg);
    }

    static public function showView(array $argArray) {
        switch ($argArray[0]) {
            case 'viewLogin':
                return (empty($argArray[1]))? $_SESSION['twig']->render('viewLogin.html.twig') : $_SESSION['twig']->render('viewLogin.html.twig', array('message' => $argArray[1]));
                break;
            case 'viewHomePage':
                try {
                    return $_SESSION['twig']->render('viewHomePage.html.twig', $argArray[1]);
                } catch (Exception $exc) {
                    new LoadingError("Erreur d'importation de la vue par défaut: \n " . $exc);
                }
                break;
            case 'viewStartCompared':
                return $_SESSION['twig']->render('viewStartCompared.html.twig',array('phoneList' => $argArray[1], "date"=>$argArray[2]));
                break;
            case 'viewTeam':
                return $_SESSION['twig']->render('viewTeam.html.twig',array("date"=>$argArray[1]));
                break;
            case 'viewArticles':
                return $_SESSION['twig']->render('viewArticles.html.twig', array('phoneList' => $argArray[1]));
                break;
            case 'viewPhoneList':
                return $_SESSION['twig']->render('viewPhoneList.html.twig', array('phoneList' => $argArray[1], 'constructor' => $argArray[2], 'countSm' => $argArray[3], "date"=>$argArray[4]));
                break;
            case 'viewSmSpec':
                return $_SESSION['twig']->render('viewSmSpec.html.twig', array('sm' => $argArray[1], 'moy' => $argArray[2]));
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
                return $_SESSION['twig']->render('viewMessage.html.twig', array('messages' => $argArray[1], 'userLastName' => $_SESSION['lastName'], 'userFirstName' => $_SESSION['firstName'], 'userType' => $_SESSION['userType'], 'id' => $_SESSION['idU']));
                break;
            case 'viewNotice':
                return $_SESSION['twig']->render('viewNotice.html.twig', array('notices' => $argArray[1], 'userLastName' => $_SESSION['lastName'], 'userFirstName' => $_SESSION['firstName'], 'userType' => $_SESSION['userType'], 'id' => $_SESSION['idU']));
                break;
            case 'viewInfoApp':
                return $_SESSION['twig']->render('viewInfoApp.html.twig', array('userLastName' => $_SESSION['lastName'], 'userFirstName' => $_SESSION['firstName'], 'userType' => $_SESSION['userType'], 'id' => $_SESSION['idU']));
                break;
            case 'viewCompared':
                return $_SESSION['twig']->render('viewCompared.html.twig', array('sm1' => $argArray[1], 'sm2' => $argArray[2], 'count1' => $argArray[3], 'count2' => $argArray[4], 'winner' => $argArray[5], 'processor' => $argArray[6], 'screen' => $argArray[7], 'gpu' => $argArray[8], 'os' => $argArray[9], 'dimens' => $argArray[10], 'network' => $argArray[11], 'ram' => $argArray[12], 'storage' => $argArray[13], 'photo' => $argArray[14], 'video' => $argArray[15], 'battery' => $argArray[16], "date"=>$argArray[17]));
                break;
            case 'viewInfoComparator':
                return $_SESSION['twig']->render('viewInfoComparator.html.twig', array('comparator_name' => $argArray[1], 'comparator_version' => $argArray[2], 'comparator_link' => $argArray[3], 'comparator_token' => $argArray[4], 'comparator_status' => $argArray[5], 'userLastName' => $_SESSION['lastName'], 'userFirstName' => $_SESSION['firstName'], 'userType' => $_SESSION['userType'], 'id' => $_SESSION['idU'], 'comparator_mod' => $argArray[7]));
                break;
            case 'viewModInfoComparator':
                return $_SESSION['twig']->render('viewModInfoComparator.html.twig', array('comparator_name' => $argArray[1], 'comparator_version' => $argArray[2], 'comparator_slogan' => $argArray[3], 'comparator_link' => $argArray[4], 'comparator_token' => $argArray[5], 'comparator_status' => $argArray[6], 'userLastName' => $_SESSION['lastName'], 'userFirstName' => $_SESSION['firstName'], 'userType' => $_SESSION['userType'], 'id' => $_SESSION['idU'], 'success' => $argArray[7]));
                break;
            default:
                self::__callController('getHomePage', NULL);
                break;
        }
    }

    static public function __callController(String $run, array $arg = null)
    {
        $controller = new Controller();
        switch ($run) {
            case 'connectUser':
                $pseudo = $arg[0]['id'];
                $password = $arg[0]['password'];
                $controller->login($pseudo, $password);
                break;
            case 'logout':
                $controller->logout();
                break;
            case 'compared' :
                $controller->compare($arg[0]['sm1'], $arg[0]['sm2']);
                break;
            case 'search' :
                echo $controller->searchEngine();
                break;
            case 'phoneList' :
                $controller->phoneList($arg[0]);
                break;
            case 'getSpec':
                $controller->getSpec($arg[0]);
                break;
            case 'sendMessage':
                $controller->sendMessage($arg['name'], $arg['email'], $arg['subject'], $arg['content']);
                break;
            case 'getMessages':
                $controller->getMessages();
                break;
            case 'getNotices':
                $controller->getNotices();
                break;
            case 'getDashboard' :
                $controller->getDashboardInfo();
                break;
            case 'getInfoApp' :
                $controller->getInfoApp();
                break;
            case 'deleteMessage' :
                $controller->deleteMessage($arg[0]);
                break;
            case 'getMaintenanceStatus' :
                $controller->isMaintenance();
                break;
            case 'authFM' :
                $controller->authForMaintenance($arg['pin']);
                break;
            case 'getHomePage':
                $controller->prepareHomepageItem();
                break;
            case 'prepareComparison':
                $controller->prepareComparison();
                break;
            case 'getLegalNotice':
                $controller->getLegalNotice();
                break;
            case 'getLoginView':
                $controller->getLoginView();
                break;
            case 'getInfoComparator':
                $controller->getInfoComparator();
                break;
            case 'authCP' :
                $controller->switchStatusComparator($arg[0]['pin'], $arg[0]['mod']);
                break;
            case 'getModInfoComparator':
                $controller->getInfoComparatorToModify();
                break;
            case 'getArticles':
                $controller->getArticles();
                break;
            case 'getTeam':
                $controller->getTeam();
                break;
            case 'submitFormComparator':
                $controller->modifyInfoComparator($arg['name'], $arg['version'], $arg['slogan'], $arg['link'], $arg['key']);
                break;
            case 'newSmScore':
                $controller->newSmScore($arg[0]['sm'], $arg[0]['score']);
                break;
            default :
                throw new RuntimeError("Erreur d'exécution de l'instruction demandé");
        }
        unset($controller);
    }

}
