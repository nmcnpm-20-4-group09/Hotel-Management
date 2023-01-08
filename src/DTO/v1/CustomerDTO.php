<?php

namespace DTOv1;

require __DIR__ . "/DTOInterface.php";

class CustomerDTO implements DTOInterface
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
            "ID_KhachHang" => null,
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
        return new CustomerDTO(
            $dbColumnMapper["ID_KhachHang"],
            $dbColumnMapper["LoaiKhach"],
            $dbColumnMapper["HoTen"],
            $dbColumnMapper["NgaySinh"],
            $dbColumnMapper["DiaChi"],
            $dbColumnMapper["SoDienThoai"],
            $dbColumnMapper["CMND"]
        );
    }

    public function toDictionary()
    {
        return array(
            "IDKhachHang" => $this->idKhachHang,
            "LoaiKhach" => $this->loaiKhach,
            "HoTen" => $this->hoTen,
            "NgaySinh" => $this->ngaySinh,
            "DiaChi" => $this->diaChi,
            "SoDienThoai" => $this->soDienThoai,
            "CMND" => $this->cmnd
        );
    }

    public static function getPrototype()
    {
        return new CustomerDTO(null, null, null, null, null, null, null);
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
