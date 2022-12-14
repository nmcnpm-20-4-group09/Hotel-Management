<?php

namespace DTO;

class BookingDetailDTO
{
    private $idKhachHang;
    private $soPhieuThue;


    public function __construct($idKhachHang, $soPhieuThue)
    {
        $this->idKhachHang = $idKhachHang;
        $this->soPhieuThue = $soPhieuThue;
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