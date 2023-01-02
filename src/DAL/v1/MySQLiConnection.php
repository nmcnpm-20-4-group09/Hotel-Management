<?php

namespace DALv1;

require __DIR__ . "/DBConnectionInterface.php";

use Exception;
use mysqli;

class MySQLiConnection implements DBConnectionInterface
{
    private $servername;
    private $user;
    private $password;
    private $database;
    private $connection;

    // Singleton
    private static $instance = null;

    private function __construct(
        $servername = 'localhost',
        $user = 'root',
        $password = '',
        $database = 'hotel_management'
    ) {
        $this->servername = $servername;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;

        $this->connection = new mysqli(
            $this->servername,
            $this->user,
            $this->password,
            $this->database
        );
    }

    public function __destruct()
    {
        if (self::$instance != null) {
            try {
                self::$instance->connection->close();
            } catch (Exception $e) {
                // Do nothing
            }
        }
    }

    private function __clone()
    {
        // Do nothing
    }

    public static function instance()
    {
        if (self::$instance == null) {
            try {
                self::$instance = new MySQLiConnection();

                if (self::$instance->connection->connect_error) {
                    self::$instance = null;
                }
            } catch (Exception $e) {
                self::$instance = null;
            }
        }

        return self::$instance;
    }

    public function execQuery(
        $queryString,
        $isReading = false,
        $dto = null
    ) {
        $queryResult = [];

        if ($this->connection == null) {
            $queryResult = null;
        } else {
            try {
                $data = $this->connection->query($queryString);

                if ($data == false) {
                    $queryResult = null;
                } else if ($isReading) {
                    while ($row = $data->fetch_assoc()) {
                        $dbColumnMapper = $dto->getDBColumnMapper();

                        foreach ($dbColumnMapper as $key => $value) {
                            $dbColumnMapper[$key] = $row[$key];
                        }

                        $rowToObject = $dto->getNewInstance($dbColumnMapper);
                        $queryResult[] = $rowToObject;
                    }

                    mysqli_free_result($data);
                }
            } catch (Exception $e) {
                //! Nếu có lỗi thì cho vào mảng kết quả
                $queryResult[] = $e->getMessage();
            }
        }

        return $queryResult;
    }
}
