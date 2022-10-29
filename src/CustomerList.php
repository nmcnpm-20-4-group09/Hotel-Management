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
        $sqlQuery = "call sp_danhSachKhachHang();";
        
        $data = $connect->query($sqlQuery);
        
        while($row = $data->fetch_assoc())
        {
            $customer = array(
                'ID_KhachHang' => $row['ID_KhachHang'],
                'LoaiKhach' => $row['LoaiKhach'],
                'HoTen' => $row['HoTen'],
                'NgaySinh' => $row['NgaySinh'],
                'DiaChi' => $row['DiaChi'],
                'SoDienThoai' => $row['SoDienThoai'],
                'CMND' => $row['CMND']
            );
            
            $result[] = $customer;
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