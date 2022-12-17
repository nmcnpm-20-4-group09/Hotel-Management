<?php

namespace DTO;

class BillDTO implements DTOInterface
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

    public function getDBColumnMapper()
    {
        return [
            "SoHoaDon" => null,
            "NgayThanhToan" => null,
            "TriGia" => null
        ];
    }

    public function getNewInstance($dbColumnMapper)
    {
        return new BillDTO(
            $dbColumnMapper["SoHoaDon"],
            $dbColumnMapper["SoHoaDon"],
            $dbColumnMapper["TriGia"]
        );
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