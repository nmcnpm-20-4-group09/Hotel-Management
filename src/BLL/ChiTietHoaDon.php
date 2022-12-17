<?php

require $_SERVER['DOCUMENT_ROOT'] . "/Hotel-Management/src/BLL/MySQLQueryStringCreator.php";
require $_SERVER['DOCUMENT_ROOT'] . "/Hotel-Management/src/DAL/MySQLiConnection.php";
require $_SERVER['DOCUMENT_ROOT'] . "/Hotel-Management/src/DTO/BillDetail.php";

use BLL\MySQLQueryStringCreator;
use DAL\MySQLiConnection;
use DTO\BillDetailDTO;

$soPhieuThue = $_GET["SoPhieuThue"];
$soHoaDon = $_GET["SoHoaDon"];

$success = true;
$message = "";
$result = [];

$pattern = "/^[0-9]*$/";

$isValidData = (preg_match($pattern, $soPhieuThue) and
    preg_match($pattern, $soHoaDon)
);

if (!$isValidData) {
    $success = FALSE;
    $message = "Invalid parameters!";
} else {
    $queryString = MySQLQueryStringCreator::chiTietHoaDon($soPhieuThue, $soHoaDon);
    try {
        $connection = MySQLiConnection::instance();
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    if ($connection == null) {
        $success = FALSE;
        $message = "Unable to connect to the database!";
    } else {
        $queryString = MySQLQueryStringCreator
            ::chiTietHoaDon(
                $soPhieuThue,
                $soHoaDon
            );

        $dtoList = $connection->execQuery(
            $queryString,
            $isReading = true,
            new BillDetailDTO(null, null, null, null, null)
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