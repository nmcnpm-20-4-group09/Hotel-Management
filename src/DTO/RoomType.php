<?php

namespace DTO;

class RoomTypeDTO implements DTOInterface
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

    public function getDBColumnMapper()
    {
        return [
            "MaLoai" => null,
            "SoLuongPhong" => null,
            "DonGia" => null,
            "SoLuongPhongTrong" => null,
            "LuongKhachToiDa" => null
        ];
    }

    public function getNewInstance($dbColumnMapper)
    {
        return new RoomTypeDTO(
            $dbColumnMapper["MaLoai"],
            $dbColumnMapper["SoLuongPhong"],
            $dbColumnMapper["DonGia"],
            $dbColumnMapper["SoLuongPhongTrong"],
            $dbColumnMapper["LuongKhachToiDa"]
        );
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