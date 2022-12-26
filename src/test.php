<?php

$response = file_get_contents('http://localhost/Hotel-Management/src/BLL/v2/GET/RoomList.php');
// echo $response;
$response = json_decode($response, true);
// echo $response;
echo $response["success"];
echo "</br>";
echo $response["message"];
echo "</br>";
foreach ($response["result"] as $item)
{
    echo $item["MaPhong"]; echo " ";
    echo $item["MaLoai"]; echo " ";
    echo $item["DonGia"]; echo " ";
    echo $item["TinhTrang"]; echo "</br>";
}


?>