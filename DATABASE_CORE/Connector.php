<?php

/** Access to database
 * @access PRIVATE
 * @author RAFINA DANY <danyrafina@gmail.com>
 * @since 0.01
 * @version 0.09
 */


namespace Compared\LayerConnector;

use Compared\Tools\UtilityFunction;
use PDO;
use PDOException;
use GException\PDORNException;
use Spyc;

class Connector {

    static private $DSN ;
    static private $USERNAME ;
    static private $USERPASSWORD ;
    static private $instance = null;
    static private $errorMessage = null;

    /** Create a connection
     *
     * @throws PDORNException Error of creation
     */
    private function __construct() {

        try {
            $info = UtilityFunction::getMasterFile();
            self::$DSN = "mysql:host=".$info['COMPARED_DATABASE']['DB_HOST'].';dbname='.$info['COMPARED_DATABASE']['DB_NAME'];
            self::$USERNAME = $info['COMPARED_DATABASE']['DB_USER'];
            self::$USERPASSWORD = $info['COMPARED_DATABASE']['DB_PASS'];
            self::$instance = new PDO(self::$DSN, self::$USERNAME, self::$USERPASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
        } catch (PDOException $event) {

            throw new PDORNException($event->getMessage());
        }
    }



    /** Get connection
     *
     * @return The connection
     * @throws PDORNException Error of connection or query execution
     */
    static public function getInstance():PDO
    {

        try {
            if (self::$instance == NULL)
                new Connector();
        } catch (PDOException $exc) {
            throw new PDORNException($exc->getMessage());
        }
        return self::$instance;
    }


    /** Execute a prepare query
     *
     * @param string $query Query to execute
     * @param array $array Query options
     * @return PDOStatement Query result
     */
    static public function prepare(String $query, array $array = NULL):\PDOStatement
    {
        if (self::$errorMessage == NULL)
        {
            $prepare = self::getInstance()->prepare($query);
            if (empty($array) || $array == NULL)
                $prepare->execute();
            else
                $prepare->execute($array);
        }
        return $prepare;
    }

    /** To get an error
     *
     * @return string The erros
     */
    static public function getErrorMessage():string
    {

        return self::$errorMessage;
    }

    /** Drop connection
     *
     * @return boolean True if the connection is removinf
     * @throws PDORNException Error of drop
     */
    static public function destroyConnection() :bool
    {
        try {
            if (self::$instance != null)
                self::$instance = NULL;
            return true;
        } catch (PDORNException $event) {
            throw new PDORNException($event->getMessage());
            return false;
        }
    }

}
