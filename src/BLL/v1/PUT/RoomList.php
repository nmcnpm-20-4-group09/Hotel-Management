<?php

require "../MySQLQueryStringGenerator.php";
require "../../../DAL/v1/MySQLiConnection.php";
require "../../../DTO/v1/RoomDTO.php";

use BLLv1\MySQLQueryStringGenerator;
use DALv1\MySQLiConnection;
use DTOv1\RoomDTO;

$MaPhong = $_GET["MaPhong"];
$MaPhongMoi = $_GET["MaPhongMoi"];
$MaLoai = $_GET["MaLoai"];
$TinhTrang = $_GET["TinhTrang"];

$success = true;
$message = "";
$result = [];

$pattern = "/^[0-9]+$/"; // INT
$isValidData = isset($MaPhong) and isset($MaPhongMoi) and isset($MaLoai) and
    isset($TinhTrang) and preg_match($pattern, $TinhTrang);

if (!$isValidData) {
    $success = false;
    $message = "Invalid parameters!";
} else {
    try {
        $connection = MySQLiConnection::instance();
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    if ($connection == null) {
        $success = false;
        $message = "Unable to connect to the database!";
    } else {
        $queryString = MySQLQueryStringGenerator
            ::chinhSuaPhong(
                $MaPhong,
                $MaPhongMoi,
                $MaLoai,
                $TinhTrang
            );

        $dtoList = $connection->execQuery(
            $queryString,
            $isReading = false,
            RoomDTO::getPrototype()
        );

        $result = $dtoList;
        if (count($result) == 0) {
            $success = true;
            $message = "Chỉnh sửa phòng $MaPhong thành công!";
        } else {
            $success = false;
            $message = "Không thể chỉnh sửa phòng $MaPhong, lỗi: " .  $result[0];
        }
    }
} // if (!$isValidData)

$response = array(
    'success' => $success,
    'message' => $message,
    'result' => $result
);

echo json_encode($response);
