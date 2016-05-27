<?php

/** Class Supervisor :
 * This is the principal class which communicate with Model and Router
 * @since 0.03 PROTOTYPE
 * @author RAFINA DANY <danyrafina@gmail.com>
 * @version 0.16 ALPHA
 * 
 */
use LayerConnector\MDA;

class Supervisor {

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
            return Spyc::YAMLLoad('../PRIVATE/AppInfo.yml');
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
    static public function isMaintenance() {
        if (self::isConnected()) {
            $yamlFile = self::getMasterFile();
            $isM = $yamlFile['MAINTENANCE'];
            if ($isM['MAINTENANCE_MODE'] == "DISABLED") {
                echo 0;
            } else {
                $date = date("d-m-Y", $isM['MAINTENANCE_TIMESTAMP']) . " à " . date("H:i", $isM['MAINTENANCE_TIMESTAMP']);
                $element = strtotime(date('Y-m-d H:i:s', $isM['MAINTENANCE_TIMESTAMP'])) . "";
                echo json_encode(array("date" => $date, "timeelapsed" => self::get_timeago($element)));
            }
        } else {
            self::failLogin("all");
        }
    }

    
    static public function get_timeago($original) {
        // array of time period chunks
        $chunks = array(
            array(60 * 60 * 24 * 365, 'année'),
            array(60 * 60 * 24 * 30, 'moi'),
            array(60 * 60 * 24 * 7, 'semaine'),
            array(60 * 60 * 24, 'jour'),
            array(60 * 60, 'heure'),
            array(60, 'min'),
            array(1, 'sec'),
        );

        $today = time(); /* Current unix time  */
        $since = $today - $original;

        // $j saves performing the count function each time around the loop
        for ($i = 0, $j = count($chunks); $i < $j; $i++) {

            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];

            // finding the biggest chunk (if the chunk fits, break)
            if (($count = floor($since / $seconds)) != 0) {
                break;
            }
        }

        $print = ($count == 1) ? '1 ' . $name : "$count {$name}s";

        if ($i + 1 < $j) {
            // now getting the second item
            $seconds2 = $chunks[$i + 1][0];
            $name2 = $chunks[$i + 1][1];

            // add second item if its greater than 0
            if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0) {
                $print .= ($count2 == 1) ? ', 1 ' . $name2 : " $count2 {$name2}s";
            }
        }
        return $print;
    }
    
    static public function authForMaintenance($pass) {
        if (self::isConnected()) {
            $result = self::PIN($pass);
            if ($result === 1) {
                self::switchMaintenance("OFF");
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

    static public function switchMaintenance($mode, $sentence=NULL) {
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
                        $a = fopen('../PRIVATE/AppInfo.yml', 'w');
                        fwrite($a, $z);
                    }
                    break;
                case "OFF":

                    if ($isM['MAINTENANCE_MODE'] == "ENABLED") {
                        $yamlFile['MAINTENANCE']['MAINTENANCE_MODE'] = "DISABLED";
                        $yamlFile['MAINTENANCE']['MAINTENANCE_MESSAGE'] = "NULL";
                        $yamlFile['MAINTENANCE']['MAINTENANCE_TIMESTAMP'] = "NULL";
                        $z = Spyc::YAMLDump($yamlFile);
                        $a = fopen('../PRIVATE/AppInfo.yml', 'w');
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
                    $a = fopen('../PRIVATE/AppInfo.yml', 'w');
                    fwrite($a, $z);
                    fclose($yamlFile);
                    echo "1";
                    break;
                case 'ON':
                    $yamlFile['ENGINE_COMPARATOR']['LINK'] = "ATTACHED";
                    $z = Spyc::YAMLDump($yamlFile);
                    $a = fopen('../PRIVATE/AppInfo.yml', 'w');
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
                $a = fopen('../PRIVATE/AppInfo.yml', 'w');
                fwrite($a, $z);
                self::getInfoComparatorToModify("Modification réussie");
            }
        } else {
            self::failLogin('all');
        }
    }

}
