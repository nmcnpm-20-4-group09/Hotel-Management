<?php

require "../MySQLQueryStringGenerator.php";
require "../../../DAL/v1/MySQLiConnection.php";
require "../../../DTO/v1/BillDTO.php";

use BLLv1\MySQLQueryStringGenerator;
use DALv1\MySQLiConnection;
use DTOv1\BillDTO;

$SoHoaDon = $_GET["SoHoaDon"];
$NgayThanhToan = $_GET["NgayThanhToan"];
$TriGia = $_GET["TriGia"];

$success = true;
$message = "";
$result = [];

$regex_SoHoaDon = "/^\d+$/"; // INT
$regex_TriGia = "/^([0-9]+)((\.[0-9]+)?)$/"; // DOUBLE [accept x.y or x], [not accept x. or .x]
$regex_NgayThanhToan = "/^\d\d\d\d-[0-1]\d-\d\d$/";

$isValidData = (
    preg_match($regex_SoHoaDon, $SoHoaDon) 
    and (preg_match($regex_TriGia, $TriGia) or $TriGia = "")
    and (bool)strtotime($NgayThanhToan)
    and preg_match($regex_NgayThanhToan, $NgayThanhToan)
);

if (!$isValidData) {
    $success = false;
    $message = "Invalid parameters!";
} else {
    try {
        $connection = MySQLiConnection::instance();
    } catch (Exception $e) {
        $success = false;
        $message = $e->getMessage();
    }

    if ($connection == null) {
        $success = false;
        $message = "Unable to connect to the database!";
    } else {
        $queryString = MySQLQueryStringGenerator
            ::themHoaDon( // TODO
                $SoHoaDon,
                $NgayThanhToan, 
                $TriGia
            );
        
        $dtoList = $connection->execQuery(
            $queryString,
            $isReading = true,
            BillDTO::getPrototype()
        );
    
        if ($dtoList != null) {
            foreach ($dtoList as $dto) {
                if (gettype($dto) != "string")
                {
                    $result[] = $dto->toDictionary();
                    $success = true;
                }
                else
                {
                    $success = false;
                    $message = $dto;
                }
            }
        }
        else {
            $success = false;
            $message = "There could have been some error";
        }
    }
} // if (!$isValidData)

$response = array(
    'success' => $success,
    'message' => $message,
    'result' => $result
);

echo json_encode($response);

?>