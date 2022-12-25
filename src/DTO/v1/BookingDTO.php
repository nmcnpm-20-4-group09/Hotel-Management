<?php

namespace DTOv1;

require __DIR__ . "/DTOInterface.php";

class BookingDTO implements DTOInterface
{
    private $soPhieuThue;
    private $idKhachHang;
    private $ngayBatDauThue;
    private $soNgayThue;
    private $maPhong;

    public function __construct(
        $soPhieuThue,
        $idKhachHang,
        $ngayBatDauThue,
        $soNgayThue,
        $maPhong
    ) {
        $this->soPhieuThue = $soPhieuThue;
        $this->idKhachHang = $idKhachHang;
        $this->ngayBatDauThue = $ngayBatDauThue;
        $this->soNgayThue = $soNgayThue;
        $this->maPhong = $maPhong;
    }

    public function getDBColumnMapper()
    {
        return [
            "SoPhieuThue" => null,
            "ID_KhachHang" => null,
            "NgayBatDauThue" => null,
            "SoNgayThue" => null,
            "MaPhong" => null
        ];
    }

    public function getNewInstance($dbColumnMapper)
    {
        return new BookingDTO(
            $dbColumnMapper["SoPhieuThue"],
            $dbColumnMapper["ID_KhachHang"],
            $dbColumnMapper["NgayBatDauThue"],
            $dbColumnMapper["SoNgayThue"],
            $dbColumnMapper["MaPhong"]
        );
    }
    
    public function toDictionary()
    {
        return array(
            "SoPhieuThue" => $this->soPhieuThue,
            "ID_KhachHang" => $this->idKhachHang,
            "NgayBatDauThue" => $this->ngayBatDauThue,
            "SoNgayThue" => $this->soNgayThue,
            "MaPhong" => $this->maPhong
        );
    }

    public static function getPrototype()
    {
        return new BookingDTO(null, null, null, null, null);
    }

    public function soPhieuThue()
    {
        return $this->soPhieuThue;
    }

    public function idKhachHang()
    {
        return $this->idKhachHang;
    }

    public function ngayBatDauThue()
    {
        return $this->ngayBatDauThue;
    }

    public function soNgayThue()
    {
        return $this->soNgayThue;
    }

    public function maPhong()
    {
        return $this->maPhong;
    }
}

?>