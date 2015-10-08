<?php

/** Class Controller :
 * This is the principal class which communicate with Model and Pointer
 * @since 0.03
 * @author RAFINA DANY <danyrafina@gmail.com>
 * @version 0.30
 * 
 */
use LayerConnector\MDA;

class Controller {

    static private $key;

    /**
     * Method enables to login 
     * @param string login Login User
     * @param string passwd Password User
     * @return void
     */
    static public function login($pseudo, $passwd) {

        $result = MDA::getOneUser($pseudo, $passwd)->fetchAll();

        if (!empty($result)) {
            $pseudoBDD = rtrim($result[0]['pseudoU']);
            $passwdBDD = rtrim($result[0]['passwordU']);
            if (($pseudo === $pseudoBDD) && ($passwd === $passwdBDD)) {
                $id = rtrim($result[0]['idU']);

                $userType = rtrim(UtilityFunction::translateEnToFr($result[0]['nameUT']));

                $userFN = rtrim($result[0]['firstNameU']);

                $userLN = rtrim($result[0]['lastNameU']);

                $_SESSION['firstName'] = $userFN;
                $_SESSION['lastName'] = $userLN;
                $_SESSION['userType'] = $userType;
                $_SESSION['idU'] = $id;
                $_SESSION['pseudoU'] = $pseudoBDD;

                self::getDashboardInfo();
            }
        } else {

            self::failLogin('failAuth');
        }
    }

    static public function destroySessions() {
        unset($_SESSION['firstName']);
        unset($_SESSION['lastName']);
        unset($_SESSION['userType']);
        unset($_SESSION['idU']);
        unset($_SESSION['pseudoU']);
        session_destroy();
    }

    static public function getMasterFile() {
        try {
            return Spyc::YAMLLoad('PRIVATE/AppInfo.yml');
        } catch (Exception $ex) {
            throw new LoadingError('Erreur de chargement du module YAML');
        }
    }

    static public function logout() {

        self::destroySessions();

        $logoutMessage = 'Vous êtes dorénavant déconnecté';

        new Pointer('show', array('viewLogin', $logoutMessage));
    }

    static public function isConnected() {
        if (isset($_SESSION['idU'])) {
            $object = new User($_SESSION['idU']);
            $object->getItem();
            if ($object->getUserLogin() == $_SESSION['pseudoU'])
                return true;
            else
                return false;
        }

        else {
            return false;
        }
    }

    static public function getDashboardInfo() {
        if (self::isConnected()) {

            $nbS = MDA::countLine('Smartphone', 'idS')->fetch()['count'];
            $nbU = MDA::countLine('User', 'idU')->fetch()['count'];
            $nbC = MDA::countLine('COMPARED', 'idCOMPARED')->fetch()['count'];
            $nbN = MDA::countLine('Notice', 'idA')->fetch()['count'];
            $nbM = MDA::countLine('HelpMessage', 'id')->fetch()['count'];

            new Pointer('show', array('viewDashboard', $nbS, $nbU, $_SESSION['userType'], $_SESSION['firstName'], $_SESSION['lastName'], $nbC, $nbN, $nbM));
        } else {
            self::failLogin('failAuth');
        }
    }

    /** This function prepare all items on homepage such as smartphone counter
     * @return array Smartphone counter , Compare counter and People notice about COMPARED App , rencent comparison
     * 
     */
    static public function prepareHomepageItem() {
        $nbS = MDA::countLine('Smartphone', 'idS')->fetch()['count'];
        $nbC = MDA::countLine('COMPARED', 'idCOMPARED')->fetch()['count'];
        $listAv = MDA::findAll('Notice')->fetchAll();
        $recentComparison = self::getRecentComparison();
        $finalAddedSm = MDA::customQuery("SELECT idS FROM Smartphone ORDER BY idS DESC LIMIT 1;")->fetch();
        $sm = new Smartphone($finalAddedSm['idS']);
        $sm->getItem();
        new Pointer("show", array("viewHomePage", array('nbS' => $nbS, 'nbC' => $nbC, 'noticeList' => $listAv, 'recentC' => $recentComparison,'lastSm'=>$sm)));
    }

