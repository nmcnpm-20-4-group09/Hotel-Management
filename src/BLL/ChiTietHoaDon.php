<?php

use BLL\MySQLQueryStringCreator;
use DAL\MySQLiConnection;

    $soPhieuThue = $_GET["SoPhieuThue"];
    $soHoaDon = $_GET["SoHoaDon"];

    $success = TRUE;
    $message = "";
    $result = [];

    $pattern = "/^[0-9]*$/";

    $isValidData = (
        preg_match($pattern, $soPhieuThue) and
        preg_match($pattern, $soHoaDon)
    );  

    if (!$isValidData) 
    {
        $success = FALSE;
        $message = "Invalid parameters!";
    }
    else
    {
        $user = 'root';
        $password = ''; 
        $database = 'HotelManagement';
        $servername= 'localhost';

        $connection = MySQLiConnection::instance();
    
        if ($connection == null) 
        {
            $success = FALSE;
            $message = "Unable to connect to the database!";
        }
        else
        {
            $queryString = MySQLQueryStringCreator::chiTietHoaDon($soPhieuThue, $soHoaDon);

            $data = $connection->query($queryString);

            while($row = $data->fetch_assoc())
            {
                $detail = array(
                    'SoPhieuThue' => $row['SoPhieuThue'],
                    'SoHoaDon' => $row['SoHoaDon'],
                    'SoNgayThueThuc' => $row['SoNgayThueThuc'],
                    'TienThuePhong' => $row['TienThuePhong'],
                    'MaPhuThu' => $row['MaPhuThu']
                );
                
                $result[] = $detail;
            }

            $success = TRUE;
            
            
            mysqli_free_result($data);
            $connection->close(); 
        } // if ($connection->connection_error) 
    } // if (!$isValidData) else
    
    $response = array(
        'success' => $success,
        'message' => $message,
        'result' => $result
    );
    
    echo json_encode($response);
?>