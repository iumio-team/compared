<?php

/** Class Master Maintenance :
 * This is the principal class which communicate with Model and Router
 * @since 0.12
 * @version 0.14
 * @author RAFINA DANY <danyrafina@gmail.com>
 * 
 */
use LayerConnector\Queries;

class Master {

    /**
     * Method enables to login 
     * @param string login Login User
     * @param string passwd Password User
     * @return void
     */
    static public function login($pseudo, $passwd) {

        $result = Queries::getOneUser($pseudo, $passwd)->fetchAll();

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
    
     static public function getInfoComparator(){
         if (self::isConnected()) {
            $yamlFile = $_SESSION['APP_INFO'];
            $info = $yamlFile['ENGINE_COMPARATOR'];
            new Router('show',array('viewInfoComparator','comparator_name'=>$info['ENGINE_COMPARATOR_NAME'],'comparator_link'=>$info['LINK_TO_ENGINE_COMPARATOR'],'comparator_token'=>$info['TOKEN'],'comparator_status'=>UtilityFunction::translateEnToFr($info['LINK'])));
         }
         else {
             self::failLogin('all');
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

    static public function logout() {

        self::destroySessions();

        $logoutMessage = 'Vous êtes dorénavant déconnecté';

        new Router('show', array('viewLogin', $logoutMessage));
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

            $nbS = Queries::countLine('Smartphone', 'idS')->fetch()['count'];
            $nbU = Queries::countLine('User', 'idU')->fetch()['count'];
            $nbC = Queries::countLine('COMPARED', 'idCOMPARED')->fetch()['count'];
            $nbN = Queries::countLine('Notice', 'idA')->fetch()['count'];
            $nbM = Queries::countLine('HelpMessage', 'id')->fetch()['count'];

            new Router('show', array('viewDashboard', $nbS, $nbU, $_SESSION['userType'], $_SESSION['firstName'], $_SESSION['lastName'], $nbC, $nbN, $nbM));
        } else {
            self::failLogin('failAuth');
        }
    }

    /** This function prepare all items on homepage such as smartphone counter
     * @return array Smartphone counter , Compare counter and People notice about COMPARED App , rencent comparison
     * 
     */
    static public function prepareHomepageItem() {
        $nbS = Queries::countLine('Smartphone', 'idS')->fetch()['count'];
        $nbC = Queries::countLine('COMPARED', 'idCOMPARED')->fetch()['count'];
        ;
        $listAv = Queries::findAll('Notice')->fetchAll();
        $recentComparison = self::getRecentComparison();
        new Router("show", array("viewHomePage", array('nbS' => $nbS, 'nbC' => $nbC, 'noticeList' => $listAv, 'recentC' => $recentComparison)));
    }

    /** This is the essential function of Application which compare all smartphone caracteristics
     * @param string s1 Smartphone name 1
     * @param string s2 Smartphone name 2
     * @return array Array of comparison
     */
    static public function compare($S1, $S2) {
        $sm1 = new Smartphone($S1);
        $sm1->getItem();
        $sm2 = new Smartphone($S2);
        $sm2->getItem();
        $yamlFile = $_SESSION['APP_INFO'];
        $url = $yamlFile['LINK_TO_ENGINE_COMPARATOR'];
        $data = array('Action' => 'MC', 'sm1' => serialize($sm1), 'sm2' => serialize($sm2), 'appname' => $yamlFile["APP_NAME"], 'key' => $yamlFile['Token'], 'ORM' => $yamlFile['ORM'], 'resultType' => 'ARRAY');
        $ch = curl_init($url);
        $post = http_build_query($data, '', '&');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = unserialize(curl_exec($ch));
        curl_close($ch);
        //break;
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

        Queries::insertCompared($S1, $S2);

        new Router('show', array('viewCompared', $sm1, $sm2, $countPSM1, $countPSM2, $winner, $processor, $screen, $gpu, $os, $dimens, $network, $ram, $storage, $photo, $video, $battery));


        /*
         * COMPARE FUNCTION RUN THANKS ALL COMPARED FUNCTIONS
         */
    }

    /** Search a smartphone
     * 
     * @param String $search Word
     */
    static public function searchEngine() {
        $array = array();
        $smartphoneList = Queries::findAll('Smartphone')->fetchAll();
        foreach ($smartphoneList as $sm) {
            array_push($array, $sm['constructorS'] . ' ' . $sm['fullNameS']);
        }
        return $array;
    }

    /** Get smartphone list of manufactor
     * @param $constructor Manufactor
     */
    static public function phoneList($constructor) {
        $array = Queries::findOne('Smartphone', $constructor, 'constructorS', 'idS,pictureS,fullNameS,constructorS')->fetchAll();
        new Router('show', array('viewPhoneList', $array));
    }

    static public function getSpec($idS) {
        $sm = new Smartphone($idS);
        $sm->getItem();
        //$array = Queries::findAllById('Smartphone',$idS, 'idS')->fetch();
        new Router('show', array('viewSmSpec', $sm));
    }

    /** Get recent Comparison
     */
    static public function getRecentComparison() {
        $arrayRC = array();
        $recent = Queries::findRecentComparison();
        foreach ($recent as $oneComparison) {
            $sm1 = new Smartphone($oneComparison['idS1']);
            $sm1->getItem();
            $sm2 = new Smartphone($oneComparison['idS2']);
            $sm2->getItem();
            array_push($arrayRC, array('sm1' => array('id' => $sm1->getIdSm(), 'picture' => $sm1->getPictureSm(), 'fullName' => $sm1->getConstructorSm() . " " . $sm1->getFullNameSm()), 'sm2' => array('id' => $sm2->getIdSm(), 'picture' => $sm2->getPictureSm(), 'fullName' => $sm2->getConstructorSm() . " " . $sm2->getFullNameSm())));
        }
        return $arrayRC;
    }

    static public function get_timeago($original) {
        // array of time period chunks
        $chunks = array(
            array(60 * 60 * 24 * 365, 'année'),
            array(60 * 60 * 24 * 30, 'mois'),
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

    static public function isMaintenance() {
        if (self::isConnected()) {
            $yamlFile = $_SESSION['APP_INFO'];
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

    static public function authPIN($pass) {
        if (self::isConnected()) {
            $result = Queries::findOneById('PIN', $_SESSION['idU'], 'idU', 'PIN')->fetch();
            $pin = $result['PIN'];
            if ($pin === $pass) {
                self::switchMaintenance("OFF", "NULL");
                self::destroySessions();
                echo "1";
            } else {
                echo '0';
            }
        } else {
            self::failLogin("all");
        }
    }

    static public function switchMaintenance($mode, $sentence) {
        if (self::isConnected()) {

            $yamlFile = $_SESSION['APP_INFO'];
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
                    break;
            }
        } else {
            self::failLogin('all');
        }
    }

    static public function prepareComparison() {
        $array = self::getAllSmartphone();
        new Router('show', array('viewStartCompared', $array));
    }

    static public function getLegalNotice() {
        new Router('show', array('viewLegalNotice'));
    }

    static public function getLoginView() {
        new Router('show', array('viewLogin'));
    }

    static public function getAllSmartphone() {
        $array = Queries::findAll('Smartphone')->fetchAll();
        return $array;
    }

    static public function failLogin($arg) {
        self::destroySessions();
        switch ($arg) {
            case 'failAuth':
                new Router('show', array('viewLogin', "Votre identifiant ou mot de passe est incorrect"));

                break;
            case 'all':
                new Router('show', array('viewLogin', "N'essayez pas de faire l'escro si vous n'y êtes pas autorisé :-)"));
                break;

            default:

                break;
        }
    }

    static public function getMessages() {
        if (self::isConnected()) {
            new Router('show', array('viewMessage', self::getAllMessages()));
        } else {
            self::failLogin('all');
        }
    }

    static public function getInfoApp() {
        if (self::isConnected()) {
            new Router('show', array('viewInfoApp'));
        } else {
            self::failLogin('all');
        }
    }

    static public function getNotices() {
        if (self::isConnected()) {
            new Router('show', array('viewNotice', self::getAllNotice()));
        } else {
            self::failLogin('all');
        }
    }

    static public function getAllMessages() {
        $array = Queries::findAll('HelpMessage')->fetchAll();
        return $array;
    }

    static public function getAllNotice() {
        $array = Queries::findAll('Notice')->fetchAll();
        return $array;
    }

    static public function sendMessage($name, $email, $subject, $content) {
        $date = date('d/m/Y');
        $object = new HelpMessage(array('name' => $name, 'email' => $email, 'object' => $subject, 'content' => $content, 'date' => $date));
        $result = $object->create();
        if ($result == 1) {
            echo "SEND";
        } else {
            echo "NOTSEND";
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

}
