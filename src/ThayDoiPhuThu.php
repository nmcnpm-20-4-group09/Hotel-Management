<?php
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

    $isValidData = (
        preg_match($regex_MaPhuThu, $MaPhuThu) and
        preg_match($regex_TiLeMoi, $TiLeMoi)
    );  

    if (!$isValidData) 
    {
        $success = FALSE;
        $message = "Invalid parameters! "
            ."Valid: MaPhuThu -> VARCHAR(5), "
            ."TiLeMoi  -> DOUBLE";
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
            $sqlQuery = "call sp_doiTiLePhuThu ('".$MaPhuThu."', ".$TiLeMoi.")";

            $data = $connect->query($sqlQuery);
            
            while($row = $data->fetch_assoc())
            {
                $surcharge = array(
                    'MaPhuThu' => $row['MaPhuThu'],
                    'TenPhuThu' => $row['TenPhuThu'],
                    'TiLe' => $row['TiLe']
                );
                
                $result[] = $surcharge;
            }

            if (count($result) == 0)
            {
                $success = FALSE;
                $message = "Không tồn tại loại phụ thu có mã '".$MaPhuThu."'";
            }
            else
            {
                $success = TRUE;
            }

            
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