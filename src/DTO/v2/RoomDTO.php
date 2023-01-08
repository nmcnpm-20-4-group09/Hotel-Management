<?php

namespace DTOv2;

require __DIR__ . "/DTOInterface.php";

class RoomDTO implements DTOInterface
{
    private $maPhong;
    private $maLoai;
    private $donGia;
    private $tinhTrang;

    public function __construct($maPhong, $maLoai, $donGia, $tinhTrang)
    {
        $this->maPhong = $maPhong;
        $this->maLoai = $maLoai;
        $this->donGia = $donGia;
        $this->tinhTrang = $tinhTrang;
    }

    public function getDBColumnMapper()
    {
        return [
            "MaPhong" => null,
            "MaLoai" => null,
            "DonGia" => null,
            "TinhTrang" => null
        ];
    }

    public function getNewInstance($dbColumnMapper)
    {
        return new RoomDTO(
            $dbColumnMapper["MaPhong"],
            $dbColumnMapper["MaLoai"],
            $dbColumnMapper["DonGia"],
            $dbColumnMapper["TinhTrang"]
        );
    }

    public function toDictionary()
    {
        return array(
            "MaPhong" => $this->maPhong,
            "MaLoai" => $this->maLoai,
            "DonGia" => $this->donGia,
            "TinhTrang" => $this->tinhTrang
        );
    }

    public static function getPrototype()
    {
        return new RoomDTO(null, null, null, null);
    }

    public function maPhong()
    {
        return $this->maPhong;
    }

    public function maLoai()
    {
        return $this->maLoai;
    }

    public function tinhTrang()
    {
        return $this->tinhTrang;
    }

    public function ghiChu()
    {
        return $this->ghiChu;
    }
}

?>