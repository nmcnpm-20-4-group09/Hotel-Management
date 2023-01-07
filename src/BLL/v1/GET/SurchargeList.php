<?php

require "../MySQLQueryStringGenerator.php";
require "../../../DAL/v1/MySQLiConnection.php";
require "../../../DTO/v1/SurchargeDTO.php";

use BLLv1\MySQLQueryStringGenerator;
use DALv1\MySQLiConnection;
use DTOv1\SurchargeDTO;

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
    $queryString = MySQLQueryStringGenerator::danhSachPhuThu();

    $dtoList = $connection->execQuery(
        $queryString,
        $isReading = true,
        SurchargeDTO::getPrototype()
    );

    $result = [];
    foreach ($dtoList as $dto) {
        if (gettype($dto) != "string")
        {
            $result[] = $dto->toDictionary();
            $success = true;
            $message = $dtoList;
        }
        else
        {
            $success = false;
            $message = $dto;
        }
    }
}

$response = array(
    'success' => $success,
    'message' => $message,
    'result' => $result
);

echo json_encode($response);

?>