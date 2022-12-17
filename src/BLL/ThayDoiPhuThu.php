<?php

require $_SERVER['DOCUMENT_ROOT'] . "/Hotel-Management/src/BLL/MySQLQueryStringCreator.php";
require $_SERVER['DOCUMENT_ROOT'] . "/Hotel-Management/src/DAL/MySQLiConnection.php";
require $_SERVER['DOCUMENT_ROOT'] . "/Hotel-Management/src/DTO/Surcharge.php";

use BLL\MySQLQueryStringCreator;
use DAL\MySQLiConnection;
use DTO\SurchargeDTO;

$method = $_SERVER['REQUEST_METHOD'];

$MaPhuThu = '';
$TiLeMoi = '';


if ('PUT' === $method) {
    $_PUT = json_decode(
        file_get_contents('php://input'),
        true
    );

    $MaPhuThu = $_PUT["MaPhuThu"];
    $TiLeMoi = $_PUT["TiLeMoi"];
}

$success = TRUE;
$message = "";
$result = [];

$regex_MaPhuThu = "/^([A-Za-z0-9]){1,5}$/"; // VARCHAR(5)
$regex_TiLeMoi = "/^([0-9]+)((\.[0-9]+)?)$/"; // DOUBLE

$isValidData = (preg_match($regex_MaPhuThu, $MaPhuThu) and
    preg_match($regex_TiLeMoi, $TiLeMoi)
);

if (!$isValidData) {
    $success = FALSE;
    $message = "Invalid parameters! "
        . "Valid: MaPhuThu -> VARCHAR(5), "
        . "TiLeMoi  -> DOUBLE";
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
        $queryString = MySQLQueryStringCreator
            ::doiTiLePhuThu(
                $MaPhuThu,
                $TiLeMoi
            );

        $dtoList = $connection->execQuery(
            $queryString,
            $isReading = true,
            new SurchargeDTO(null, null, null)
        );

        $result = [];
        foreach ($dtoList as $dto) {
            $result[] = $dto->toDictionary();
        }

        $countChanged = count($result);
        if ($countChanged == 0) {
            $success = false;
            $message = "Không tồn tại loại phụ thu có mã '" . $MaPhuThu . "'";
        } else {
            $success = true;
            $message = $countChanged
                . " mã phụ thụ "
                . "(" . $MaPhuThu
                . ") cập nhật thành công";
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