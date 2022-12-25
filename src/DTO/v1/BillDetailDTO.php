<?php

namespace DTOv1;

require __DIR__ . "/DTOInterface.php";

class BillDetailDTO implements DTOInterface
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

    public function getDBColumnMapper()
    {
        return array(
            "SoPhieuThue" => null,
            "SoHoaDon" => null,
            "SoNgayThueThuc" => null,
            "TienThuePhong" => null,
            "MaPhuThu" => null
        );
    }

    public function getNewInstance($dbColumnMapper)
    {
        $result = new BillDetailDTO(
            $dbColumnMapper["SoPhieuThue"],
            $dbColumnMapper["SoHoaDon"],
            $dbColumnMapper["SoNgayThueThuc"],
            $dbColumnMapper["TienThuePhong"],
            $dbColumnMapper["MaPhuThu"]
        );

        return $result;
    }

    public function toDictionary()
    {
        return array(
            "SoPhieuThue" => $this->soPhieuThue,
            "SoHoaDon" => $this->soHoaDon,
            "SoNgayThueThuc" => $this->soNgayThueThuc,
            "TienThuePhong" => $this->tienThuePhong,
            "MaPhuThu" => $this->maPhuThu
        );
    }

    public static function getPrototype()
    {
        return new BillDetailDTO(null, null, null, null, null);
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