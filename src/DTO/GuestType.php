<?php

namespace DTO;

require __DIR__ . "/DTOInterface.php";

class GuestTypeDTO implements DTOInterface
{
    private $maLoaiKhach;
    private $tenLoaiKhach;
    private $heSo;

    public function __construct($maLoaiKhach, $tenLoaiKhach, $heSo)
    {
        $this->maLoaiKhach = $maLoaiKhach;
        $this->tenLoaiKhach = $tenLoaiKhach;
        $this->heSo = $heSo;
    }

    public function getDBColumnMapper()
    {
        return [
            "MaLoaiKhach" => null,
            "TenLoaiKhach" => null,
            "HeSo" => null
        ];
    }

    public function getNewInstance($dbColumnMapper)
    {
        return new GuestTypeDTO(
            $dbColumnMapper["MaLoaiKhach"],
            $dbColumnMapper["TenLoaiKhach"],
            $dbColumnMapper["HeSo"]
        );
    }

    public function maLoaiKhach()
    {
        return $this->maLoaiKhach;
    }

    public function tenLoaiKhach()
    {
        return $this->tenLoaiKhach;
    }

    public function heSo()
    {
        return $this->heSo;
    }
}

?>
