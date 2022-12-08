<?php

namespace DTO;

class RoomDTO
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
