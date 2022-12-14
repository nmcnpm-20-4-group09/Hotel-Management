<?php

namespace DTO;

class BookingDTO
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