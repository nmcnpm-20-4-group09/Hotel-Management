<?php

namespace DTOv1;

require __DIR__ . "/DTOInterface.php";

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
            $dbColumnMapper["NgayThanhToan"],
            $dbColumnMapper["TriGia"]
        );
    }

    public function toDictionary()
    {
        return array(
            "SoHoaDon" => $this->soHoaDon,
            "NgayThanhToan" => $this->ngayThanhToan,
            "TriGia" => $this->triGia
        );
    }

    public static function getPrototype()
    {
        return new BillDTO(null, null, null);
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