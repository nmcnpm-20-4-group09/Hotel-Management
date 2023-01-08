<?php

require "../MySQLQueryStringGenerator.php";
require "../../../DAL/v1/MySQLiConnection.php";
require "../../../DTO/v1/BillDetailDTO.php";

use BLLv1\MySQLQueryStringGenerator;
use DALv1\MySQLiConnection;
use DTOv1\BillDetailDTO;

//$soPhieuThue = $_GET["SoPhieuThue"];
$soHoaDon = $_GET["SoHoaDon"];

$success = true;
$message = "";
$result = [];

$pattern = "/^[0-9]+$/"; // INT

$isValidData = preg_match($pattern, $soHoaDon);

if (!$isValidData) {
    $success = FALSE;
    $message = "Invalid parameters!";
} else {
    try {
        $connection = MySQLiConnection::instance();
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    if ($connection == null) {
        $success = FALSE;
        $message = "Unable to connect to the database!";
    } else {
        $queryString = MySQLQueryStringGenerator
            ::chiTietHoaDon($soHoaDon);

        $dtoList = $connection->execQuery(
            $queryString,
            $isReading = true,
            BillDetailDTO::getPrototype()
        );

        $result = [];
        foreach ($dtoList as $dto) {
            $result[] = $dto->toDictionary();
        }

        $success = true;
    }
} // if (!$isValidData)

$response = array(
    'success' => $success,
    'message' => $message,
    'result' => $result
);

echo json_encode($response);

?>