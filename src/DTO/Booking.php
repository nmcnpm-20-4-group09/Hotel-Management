<?php

namespace DTO;

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
            "IDKhachHang" => null,
            "NgayBatDauThue" => null,
            "SoNgayThue" => null,
            "MaPhong" => null
        ];
    }

    public function getNewInstance($dbColumnMapper)
    {
        return new BookingDTO(
            $dbColumnMapper["SoPhieuThue"],
            $dbColumnMapper["IDKhachHang"],
            $dbColumnMapper["NgayBatDauThue"],
            $dbColumnMapper["SoNgayThue"],
            $dbColumnMapper["MaPhong"]
        );
    }
    
    public function toDictionary()
    {
        return array(
            "SoPhieuThue" => $this->soPhieuThue,
            "IDKhachHang" => $this->idKhachHang,
            "NgayBatDauThue" => $this->ngayBatDauThue,
            "SoNgayThue" => $this->soNgayThue,
            "MaPhong" => $this->maPhong
        );
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