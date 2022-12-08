<?php

namespace DTO;

class PersonDTO
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
