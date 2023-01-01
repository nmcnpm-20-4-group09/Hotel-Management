<?php

require "../MySQLQueryStringGenerator.php";
require "../../../DAL/v1/MySQLiConnection.php";
require "../../../DTO/v1/BookingDTO.php";

use BLLv1\MySQLQueryStringGenerator;
use DALv1\MySQLiConnection;
use DTOv1\BookingDTO;

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
    $queryString = MySQLQueryStringGenerator::danhSachPhieuThue();

    $dtoList = $connection->execQuery(
        $queryString,
        $isReading = true,
        BookingDTO::getPrototype()
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