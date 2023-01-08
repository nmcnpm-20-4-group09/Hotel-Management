<?php

namespace DTOv1;

require __DIR__ . "/DTOInterface.php";

class BookingDetailDTO implements DTOInterface
{
    private $idKhachHang;
    private $soPhieuThue;


    public function __construct($idKhachHang, $soPhieuThue)
    {
        $this->idKhachHang = $idKhachHang;
        $this->soPhieuThue = $soPhieuThue;
    }

    public function getDBColumnMapper()
    {
        return array(
            "ID_KhachHang" => null,
            "SoPhieuThue" => null
        );
    }

    public function getNewInstance($dbColumnMapper)
    {
        return new BookingDetailDTO(
            $dbColumnMapper["ID_KhachHang"],
            $dbColumnMapper["SoPhieuThue"]
        );
    }
   
    public function toDictionary()
    {
        return array(
            "ID_KhachHang" => $this->idKhachHang,
            "SoPhieuThue" => $this->soPhieuThue
        );
    }

    public static function getPrototype()
    {
        return new BookingDetailDTO(null, null);
    }

    public function idKhachHang()
    {
        return $this->idKhachHang;
    }

    public function soPhieuThue()
    {
        return $this->soPhieuThue;
    }
}

?>