




<?php
    $success = TRUE;
    $message = "";
    $result = [];

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
        $sqlQuery = "call sp_danhSachPhong();";

        $data = $connect->query($sqlQuery);

        while($row = $data->fetch_assoc())
        {
            $detail = array(
                'MaPhong' => $row['MaPhong'],
                'MaLoai' => $row['MaLoai'],
                'TinhTrang' => $row['TinhTrang'],
                'GhiChu' => $row['GhiChu']
            );
            
            $result[] = $detail;
        }

        $success = TRUE;
        
        mysqli_free_result($data);
        $connect->close(); 
    } // if ($connect->connect_error) 
    
    $response = array(
        'success' => $success,
        'message' => $message,
        'result' => $result
    );
    
    echo json_encode($response);
?>