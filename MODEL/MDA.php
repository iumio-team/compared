<?php

/**
 * Welcome on COMPARED Model Database Access FILE
 * This file content all quieres required to run COMPARED application
 * This file was created on the 10th of October in 2014
 * @since 0.03
 * @version 0.60
 * @author RAFINA DANY <danyrafina@gmail.com>
 * @PHPVersion 7.00 RC5
 */

namespace Compared\LayerConnector;

use PDOStatement;
use DateTime;

class MDA {
    
    /**
     * Create a custom query 
     * @param strijng $sql  The query toe execute
     * @param array $sqlArgs Argument to execute query
     * @return PDOStatement The query result
     */
    public function customQuery(string $sqlQuery, array $sqlArgs = NULL): PDOStatement {
        $query = $sqlQuery;
        $prepare = Connector::prepare($query,$sqlArgs);
        return $prepare;
    }
    
    /**
     * Search smartphone with specific argument
     * @param String $arg Argument to search smartphone
     * @return PDOStatement The query result
     */
     public function searchSmartphones(string $arg):PDOStatement{
        $query = "SELECT * FROM Smartphone WHERE constructorS like %?% OR fullNameS like %?% OR codeNameS like %?% ;";
        $prepare = Connector::prepare($query, array($arg,$arg,$arg));
        return $prepare;
    }

    /** Check if exists administrator in database
     * @return boolean True is if exists administrator
     */
     public function checkAdministrator(){
        $query = "SELECT * FROM User inner join UserType on User.idUT = UserType.idUT WHERE UserType = 'Administrator' ;";
        $prepare = Connector::prepare($query, array());
        if (empty($prepare))
            return false;
        else
            return true;
    }
    

    /** Get one user 
     * @param string $pseudo 
     * @param string $passwd User password
     * @return PDOStatement Query result
     */
     public function getOneUser(string $pseudo, string $passwd):PDOStatement {
        $query = "SELECT * FROM User inner join UserType on User.idUT = UserType.idUT WHERE pseudoU= ? AND passwordU = ?;";
        $prepare = Connector::prepare($query, array($pseudo, $passwd));
        return $prepare;
    }


    /** Count number of line in specific table
     * 
     * @param string $table
     * @param string $idName
     * @return PDOStatement Query result
     */
     public function countLine(string $table, string $idName, array $argument = NULL) {
        if($argument == NULL){
            $query = "SELECT count($idName) as count from $table;";
            $prepare = Connector::prepare($query, NULL);
        }
        else {
            $query = "SELECT count($idName) as count from $table WHERE ". $argument['attr'] ."= ? ;";
            $prepare = Connector::prepare($query, array($argument['exp']));
            
        }

        return $prepare;
    }
    
    /**
     * 
     */

    /** Récupérér tous les éléments d'une table
     * @param string $table Le nom de la table
     * @return PDOStatement $prepare Résultat de la requête
     */
     public function findAll(string $table):PDOStatement {
        $query = "SELECT * FROM $table";
        $prepare = Connector::prepare($query, array());
        return $prepare;
    }

    /** Récupérér tous les éléments d'une table par l'id de celle-ci
     * @param string $table Le nom de la table
     * @param Object $id Identifiant de la table
     * @param strig $idName Nom de l'identifiant de la table
     * @param string $argument Le ou les données à récupérer
     * 
     * @return PDOStatement Résultat de la requête
     */
     public function findOneById(string $table, string $id, string $idName, string $argument) {
        $query = "SELECT $argument FROM $table WHERE $idName = ?";
        $prepare = Connector::prepare($query, array($id));
        return $prepare;
    }

    /** Récupérér une donnée d'une table avec condition
     * @param string|string $table Le nom de la table
     * @param string|string $conditionValue Valeur de la condition
     * @param string|string $conditionName Nom de la condition
     * @param strig $argument Nom de la ou les données à récupérer
     * @return PDOStatement resultat de la requête
     */
     public function findOne(string $table, string $conditionValue, string $conditionName, string $argument):PDOStatement {
        $query = "SELECT $argument FROM $table WHERE $conditionName = ?";
        $prepare = Connector::prepare($query, array($conditionValue));
        return $prepare;
    }

    /** Récupérer les comparaisons récentes
     * @return Array Les comparaisons récentes
     */
     public function findRecentComparison() {
        //$count = self::countLine('COMPARED', 'idCOMPARED')->fetch()['count'];
        //$count -= 2;
        $query2 = "SELECT * from COMPARED order by idCOMPARED desc limit 0, 3 ;";
        $prepare2 = Connector::prepare($query2, array());
        return $prepare2;
    }

    /** Récupérér tous les éléments d'une table par l'id de celle-ci
     * @param string $table Le nom de la table
     * @param Object $id Identifiant de la table
     * @param strig $idName Nom de l'identifiant de la table
     * 
     * @return type resultat de la requête
     */
     public function findAllById($table, $id, $idName) {
        $query = "SELECT * FROM $table WHERE $idName = ?";
        $prepare = Connector::prepare($query, array($id));
        return $prepare;
    }