    /** This is the essential function of Application which compare all smartphone caracteristics
     * @param string s1 Smartphone name 1
     * @param string s2 Smartphone name 2
     * @return array Array of comparison
     */
    static public function compare($S1,$S2) {
        if($S1 !== NULL || $S2 !== NULL  ){
            if (self::isComparatorLink()) {
                $sm1 = new Smartphone($S1);
                $sm1->getItem();
                $sm2 = new Smartphone($S2);
                $sm2->getItem();
                $yamlFile = self::getMasterFile();
                $url = $yamlFile['ENGINE_COMPARATOR']['LINK_TO_ENGINE_COMPARATOR'];
                $data = array('Action' => 'MC', 'sm1' => serialize($sm1), 'sm2' => serialize($sm2), 'appname' => $yamlFile["APP_NAME"], 'key' => $yamlFile['ENGINE_COMPARATOR']['Token'], 'ORM' => $yamlFile['ORM'], 'resultType' => 'ARRAY');
                $ch = curl_init($url);
                $post = http_build_query($data, '', '&');
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = unserialize(curl_exec($ch));
                curl_close($ch);
                $countPSM1 = $response['DUALITY_POINT_SM1'];
                $countPSM2 = $response['DUALITY_POINT_SM2'];
                $winner = $response['WINNER'];
                $processor = $response['PROCESSOR'];
                $screen = $response['SCREEN'];
                $gpu = $response['GPU'];
                $os = $response['OS'];
                $dimens = $response['DIMENS'];
                $network = $response['NETWORK'];
                $photo = $response['PHOTO'];
                $video = $response['VIDEO'];
                $ram = $response['RAM'];
                $storage = $response['STORAGE'];
                $battery = $response['BATTERY'];

                MDA::insertCompared($S1, $S2);

                new Pointer('show', array('viewCompared', $sm1, $sm2, $countPSM1, $countPSM2, $winner, $processor, $screen, $gpu, $os, $dimens, $network, $ram, $storage, $photo, $video, $battery));
            } else {
                throw new \GException\RuntimeError("Les fonctionnalités de comparaison ont été désactivées . Veuillez-contacter l'administrateur du site  ");
            }
        }
        else {
              throw new \RuntimeException("Votre comparaison comporte une anomalie . \n Veuillez réessayer ", NULL, NULL);
        }
    }

    /** Search a smartphone
     * 
     * @param String $search Word
     */
    static public function searchEngine(String $arg): object {
        $array = array();
        $smartphoneList = MDA::searchSmartphones($arg);
        foreach ($smartphoneList as $sm) {
            array_push($array, array('name'=>$sm['constructorS'] . ' ' . $sm['fullNameS'],"id"=>$sm['idS'],'picture'=>$sm['pictureS'])) ;
        }
        return $array;
    }

    /** Get smartphone list of manufacturer
     * @param $constructor Manufacturer
     */
    static public function phoneList($constructor) {
        $objectConstrucor = new Constructor($constructor);
       $objectConstrucor->getItem();
       $countSm = MDA::countLine('Smartphone','idS',array("attr"=>"constructorS",'exp'=>$constructor))->fetch() ;
       $array = MDA::findOne('Smartphone', $constructor, 'constructorS', 'idS,pictureS,fullNameS,constructorS')->fetchAll();
       new Pointer('show', array('viewPhoneList',$array,$objectConstrucor,$countSm['count']));
    }

    static public function getSpec($idS) {
        $sm = new Smartphone($idS);
        $sm->getItem();
        //$array = MDA::findAllById('Smartphone',$idS, 'idS')->fetch();
         new Pointer('show', array('viewSmSpec', $sm));
    }

    /** Get 3 recent Comparisons
     */
    static public function getRecentComparison() {
        $arrayRC = array();
        $recent = MDA::findRecentComparison();
        foreach ($recent as $oneComparison) {
            $sm1 = new Smartphone($oneComparison['idS1']);
            $sm1->getItem();
            $sm2 = new Smartphone($oneComparison['idS2']);
            $sm2->getItem();
            array_push($arrayRC, array('sm1' => array('id' => $sm1->getIdSm(), 'picture' => $sm1->getPictureSm(), 'fullName' => $sm1->getConstructorSm()->getName() . " " . $sm1->getFullNameSm()), 'sm2' => array('id' => $sm2->getIdSm(), 'picture' => $sm2->getPictureSm(), 'fullName' => $sm2->getConstructorSm()->getName() . " " . $sm2->getFullNameSm())));
        }
        return $arrayRC;
    }

    static public function isMaintenance() {
        if (self::isConnected()) {
            $yamlFile = self::getMasterFile();
            $isM = $yamlFile['MAINTENANCE'];
            if ($isM['MAINTENANCE_MODE'] == "DISABLED")
                echo 0;
            else
                echo 1;
        }
        else {
            self::failLogin("all");
        }
    }

