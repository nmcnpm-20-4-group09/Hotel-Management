<?php

$response = file_get_contents('http://localhost/hotel_management/src/BLL/v1/GET/CustomerTypeList.php');
// echo $response;
$response = json_decode($response, true);
// echo $response;
echo $response["success"];
echo "</br>";
echo $response["message"];
echo "</br>";
foreach ($response["result"] as $item)
{
    echo $item["MaLoaiKhach"]; echo " ";
    echo $item["TenLoaiKhach"]; echo " ";
    echo $item["HeSo"]; echo " ";
    echo "</br>";
}


?>