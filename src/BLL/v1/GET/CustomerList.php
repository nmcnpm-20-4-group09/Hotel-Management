<?php

require  "../MySQLQueryStringGenerator.php";
require  "../../../DAL/v1/MySQLiConnection.php";
require  "../../../DTO/v1/CustomerDTO.php";

use BLLv1\MySQLQueryStringGenerator;
use DALv1\MySQLiConnection;
use DTOv1\CustomerDTO;

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
    $queryString = MySQLQueryStringGenerator::danhSachKhachHang();

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