    static public function authForMaintenance($pass) {
        if (self::isConnected()) {
            $result = self::PIN($pass);
            if ($result === 1) {
                self::switchMaintenance("ON", "COMPARED est en maintenance");
                self::destroySessions();
                echo "1";
            } else {
                echo '0';
            }
        } else {
            self::failLogin("all");
        }
    }

    /** Authentification with PIN code
     * 
     * @param int $pass The PIN CODE
     * @return string the result of authentification , 1 for good code and 0 for fail
     */
    static public function PIN($pass) {
        if (self::isConnected()) {
            $result = MDA::findOneById('PIN', $_SESSION['idU'], 'idU', 'PIN')->fetch();
            $pin = $result['PIN'];
            if ($pin === $pass) {
                return 1;
            } else {
                return 0;
            }
        } else {
            self::failLogin("all");
        }
    }

    static public function switchMaintenance($mode, $sentence) {
        if (self::isConnected()) {

            $yamlFile = self::getMasterFile();
            $isM = $yamlFile['MAINTENANCE'];
            switch ($mode) {
                case 'ON':
                    if ($isM['MAINTENANCE_MODE'] == "DISABLED") {
                        $yamlFile['MAINTENANCE']['MAINTENANCE_MODE'] = "ENABLED";
                        $yamlFile['MAINTENANCE']['MAINTENANCE_MESSAGE'] = $sentence;
                        $yamlFile['MAINTENANCE']['MAINTENANCE_TIMESTAMP'] = time();
                        $z = Spyc::YAMLDump($yamlFile);
                        $a = fopen('PRIVATE/AppInfo.yml', 'w');
                        fwrite($a, $z);
                    }
                    break;
                case "OFF":

                    if ($isM['MAINTENANCE_MODE'] == "ENABLED") {
                        $yamlFile['MAINTENANCE']['MAINTENANCE_MODE'] = "DISABLED";
                        $yamlFile['MAINTENANCE']['MAINTENANCE_MESSAGE'] = "NULL";
                        $yamlFile['MAINTENANCE']['MAINTENANCE_TIMESTAMP'] = "NULL";
                        $z = Spyc::YAMLDump($yamlFile);
                        $a = fopen('PRIVATE/AppInfo.yml', 'w');
                        fwrite($a, $z);
                    }

                    break;

                default:
                    throw new RuntimeException("Imposible de mettre COMPARED en maintenance", NULL, NULL);
                    break;
            }
        } else {
            self::failLogin('all');
        }
    }

    static public function prepareComparison() {
        if (self::isComparatorLink()) {
            $array = self::getAllSmartphone();
            new Pointer('show', array('viewStartCompared', $array));
        } else {
            throw new \GException\RuntimeError("Les fonctionnalités de comparaison ont été désactivées . Veuillez-contacter l'administrateur du site  ");
        }
    }

    static public function getLegalNotice() {
        new Pointer('show', array('viewLegalNotice'));
    }

    static public function getLoginView() {
        new Pointer('show', array('viewLogin', NULL));
    }

    static public function getAllSmartphone() {
        $array = MDA::findAll('Smartphone')->fetchAll();
        return $array;
    }

    static public function failLogin($arg) {
        self::destroySessions();
        switch ($arg) {
            case 'failAuth':
                new Pointer('show', array('viewLogin', "Votre identifiant ou mot de passe est incorrect"));

                break;
            case 'all':
                new Pointer('show', array('viewLogin', "N'essayez pas de faire l'escro si vous n'y êtes pas autorisé :-)"));
                break;

            default:

                break;
        }
    }

    static public function getMessages() {
        if (self::isConnected()) {
            new Pointer('show', array('viewMessage', self::getAllMessages()));
        } else {
            self::failLogin('all');
        }
    }

    static public function getInfoApp() {
        if (self::isConnected()) {
            new Pointer('show', array('viewInfoApp'));
        } else {
            self::failLogin('all');
        }
    }

    static public function getNotices() {
        if (self::isConnected()) {
            new Pointer('show', array('viewNotice', self::getAllNotice()));
        } else {
            self::failLogin('all');
        }
    }

    static public function getAllMessages() {
        $array = MDA::findAll('HelpMessage')->fetchAll();
        return $array;
    }

    static public function getAllNotice() {
        $array = MDA::findAll('Notice')->fetchAll();
        return $array;
    }

    static public function sendMessage($name, $email, $subject, $content) {
        $date = date('d/m/Y');
        $object = new HelpMessage(array('name' => $name, 'email' => $email, 'subject' => $subject, 'content' => $content, 'date' => $date));
        $result = $object->create();
        if ($result == 1) {
            echo "SEND";
        } else {
            echo "NOTSEND";
        }
    }

