<?php

require $_SERVER['DOCUMENT_ROOT'] . "/Hotel-Management/src/BLL/MySQLQueryStringCreator.php";
require $_SERVER['DOCUMENT_ROOT'] . "/Hotel-Management/src/DAL/MySQLiConnection.php";
require $_SERVER['DOCUMENT_ROOT'] . "/Hotel-Management/src/DTO/CustomerDTO.php";

use BLL\MySQLQueryStringCreator;
use DAL\MySQLiConnection;
use DTO\CustomerDTO;

$success = true;
$message = "";
$result = [];

try {
    $connection = MySQLiConnection::instance();
} catch (Exception $e) {
    echo $e->getMessage();
}

if ($connection == null) {
    $success = false;
    $message = "Unable to connect to the database!";
} else {
    $queryString = MySQLQueryStringCreator::danhSachKhachHang();

    $dtoList = $connection->execQuery(
        $queryString,
        $isReading = true,
        CustomerDTO::getPrototype()
    );

    $result = [];
    foreach ($dtoList as $dto) {
        $result[] = $dto->toDictionary();
    }

    $success = true;
}

$response = array(
    'success' => $success,
    'message' => $message,
    'result' => $result
);

echo json_encode($response);

?>