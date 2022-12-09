<?php

namespace DTO;

class RoomTypeDTO
{
    private $maLoai;
    private $soLuongPhong;
    private $donGia;
    private $soLuongPhongTrong;
    private $luongKhachToiDa;

    public function __construct(
        $maLoai,
        $soLuongPhong,
        $donGia,
        $soLuongPhongTrong,
        $luongKhachToiDa
    ) {
        $this->maLoai = $maLoai;
        $this->soLuongPhong = $soLuongPhong;
        $this->donGia = $donGia;
        $this->soLuongPhongTrong = $soLuongPhongTrong;
        $this->luongKhachToiDa = $luongKhachToiDa;
    }

    public function maLoai()
    {
        return $this->maLoai;
    }

    public function soLuongPhong()
    {
        return $this->soLuongPhong;
    }

    public function donGia()
    {
        return $this->donGia;
    }

    public function soLuongPhongTrong()
    {
        return $this->soLuongPhongTrong;
    }

    public function luongKhachToiDa()
    {
        return $this->luongKhachToiDa;
    }
}

?>