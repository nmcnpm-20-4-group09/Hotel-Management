<?php

namespace DTO;

class GuestDTO implements DTOInterface
{
    private $idKhachHang;
    private $loaiKhach;
    private $hoTen;
    private $ngaySinh;
    private $diaChi;
    private $soDienThoai;
    private $cmnd;

    public function __construct(
        $idKhachHang,
        $loaiKhach,
        $hoTen,
        $ngaySinh,
        $diaChi,
        $soDienThoai,
        $cmnd
    ) {
        $this->idKhachHang = $idKhachHang;
        $this->loaiKhach = $loaiKhach;
        $this->hoTen = $hoTen;
        $this->ngaySinh = $ngaySinh;
        $this->diaChi = $diaChi;
        $this->soDienThoai = $soDienThoai;
        $this->cmnd = $cmnd;
    }

    public function getDBColumnMapper()
    {
        return [
            "IDKhachHang" => null,
            "LoaiKhach" => null,
            "HoTen" => null,
            "NgaySinh" => null,
            "DiaChi" => null,
            "SoDienThoai" => null,
            "CMND" => null
        ];
    }

    public function getNewInstance($dbColumnMapper)
    {
        return new GuestDTO(
            $dbColumnMapper["IDKhachHang"],
            $dbColumnMapper["LoaiKhach"],
            $dbColumnMapper["HoTen"],
            $dbColumnMapper["NgaySinh"],
            $dbColumnMapper["DiaChi"],
            $dbColumnMapper["SoDienThoai"],
            $dbColumnMapper["CMND"]
        );
    }

    public function idKhachHang()
    {
        $this->idKhachHang;
    }

    public function loaiKhach()
    {
        $this->loaiKhach;
    }

    public function hoTen()
    {
        $this->hoTen;
    }

    public function ngaySinh()
    {
        $this->ngaySinh;
    }

    public function diaChi()
    {
        $this->diaChi;
    }

    public function soDienThoai()
    {
        $this->soDienThoai;
    }

    public function cmnd()
    {
        $this->cmnd;
    }
}

?>
