<?php

namespace DTOv1;

require __DIR__ . "/DTOInterface.php";

class RoomDTO implements DTOInterface
{
    private $maPhong;
    private $maLoai;
    private $tinhTrang;
    private $ghiChu;

    public function __construct($maPhong, $maLoai, $tinhTrang, $ghiChu)
    {
        $this->maPhong = $maPhong;
        $this->maLoai = $maLoai;
        $this->tinhTrang = $tinhTrang;
        $this->ghiChu = $ghiChu;
    }

    public function getDBColumnMapper()
    {
        return [
            "MaPhong" => null,
            "MaLoai" => null,
            "TinhTrang" => null,
            "GhiChu" => null
        ];
    }

    public function getNewInstance($dbColumnMapper)
    {
        return new RoomDTO(
            $dbColumnMapper["MaPhong"],
            $dbColumnMapper["MaLoai"],
            $dbColumnMapper["TinhTrang"],
            $dbColumnMapper["GhiChu"]
        );
    }

    public function toDictionary()
    {
        return array(
            "MaPhong" => $this->maPhong,
            "MaLoai" => $this->maLoai,
            "TinhTrang" => $this->tinhTrang,
            "GhiChu" => $this->ghiChu
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