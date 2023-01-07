<?php

namespace DTOv2;

require __DIR__ . "/DTOInterface.php";

class BillDTO implements DTOInterface
{
    private $soHoaDon;
    private $idKhachHang;
    private $ngayThanhToan;
    private $triGia;

    public function __construct($soHoaDon, $idKhachHang, $ngayThanhToan, $triGia)
    {
        $this->soHoaDon = $soHoaDon;
        $this->idKhachHang = $idKhachHang;
        $this->ngayThanhToan = $ngayThanhToan;
        $this->triGia = $triGia;
    }

    public function getDBColumnMapper()
    {
        return [
            "SoHoaDon" => null,
            "ID_KhachHang" => null,
            "NgayThanhToan" => null,
            "TriGia" => null
        ];
    }

    public function getNewInstance($dbColumnMapper)
    {
        return new BillDTO(
            $dbColumnMapper["SoHoaDon"],
            $dbColumnMapper["ID_KhachHang"],
            $dbColumnMapper["NgayThanhToan"],
            $dbColumnMapper["TriGia"]
        );
    }

    public function toDictionary()
    {
        return array(
            "SoHoaDon" => $this->soHoaDon,
            "ID_KhachHang" => $this->idKhachHang,
            "NgayThanhToan" => $this->ngayThanhToan,
            "TriGia" => $this->triGia
        );
    }

    public static function getPrototype()
    {
        return new BillDTO(null, null, null, null);
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

    public function idKhachHang()
    {
        return $this->idKhachHang;
    }
}

?>