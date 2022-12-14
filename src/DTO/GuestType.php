<?php

namespace DTO;

class GuestTypeDTO
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
