<?php
    $SoPhieuThue = $_GET["SoPhieuThue"];
    $SoHoaDon = $_GET["SoHoaDon"];

    $success = TRUE;
    $message = "";
    $result = [];

    $pattern = "/^[0-9]*$/";

    $isValidData = (
        preg_match($pattern, $SoPhieuThue) and
        preg_match($pattern, $SoHoaDon)
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

        $connect = new mysqli($servername, $user, $password, $database);
    
        if ($connect->connect_error) 
        {
            $success = FALSE;
            $message = 
                "execQuery(...): "
                ."(".$connect->connect_errno . ") "
                .$connect->connect_error;
        }
        else
        {
            $sqlQuery = "call sp_chiTietHoaDon(".$SoPhieuThue.", ".$SoHoaDon.");";

            $data = $connect->query($sqlQuery);

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
            $connect->close(); 
        } // if ($connect->connect_error) 
    } // if (!$isValidData) else
    
    $response = array(
        'success' => $success,
        'message' => $message,
        'result' => $result
    );
    
    echo json_encode($response);
?>