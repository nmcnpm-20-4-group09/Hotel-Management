<?php

namespace DTO;

class BillDetailDTO
{
    private $soPhieuThue;
    private $soHoaDon;
    private $soNgayThueThuc;
    private $tienThuePhong;
    private $maPhuThu;

    public function __construct(
        $soPhieuThue,
        $soHoaDon,
        $soNgayThueThuc,
        $tienThuePhong,
        $maPhuThu
    ) {
        $this->soPhieuThue = $soPhieuThue;
        $this->soHoaDon = $soHoaDon;
        $this->soNgayThueThuc = $soNgayThueThuc;
        $this->tienThuePhong = $tienThuePhong;
        $this->maPhuThu = $maPhuThu;
    }

    public function soPhieuThue()
    {
        return $this->soPhieuThue;
    }

    public function soHoaDon()
    {
        return $this->soHoaDon;
    }

    public function soNgayThueThuc()
    {
        return $this->soNgayThueThuc;
    }

    public function tienThuePhong()
    {
        return $this->tienThuePhong;
    }

    public function maPhuThu()
    {
        return $this->maPhuThu;
    }
}

?>