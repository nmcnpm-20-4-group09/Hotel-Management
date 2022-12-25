<?php

require $_SERVER['DOCUMENT_ROOT'] . "/Hotel-Management/src/BLL/v1/MySQLQueryStringGenerator.php";
require $_SERVER['DOCUMENT_ROOT'] . "/Hotel-Management/src/DAL/v1/MySQLiConnection.php";
require $_SERVER['DOCUMENT_ROOT'] . "/Hotel-Management/src/DTO/v1/BillDetailDTO.php";

use BLLv1\MySQLQueryStringGenerator;
use DALv1\MySQLiConnection;
use DTOv1\BillDetailDTO;

$soPhieuThue = $_GET["SoPhieuThue"];
$soHoaDon = $_GET["SoHoaDon"];

$success = true;
$message = "";
$result = [];

$pattern = "/^[0-9]+$/"; // INT

$isValidData = (preg_match($pattern, $soPhieuThue) and
    preg_match($pattern, $soHoaDon)
);

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
            ::chiTietHoaDon(
                $soPhieuThue,
                $soHoaDon
            );

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