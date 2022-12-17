<?php

namespace DTO;

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
        return [
            "IDKhachHang" => null,
            "SoPhieuThue" => null
        ];
    }

    public function getNewInstance($dbColumnMapper)
    {
        return new BookingDetailDTO(
            $dbColumnMapper["IDKhachHang"],
            $dbColumnMapper["SoPhieuThue"]
        );
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