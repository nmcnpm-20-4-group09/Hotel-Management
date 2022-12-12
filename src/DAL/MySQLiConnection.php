<?php

namespace DAL;

use Exception;
use mysqli;

class MySQLiConnection implements DBConnectionInterface
{
    private $servername;
    private $user;
    private $password;
    private $database;

    // Singleton
    private static $connection = null;

    private function __construct(
        $servername = 'localhost',
        $user = 'root',
        $password = '',
        $database = 'HotelManagement'
    ) {
        $this->servername = $servername;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;

        $this->connection = new mysqli(
            $servername,
            $user,
            $password,
            $database
        );
    }

    private function __clone()
    {
        // Do nothing
    }

    public static function instance()
    {
        if (self::$connection == null) {
            try {
                self::$connection = new mysqli(
                    self::$servername,
                    self::$user,
                    self::$password,
                    self::$database
                );

                if (self::$connection->connect_error) {
                    self::$connection = null;
                }
            } catch (Exception $e) {
                self::$connection = null;
            }
        }

        return self::$connection;
    }

    public function execQuery($queryString)
    {
        $queryResult = [];

        if ($this->connection == null) {
            $queryResult = null;
        } else {
            $this->connection->query($queryString);
        }

        return $queryResult;
    }
}

?>