    public static function isComparatorLink() {
        $yamlFile = self::getMasterFile();
        $info = $yamlFile['ENGINE_COMPARATOR']['LINK'];
        if ($info === "NOTATTACHED") {
            return false;
        } else {
            return true;
        }
    }

    static public function deleteMessage($id) {
        $object = new HelpMessage($id);
        $object->getItem();
        if (!empty($object->getContent())) {
            try {
                $object->delete();
                echo 1;
            } catch (Exception $exc) {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    static public function getInfoComparator() {
        if (self::isConnected()) {
            $yamlFile = self::getMasterFile();
            $info = $yamlFile['ENGINE_COMPARATOR'];
            new Pointer('show', array('viewInfoComparator', $info['ENGINE_COMPARATOR_NAME'], $info['ENGINE_COMPARATOR_VERSION'], $info['ENGINE_COMPARATOR_SLOGAN'], $info['LINK_TO_ENGINE_COMPARATOR'], $info['Token'], UtilityFunction::translateEnToFr($info['LINK']),$info['LINK']));
        } else {
            self::failLogin('all');
        }
    }

    static public function getInfoComparatorToModify($optionalMessage = NULL) {
        if (self::isConnected()) {
            $yamlFile = self::getMasterFile();
            $info = $yamlFile['ENGINE_COMPARATOR'];
            new Pointer('show', array('viewModInfoComparator', $info['ENGINE_COMPARATOR_NAME'], $info['ENGINE_COMPARATOR_VERSION'], $info['ENGINE_COMPARATOR_SLOGAN'], $info['LINK_TO_ENGINE_COMPARATOR'], $info['Token'], $info['LINK'], $optionalMessage));
        } else {
            self::failLogin('all');
        }
    }

    static public function switchStatusComparator($pass, $mod) {
        if (self::PIN($pass) == 1) {
            $yamlFile = self::getMasterFile();
            switch ($mod) {
                case 'OFF':
                    $yamlFile['ENGINE_COMPARATOR']['LINK'] = "NOTATTACHED";
                    $z = Spyc::YAMLDump($yamlFile);
                    $a = fopen('PRIVATE/AppInfo.yml', 'w');
                    fwrite($a, $z);
                    fclose($yamlFile);
                    echo "1";
                    break;
                case 'ON':
                    $yamlFile['ENGINE_COMPARATOR']['LINK'] = "ATTACHED";
                    $z = Spyc::YAMLDump($yamlFile);
                    $a = fopen('PRIVATE/AppInfo.yml', 'w');
                    fwrite($a, $z);
                    fclose($yamlFile);
                    echo "1";
                    break;

                default:
                    fclose($yamlFile);
                    switch ($mod) {
                        case 'OFF':
                            throw new RuntimeException("Impossible de désactiver le comparateur", NULL, NULL);
                            break;
                        case 'ON':
                            throw new RuntimeException("Impossible de d'activer le comparateur", NULL, NULL);
                            break;
                        default:
                            throw new RuntimeException("Erreur fatale (ligne 429 => Controller )", NULL, NULL);
                            break;
                    }

                    break;
            }
        } else {
            echo '0';
        }
    }

    static public function modifyInfoComparator($name, $version, $slogan, $href, $token, $status) {
        if (self::isConnected()) {
            if ($name == '' || $token == '' || $href == '') {
                self::getInfoComparatorToModify("Un ou plusieurs champs sont vides , merci de rééssayer !");
            } else {
                if (strpos($href, 'http://') != 0) {
                    $href = "http://" . $href;
                }

                $file = self::getMasterFile();
                $file['ENGINE_COMPARATOR']['ENGINE_COMPARATOR_NAME'] = $name;
                $file['ENGINE_COMPARATOR']['ENGINE_COMPARATOR_VERSION'] = $version;
                $file['ENGINE_COMPARATOR']['ENGINE_COMPARATOR_SLOGAN'] = $slogan;
                $file['ENGINE_COMPARATOR']['LINK_TO_ENGINE_COMPARATOR'] = $href;
                $file['ENGINE_COMPARATOR']['Token'] = $token;
                $z = Spyc::YAMLDump($file);
                $a = fopen('PRIVATE/AppInfo.yml', 'w');
                fwrite($a, $z);
                self::getInfoComparatorToModify("Modification réussie");
            }
        } else {
            self::failLogin('all');
        }
    }

}