    /** Supprime tous les éléments d'une table par l'id de celle-ci
     * @param string $table Le nom de la table
     * @param Object $id Identifiant de la table
     * @param strig $idName Nom de l'identifiant de la table
     * 
     * @return type Résultat de la requête
     */
     public function deleteAllById($table, $id, $idName) {
        $query = "DELETE FROM $table WHERE $idName = ?";
        $prepare = Connector::prepare($query, array($id));
        return $prepare;
    }

    /** Requête de connexion d'un utilisateur
     * 
     * @param string $idP Identifiant personnel de l'utilisateur
     * @param string $passwd Mot de passe personnel de l'utilisateur
     * @return PDOStatement Résultat de la requête
     */
     public function makeConnection($idP) {
        $result = NULL;
        $query = "SELECT idU,idPersoU,passwordU FROM User WHERE idPersoU= ? ;";
        $prepare = Connector::prepare($query, array($idP));

        if ($prepare != NULL) {

            $result = $prepare;
        }
        return $result;
    }

    /** Obtenir le type de l'utilisateur
     * 
     * @param int $id Identifiant de l'utilisateur
     * @return PDOStatement Résultat de la requête
     */
     public function getTypeUser($id) {
        $query = "select namingUT from User inner join UserType on User.idUT = UserType.idUT where idU = ? ;";
        $exeQuery = Connector::prepare($query, array($id));
        return $exeQuery;
    }

    /** Obtenir l'identifiant du type d'utilisateur
     * 
     * @param string $userType Type de l'utilisateur
     * @return PDOStatement Résultat de la requête
     */
     public function getIdByName($userType) {
        $query = "select idUT from UserType where namingUT = ? ;";
        $exeQuery = Connector::prepare($query, array($userType));
        return $exeQuery;
    }

    /** Obtenir la liste des clients et prestataires
     * 
     * @param int $id Identifiant de l'administrateur
     * @return PDOStatement Résultat de la requête
     */
     public function getUserList($id) {
        $query = "select * from User inner join UserType on User.idUT = UserType.idUT where idU != ? and namingUT='Administrator' ;";
        $exeQuery = Connector::prepare($query, array($id));
        return $exeQuery;
    }

    /** Update all user informations
     * 
     * @param int $id ID
     * @param string $pseudo Personal identifier
     * @param string $fistName Prénom
     * @param string $lastName Nom e famille
     * @param string $password Password
     * @param string $email E-mail
     * @param string $picture Picture
     * @param int $idUT Identifying the type of user
     * @return PDOStatement Query result
     */
     public function updateUser($id, $pseudo, $firstName, $lastName, $password, $email, $picture, $idUT) {
        $query = "UPDATE User SET idUT = ? ,pseudoU= ? ,lastNameU= ?, firstNameU= ?, passwordU= ? , emailU= ?, pictureU WHERE idU = ?;";
        $exeQuery = Connector::prepare($query, array($idUT, $pseudo, $lastName, $firstName, $password, $email, $picture, $id));
        return $exeQuery;
    }

    /** Update a help message
     * @param int $id Id of help message
     * @param String $name name of person
     * @param String $email email of person
     * @param String $subject subject message
     * @param String $content content message
     * @param Date $date Date of message
     * @return PDOStatement Query result
     */
     public function updateHelpMessage($id, $name, $email, $subject, $content,$date) {
        $query = "update HelpMessage name= ?, email=?,subject=?,content=?,date=?  where id = ?;";
        $prepare = Connector::prepare($query, array($name, $email, $subject, $content,$date, $id));
        return $prepare;
    }

    /** Update a comparison
     * 
     * @param int $idCompared Identifiant 
     * @param int $idS1 Smartphone 1
     * @param int $idS2 Smartphone 2
     * @return PDOStatement Query result
     */
     public function updateCompared($idCompared, $idS1, $idS2) {
        $query = "UPDATE COMPARED SET idS1 = ? , idS2 = ? WHERE idCOMPARED = ?;";
        $exeQuery = Connector::prepare($query, array($idS1, $idS2, $idCompared));
        return $exeQuery;
    }

    /** Update an operating system
     * @param int $id Id
     * @param string $name Name of person
     * @param string $version Version
     * @param string $constructor Constructor
     * @param string $releaseDate Release Date
     * @return PDOStatement Result query

     */
     public function updateOS($id, $name, $version, $constructor, $releaseDate) {
        $query = "UPDATE COMPARED SET idS1 = ? , idS2 = ? WHERE idCOMPARED = ?;";
        $exeQuery = Connector::prepare($query, array($name, $version, $constructor, $releaseDate, $id));
        return $exeQuery;
    }

    /** update a suggestion
     * 
     * @param int $idA Identifiant 
     * @param string $name Name of person
     * @param string $content Content suggestion
     * @return PDOStatement Result query
     */
     public function updateAvis($idA, $name, $content) {
        $query = "UPDATE Avis SET nameInter = ? , content = ?  WHERE idA = ?;";
        $exeQuery = Connector::prepare($query, array($name, $content, $idA));
        return $exeQuery;
    }

