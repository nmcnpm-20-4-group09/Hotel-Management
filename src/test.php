<?php

require "/Applications/XAMPP/xamppfiles/htdocs/Hotel-Management/src/DAL/MySQLiConnection.php";
// require $_SERVER['DOCUMENT_ROOT'] . "/Hotel-Management/src/DAL/MySQLiConnection.php";

use DAL\MySQLiConnection;

try {
    $connection = MySQLiConnection::instance();
} catch (Exception $e) {
    echo $e->getMessage();
}

if ($connection == null) {
    $success = FALSE;
    $message = "Unable to connect to the database!";
    echo $message;
} else {
    $queryString = ("UPDATE `phong` SET `GhiChu` = `12345` FROM `phong` WHERE `MaPhong` = `P01`;");
    
    $dtoList = $connection->execQuery($queryString);
    if ($dtoList == null)
    {
        echo "null";
    }else{
        $message = "OK";
        echo $queryString;
        echo $message;
    }
}

?>