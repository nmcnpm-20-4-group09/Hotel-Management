<?php

namespace DTO;

class BillDTO
{
    private $soHoaDon;
    private $ngayThanhToan;
    private $triGia;

    public function __construct($soHoaDon, $ngayThanhToan, $triGia)
    {
        $this->soHoaDon = $soHoaDon;
        $this->ngayThanhToan = $ngayThanhToan;
        $this->triGia = $triGia;
    }

    public function soHoaDon()
    {
        return $this->soHoaDon;
    }

    public function ngayThanhToan()
    {
        return $this->ngayThanhToan;
    }

    public function triGia()
    {
        return $this->triGia;
    }
}

?>