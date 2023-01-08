<?php

namespace DTOv2;

require __DIR__ . "/DTOInterface.php";

class BookingDetailDTO implements DTOInterface
{
    private $idKhachHang;
    private $hoTen;
    private $loaiKhach;
    private $cmnd;
    private $diaChi;
    private $soPhieuThue;

    public function __construct(
        $idKhachHang, 
        $hoTen, 
        $loaiKhach,
        $cmnd,
        $diaChi,
        $soPhieuThue
    ) {
        $this->idKhachHang = $idKhachHang;
        $this->hoTen = $hoTen;
        $this->loaiKhach = $loaiKhach;
        $this->cmnd = $cmnd;
        $this->diaChi = $diaChi;
        $this->soPhieuThue = $soPhieuThue;
    }

    public function getDBColumnMapper()
    {
        return array(
            "ID_KhachHang" => null,
            "HoTen" => null,
            "LoaiKhach" => null,
            "CMND" => null,
            "DiaChi" => null,
            "SoPhieuThue" => null
        );
    }

    public function getNewInstance($dbColumnMapper)
    {
        return new BookingDetailDTO(
            $dbColumnMapper["ID_KhachHang"],
            $dbColumnMapper["HoTen"],
            $dbColumnMapper["LoaiKhach"],
            $dbColumnMapper["CMND"],
            $dbColumnMapper["DiaChi"],
            $dbColumnMapper["SoPhieuThue"]
        );
    }
   
    public function toDictionary()
    {
        return array(
            "ID_KhachHang" => $this->idKhachHang,
            "HoTen" => $this->hoTen,
            "LoaiKhach" => $this->loaiKhach,
            "CMND" => $this->cmnd,
            "DiaChi" => $this->diaChi,
            "SoPhieuThue" => $this->soPhieuThue
        );
    }

    public static function getPrototype()
    {
        return new BookingDetailDTO(null, null, null, null, null, null);
    }

    public function idKhachHang()
    {
        return $this->idKhachHang;
    }

    public function soPhieuThue()
    {
        return $this->soPhieuThue;
    }
}

?>