<?php

require $_SERVER['DOCUMENT_ROOT'] . "/Hotel-Management/src/BLL/v2/MySQLQueryStringGenerator.php";
require $_SERVER['DOCUMENT_ROOT'] . "/Hotel-Management/src/DAL/v1/MySQLiConnection.php";
require $_SERVER['DOCUMENT_ROOT'] . "/Hotel-Management/src/DTO/v2/RoomDTO.php";

use BLLv2\MySQLQueryStringGenerator;
use DALv1\MySQLiConnection;
use DTOv2\RoomDTO;

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
    $queryString = MySQLQueryStringGenerator::danhSachPhong();

    $dtoList = $connection->execQuery(
        $queryString,
        $isReading = true,
        RoomDTO::getPrototype()
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