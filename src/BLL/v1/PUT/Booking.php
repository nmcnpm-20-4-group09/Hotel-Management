<?php

require "../MySQLQueryStringGenerator.php";
require "../../../DAL/v1/MySQLiConnection.php";
require "../../../DTO/v1/BookingDTO.php";

use BLLv1\MySQLQueryStringGenerator;
use DALv1\MySQLiConnection;
use DTOv1\BookingDTO;

$method = $_SERVER['REQUEST_METHOD'];

$SoPhieuThue = "";
$IDKhachHang = "";
$NgayBatDauThue = "";
$SoNgayThue = "";
$MaPhong = "";

if ('PUT' === $method) {
    $_PUT = json_decode(
        file_get_contents('php://input'),
        true
    );

    $SoPhieuThue = $_PUT["SoPhieuThue"];
    $IDKhachHang = $_PUT["ID_KhachHang"];
    $NgayBatDauThue = $_PUT["NgayBatDauThue"];
    $SoNgayThue = $_PUT["SoNgayThue"];
    $MaPhong = $_PUT["MaPhong"];
}

$success = TRUE;
$message = "";
$result = [];

$regex_SoPhieuThue = "/^\d+$/"; // int
$regex_IDKhachHang = "/^([A-Za-z0-9]){1,12}$/"; // VARCHAR(12) with len in [1,12]
$regex_NgayBatDauThue = "/^\d\d\d\d-[0-1]\d-\d\d$/";
$regex_SoNgayThue = "/^\d+$/"; // int
$regex_MaPhong = "/^([A-Za-z0-9]){1,5}$/"; // VARCHAR(5) with len in [1,5]

$isValidData = (preg_match($regex_SoPhieuThue, $SoPhieuThue) 
    and preg_match($regex_IDKhachHang, $IDKhachHang)
    and preg_match($regex_NgayBatDauThue, $NgayBatDauThue)
    and (bool)strtotime($NgayBatDauThue)
    and preg_match($regex_SoNgayThue, $SoNgayThue)
    and preg_match($regex_MaPhong, $MaPhong)
);

if (!$isValidData) {
    $success = FALSE;
    $message = "Invalid parameters or http method!";
} else {
    $connection = MySQLiConnection::instance();

    if ($connection == null) {
        $success = FALSE;
        $message = "Unable to connect to the database!";
    } else {
        $queryString = MySQLQueryStringGenerator
            ::capNhatPhieuThue(
                $SoPhieuThue,
                $IDKhachHang,
                $NgayBatDauThue,
                $SoNgayThue,
                $MaPhong
            );

        $dtoList = $connection->execQuery(
            $queryString,
            $isReading = true,
            BookingDTO::getPrototype()
        );

        $result = [];
        if ($dtoList != null)
        {
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