    /** Obtenir l'ensemble des type d'utilisateurs excepté de celui de l'utilisateur actuel 
     * 
     * @param string $userType Type de l'utilisateur
     * @return PDOStatement Résultat de la requête
     */
     public function getUserType($userType) {
        $query = "select namingUT from UserType where namingUT != ?;";
        $exeQuery = Connector::prepare($query, array($userType));
        return $exeQuery;
    }

    /** Obtenir les utilisateurs excepté celui passé en paramètre
     * 
     * @param int $idU Identifiant de l'utilisateur
     * @return PDOStatement Résultat de la requête
     */
     public function getUserAndUserType($idU) {
        $query = "SELECT * from User inner join UserType on User.idUT = UserType.idUT where idU != ?";
        $exeQuery = Connector::prepare($query, array($idU));
        return $exeQuery;
    }

    /** insert a new Processor
     * @param $idP CPU ID
     * @param $namingP name
     * @param $construc constructor name
     * @param $nbOfCoreP number of core
     * @param $frequencyP frequency
     * @param $archP architecture
     * @param $versionP version
     * @return PDOStatement Query result
     */
     public function insertProcessor($idP, $namingP, $construc, $nbOfCoreP, $frequencyP, $archP, $versionP) {
        $query = "insert into Processor (idProc,nameProc,constructorProc,nbCoreProc,archProc,versionProc,frequencyProc) values ('',?,?,?,?,?,?);";
        $prepare = Connector::prepare($query, array($namingP, $construc, $nbOfCoreP, $frequencyP, $archP, $versionP));
        return $prepare;
    }

    /**
     * Insert a new Score
     * @param $scoreValue The Score value
     * @param $creationDateTime Date and Time of  score creation
     * @param $foreignKey An Array which contains the foreign key  id label  and his value
     */
     public function insertScore(float $scoreValue,  String $creationDateTime,  Array $foreignKey):PDOStatement {
        $table = NULL;
        switch ($foreignKey[0]){
            case "idS":
                $table = "S_SCORE";
                break;
            case "idC":
                $table = "C_SCORE";
                break;
            case "idP":
                $table = "P_SCORE";
                break;
            default :
                throw new Exception("Mauvais paramètre !", "303", NULL);
                
        }
      
        $query = "insert into $table value ('',?,?,?) ";
        $a = fopen("azr.txt", "a+");
        fwrite($a, $query."\n");
        $prepare = Connector::prepare($query, array($scoreValue, $creationDateTime, $foreignKey[1]));
        return $prepare;

    }
    /** Insert a new comparison in database
     * 
     * @param int $idS1 first smartphone id
     * @param int $idS2 second smartphone id
     * @return PDOStatement Query result
     */
     public function insertCompared($idS1, $idS2) {
        $query = "insert into COMPARED (idCOMPARED,idS1,idS2) values ('',?,?);";
        $prepare = Connector::prepare($query, array($idS1, $idS2));
        return $prepare;
    }

    /** Insert a new help message
     * 
     * @param String $name name of person
     * @param String $email email of person
     * @param String $subject subject message
     * @param String $content content message
     * @param Date $date Date of message 
     * @return PDOStatement Query result
     */
     public function insertHelpMessage($name, $email, $subject, $content,$date) {
        $query = "insert into HelpMessage (id,name,email,subject,content,date) values ('',?,?,?,?,?);";
        $prepare = Connector::prepare($query, array($name, $email, $subject, $content,$date));
        return $prepare;
    }

    /** Insert a new Operating System 
     * 
     * @param string $name Os name
     * @param string $version Os version
     *  @param string $constructor Os builder
     * @param date $releaseDate release date of OS
     * @return PDOStatement Query result
     */
     public function insertOS($name, $version, $constructor, $releaseDate) {
        $query = "insert into OS (idOS,nameOS,versionOS,constructorOS,releaseDateOS) values ('',?,?,?,?);";
        $prepare = Connector::prepare($query, array($name, $version, $constructor, $releaseDate));
        return $prepare;
    }

    /** Insert a new notice
     * 
     * @param string $name name of person
     * @param string $content content
     * @return PDOStatement Query result
     */
     public function insertNotice($name, $content) {
        $query = "insert into Notice (idA,nameInter,content) values ('',?,?);";
        $prepare = Connector::prepare($query, array($name, $content));
        return $prepare;
    }

    /** Insert a new user
     * @param $userLogin Login
     * @param $userPassword Password
     * @param $userFirstName First name
     * @param $userLastname Last name
     * @param $userEmail E-mail
     * @param $userPicture Picture
     * @param $userFunction Function
     * @return PDOStatement Query result
     */
     public function insertUser($userLogin, $userPassword, $userFirstName, $userLastname, $userEmail, $userPicture, $userFunction) {
        $query = "insert into User values ('',?,?,?,?,?,?,?);";
        $prepare = Connector::prepare($query, array($userLogin, $userPassword, $userFirstName, $userLastname, $userEmail, $userPicture, $userFunction));
        return $prepare;
    }

}
