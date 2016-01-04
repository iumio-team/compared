<?php

/** Class Controller :
 * This is the principal class which communicate with Model and Pointer
 * @since 0.03
 * @author RAFINA DANY <danyrafina@gmail.com>
 * @version 0.60
 *
 */
use LayerConnector\MDA;

class Controller
{
    private $model_instance = NULL;

    /** This is a Singleton
     * Get an instance of model
     * @return Model Instance of Model Class
     */
    private function getModel()
    {
        return ($this->modal_instance == NULL)? $this->model_instance = new MDA(): $this->model_instance;
    }

    /**
     * Method enables to login
     * @param string login Login User
     * @param string passwd Password User
     * @return void
     */
    public function login(String $pseudo, String $passwd):void
    {
        $model = $this->getModel();
        $result = $model->getOneUser($pseudo, $passwd)->fetchAll();

        if (!empty($result))
        {
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
                $this->getDashboardInfo();
            }
        }
        else
            $this->failLogin('failAuth');
        unset($model);
    }

    public function destroySessions():void
    {
        unset($_SESSION['firstName']);
        unset($_SESSION['lastName']);
        unset($_SESSION['userType']);
        unset($_SESSION['idU']);
        unset($_SESSION['pseudoU']);
        session_destroy();
    }

    public function getMasterFile():array
    {
        try {
            return Spyc::YAMLLoad('PRIVATE/AppInfo.yml');
        } catch (Exception $ex) {
            throw new LoadingError('Erreur de chargement du module YAML');
        }
    }

    public function logout():void
    {
        $this->destroySessions();
        $logoutMessage = 'Vous êtes dorénavant déconnecté';
        new Pointer('show', array('viewLogin', $logoutMessage));
    }

    public function isConnected():bool
    {
        if (isset($_SESSION['idU'])) {
            $object = new User($_SESSION['idU']);
            $object->getItem();
            return ($object->getUserLogin() == $_SESSION['pseudoU']) ? true : false;
        }
        else
            return false;
    }

    public function getDashboardInfo():void
    {
        $model = $this->getModel();
        if ( $this->isConnected()) {
            $nbS = $model->countLine('Smartphone', 'idS')->fetch()['count'];
            $nbU = $model->countLine('User', 'idU')->fetch()['count'];
            $nbC = $model->countLine('COMPARED', 'idCOMPARED')->fetch()['count'];
            $nbN = $model->countLine('Notice', 'idA')->fetch()['count'];
            $nbM = $model->countLine('HelpMessage', 'id')->fetch()['count'];
            new Pointer('show', array('viewDashboard', $nbS, $nbU, $_SESSION['userType'], $_SESSION['firstName'], $_SESSION['lastName'], $nbC, $nbN, $nbM));
        }
        else
            $this->failLogin('failAuth');
        unset($model);
    }

    /** This function prepare all items on homepage such as smartphone counter
     * @return void
     *
     */
    public function prepareHomepageItem():void
    {
        $model = $this->getModel();
        $nbS = $model->countLine('Smartphone', 'idS')->fetch()['count'];
        $nbC = $model->countLine('COMPARED', 'idCOMPARED')->fetch()['count'];
        $listAv = $model->findAll('Notice')->fetchAll();
        $recentComparison = $this->getRecentComparison();
        $nj = array ("Sunday"=>"Dimanche","Monday"=>"Lundi",
            "Tuesday"=>"Mardi","Wednesday"=>"Mercredi",
            "Thursday"=>"Jeudi", "Friday"=>"Vendredi",
            "Saturday"=>"Samedi");
        $nm = array ("janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre");
        $finalAddedSm = $model->customQuery("SELECT idS FROM Smartphone ORDER BY idS DESC LIMIT 1;")->fetch();
        $sm = new Smartphone($finalAddedSm['idS']);
        $sm->getItem();
        $best = $this->getBestSm();
        new Pointer("show", array("viewHomePage", array('nbS' => $nbS, 'nbC' => $nbC, 'noticeList' => $listAv,
            'recentC' => $recentComparison, 'lastSm' => $sm, 'best' => $best,
            "day"=>$nj[date("l")], "date_t"=>date("d")." ".$nm[date("m") - 1])));
    }

    /** This is the essential function of Application which compare all smartphone caracteristics
     * @param int s1 Smartphone name 1
     * @param int s2 Smartphone name 2
     * @return void
     * @throws \GException\RuntimeError
     */
    public function compare(int $S1, int $S2):void
    {
        if ($S1 !== NULL || $S2 !== NULL) {
            if ($this->isComparatorLink()) {
                $model = $this->getModel();
                $sm1 = new Smartphone($S1);
                $sm1->getItem();
                $sm2 = new Smartphone($S2);
                $sm2->getItem();
                $yamlFile =    $this->getMasterFile();
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
                $model->insertCompared($S1, $S2);
                unset($model);
                new Pointer('show', array('viewCompared', $sm1, $sm2, $countPSM1, $countPSM2, $winner, $processor, $screen, $gpu, $os, $dimens, $network, $ram, $storage, $photo, $video, $battery));
            }
            else
                throw new \GException\RuntimeError("Les fonctionnalités de comparaison ont été désactivées . Veuillez-contacter l'administrateur du site  ");
        }
        else
            throw new \GException\RuntimeError("Votre comparaison comporte une anomalie . \n Veuillez réessayer ", NULL, NULL);
    }

    /** Search a smartphone
     *
     * @param String $arg Word
     * @return array Result of search
     */
    public function searchEngine(String $arg):array
    {
        $array = array();
        $model = $this->getModel();
        $smartphoneList = $model->searchSmartphones($arg);
        foreach ($smartphoneList as $sm) {
            array_push($array, array('name' => $sm['constructorS'] . ' ' . $sm['fullNameS'], "id" => $sm['idS'], 'picture' => $sm['pictureS']));
        }
        unset($model);
        return $array;
    }

    /**
     * Create new score for Smartphone
     * @param int $idSm Smarphone id
     * @param float $scoreValue Score value
     */
    public function newSmScore(int $idSm, float $scoreValue):void
    {
        $smartphone = new Smartphone($idSm);
        $smartphone->getItem();
        $date = date('Y-m-d H:i:s');
        $objectScore = new SScore(0, $scoreValue, $date, $smartphone);
        $result = $objectScore->create();
        echo ($result)? '1' : '0';
    }


    /** Get smartphone list of manufacturer
     * @param $constructor Manufacturer
     */
    public function phoneList(String $constructor):void
    {
        $model = $this->getModel();
        $objectConstrucor = new Constructor($constructor);
        $objectConstrucor->getItem();
        $countSm = $model->countLine('Smartphone', 'idS', array("attr" => "constructorS", 'exp' => $constructor))->fetch();
        $array = $model->findOne('Smartphone', $constructor, 'constructorS', 'idS,pictureS,fullNameS,constructorS')->fetchAll();
        unset($model);
        new Pointer('show', array('viewPhoneList', $array, $objectConstrucor, $countSm['count']));
    }

    public function getSpec($idS):void
    {
        $icr = 0;
        $sum = 0;
        $sm = new Smartphone($idS);
        $sm->getItem();
        $model = $this->getModel();
        $scoreArray = $model->findAllById('S_SCORE', $idS, 'idS');
        while ($line = $scoreArray->fetch()) {
            $sum += $line['scoreValue'];
            $icr++;
        }
        $moy = ($icr > 0)? UtilityFunction::calculateAverage($sum, $icr) : "/";
        unset($model);
        new Pointer('show', array('viewSmSpec', $sm, $moy));
    }

    /** Get 3 recent comparison
     * @return array Result of 3 comparison
     */
    public function getRecentComparison():array
    {
        $arrayRC = array();
        $model = $this->getModel();
        $recent = $model->findRecentComparison();
        foreach ($recent as $oneComparison) {
            $sm1 = new Smartphone($oneComparison['idS1']);
            $sm1->getItem();
            $sm2 = new Smartphone($oneComparison['idS2']);
            $sm2->getItem();
            array_push($arrayRC, array('sm1' => array('id' => $sm1->getIdSm(), 'picture' => $sm1->getPictureSm(), 'fullName' => $sm1->getConstructorSm()->getName() . " " . $sm1->getFullNameSm()), 'sm2' => array('id' => $sm2->getIdSm(), 'picture' => $sm2->getPictureSm(), 'fullName' => $sm2->getConstructorSm()->getName() . " " . $sm2->getFullNameSm())));
        }
        unset($model);
        return $arrayRC;
    }

    public function isMaintenance():void
    {
        if ($this->isConnected()) {
            $yamlFile = $this->getMasterFile();
            $isM = $yamlFile['MAINTENANCE'];
            echo ($isM['MAINTENANCE_MODE'] == "DISABLED")? 0 : 1;
        }
        else
            $this->failLogin("all");
    }

    /**
     * @param int $pass
     */
    public function authForMaintenance(int $pass):void
    {
        if ($this->isConnected()) {
            $result = $this->PIN($pass);
            if ($result === 1) {
                $this->switchMaintenance("ON", "COMPARED est en maintenance");
                $this->destroySessions();
                echo "1";
            }
            else
                echo '0';
        } else
            $this->failLogin("all");
    }

    /** Authentification with PIN code
     *
     * @param int $pass The PIN CODE
     * @return int the result of authentification , 1 for good code and 0 for fail
     */
    public function PIN(int $pass):int
    {
        if ($this->isConnected()) {
            $model = $this->getModel();
            $result = $model->findOneById('PIN', $_SESSION['idU'], 'idU', 'PIN')->fetch();
            $pin = $result['PIN'];
            unset($model);
            return ($pin === $pass)? 1 : 0;
        }
        else
            $this->failLogin("all");
        return (0);
    }

    /**
     * Get the best smartphone
     *
     * @return array best smartphone
     */
    public function getBestSm() : array
    {
        $idS = NULL;
        $scoreV = 0;
        $model = $this->getModel();
        $a = $model->customQuery("select avg(scoreValue) as mark, idS from S_SCORE group by idS;");
        while ($line = $a->fetch()) {
            if ($line['mark'] > $scoreV) {
                $scoreV = $line['mark'];
                $idS = $line['idS'];
            }
        }
        $s = new Smartphone($idS);
        $s->getItem();
        unset($model);
        return (array("sm" => $s, "score" => $scoreV));
    }

    public function switchMaintenance(String $mode,String $sentence):void
    {
        if ( $this->isConnected()) {
            $yamlFile = $this->getMasterFile();
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
                        fclose($a);
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
                        fclose($a);
                    }
                    break;
                default:
                    throw new \GException\RuntimeError("Imposible de mettre COMPARED en maintenance", NULL, NULL);
                    break;
            }
        }
        else
            $this->failLogin('all');
    }

    public function prepareComparison():void
    {
        if ( $this->isComparatorLink()) {
            $icr = 0;
            $array =    $this->getAllSmartphone();
            $model = $this->getModel();
            $scoreP = $a = $model->customQuery("select avg(scoreValue) as mark, idS from S_SCORE group by idS;");
            while ($line = $scoreP->fetch()) {
                if ($array[$icr]['idS'] == $line['idS'])
                    array_push($array[$icr], $line['mark']);
                $icr++;
            }
            unset($model);
            new Pointer('show', array('viewStartCompared', $array));
        }
        else
            throw new \GException\RuntimeError("Les fonctionnalités de comparaison ont été désactivées . Veuillez-contacter l'administrateur du site  ");
    }

    public function getLegalNotice():void
    {
        new Pointer('show', array('viewLegalNotice'));
    }

    public function getLoginView():void
    {
        new Pointer('show', array('viewLogin', NULL));
    }

    public function getAllSmartphone()
    {
        $model = $this->getModel();
        $array = $model->findAll('Smartphone')->fetchAll();
        unset($model);
        return $array;
    }

    public function failLogin(String $arg):void
    {
        $this->destroySessions();
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

    public function getMessages():void
    {
        ($this->isConnected())? new Pointer('show', array('viewMessage',    $this->getAllMessages())) : $this->failLogin('all');
    }

    public function getInfoApp():void
    {
        ($this->isConnected())? new Pointer('show', array('viewInfoApp')) : $this->failLogin('all');
    }

    public function getNotices():void
    {
        ($this->isConnected())? new Pointer('show', array('viewNotice', $this->getAllNotice())) : $this->failLogin('all');
    }

    public function getAllMessages():array
    {
        $model = $this->getModel();
        $array = $model->findAll('HelpMessage')->fetchAll();
        unset($model);
        return $array;
    }

    public function getAllNotice():array
    {
        $model = $this->getModel();
        $array = $model->findAll('Notice')->fetchAll();
        unset($model);
        return $array;
    }

    public function sendMessage(String $name, String $email, String $subject, String $content):void
    {
        $object = new HelpMessage(array('name' => $name, 'email' => $email, 'subject' => $subject, 'content' => $content, 'date' => date('d/m/Y')));
        $result = $object->create();
        echo ($result == 1)? "SEND" : "NOTSEND";
    }

    public  function isComparatorLink():bool
    {
        $yamlFile = $this->getMasterFile();
        $info = $yamlFile['ENGINE_COMPARATOR']['LINK'];
        return ($info === "NOTATTACHED")? false : true ;
    }

    public function deleteMessage(int $id):void
    {
        $object = new HelpMessage($id);
        $object->getItem();
        if (!empty($object->getContent())) {
            try {
                $object->delete();
                echo 1;
            } catch (Exception $exc) {
                echo 0;
            }
        }
        else
            echo 0;
    }

    public function getInfoComparator():void
    {
        if ($this->isConnected()) {
            $yamlFile =    $this->getMasterFile();
            $info = $yamlFile['ENGINE_COMPARATOR'];
            new Pointer('show', array('viewInfoComparator', $info['ENGINE_COMPARATOR_NAME'], $info['ENGINE_COMPARATOR_VERSION'], $info['ENGINE_COMPARATOR_SLOGAN'], $info['LINK_TO_ENGINE_COMPARATOR'], $info['Token'], UtilityFunction::translateEnToFr($info['LINK']), $info['LINK']));
        }
        else
            $this->failLogin('all');
    }

    public function getInfoComparatorToModify(String $optionalMessage = NULL):void
    {
        if ( $this->isConnected()) {
            $yamlFile = $this->getMasterFile();
            $info = $yamlFile['ENGINE_COMPARATOR'];
            new Pointer('show', array('viewModInfoComparator', $info['ENGINE_COMPARATOR_NAME'], $info['ENGINE_COMPARATOR_VERSION'], $info['ENGINE_COMPARATOR_SLOGAN'], $info['LINK_TO_ENGINE_COMPARATOR'], $info['Token'], $info['LINK'], $optionalMessage));
        }
        else
            $this->failLogin('all');
    }

    public function switchStatusComparator(int $pass, String $mod):void
    {
        if ($this->PIN($pass) == 1) {
            $yamlFile = $this->getMasterFile();
            switch ($mod) {
                case 'OFF':
                    $yamlFile['ENGINE_COMPARATOR']['LINK'] = "NOTATTACHED";
                    $z = Spyc::YAMLDump($yamlFile);
                    $a = fopen('PRIVATE/AppInfo.yml', 'w');
                    fwrite($a, $z);
                    fclose($a);
                    echo "1";
                    break;
                case 'ON':
                    $yamlFile['ENGINE_COMPARATOR']['LINK'] = "ATTACHED";
                    $z = Spyc::YAMLDump($yamlFile);
                    $a = fopen('PRIVATE/AppInfo.yml', 'w');
                    fwrite($a, $z);
                    fclose($a);
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
        }
        else
            echo '0';
    }

    public function modifyInfoComparator(String $name, String $version, String $slogan, String $href, String $token, String $status):void
    {
        if ($this->isConnected()) {
            if ($name == '' || $token == '' || $href == '')
                $this->getInfoComparatorToModify("Un ou plusieurs champs sont vides , merci de rééssayer !");
            else {
                if (strpos($href, 'http://') != 0)
                    $href = "http://" . $href;
                $file =    $this->getMasterFile();
                $file['ENGINE_COMPARATOR']['ENGINE_COMPARATOR_NAME'] = $name;
                $file['ENGINE_COMPARATOR']['ENGINE_COMPARATOR_VERSION'] = $version;
                $file['ENGINE_COMPARATOR']['ENGINE_COMPARATOR_SLOGAN'] = $slogan;
                $file['ENGINE_COMPARATOR']['LINK_TO_ENGINE_COMPARATOR'] = $href;
                $file['ENGINE_COMPARATOR']['Token'] = $token;
                $z = Spyc::YAMLDump($file);
                $a = fopen('PRIVATE/AppInfo.yml', 'w');
                fwrite($a, $z);
                $this->getInfoComparatorToModify("Modification réussie");
            }
        }
        else
            $this->failLogin('all');
    }
}
