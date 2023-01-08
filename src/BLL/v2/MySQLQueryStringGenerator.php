<?php

namespace BLLv2;

class MySQLQueryStringGenerator
{
    public static function danhSachPhong()
    {
        $queryString = "call v2_sp_danhSachPhong();";
        return $queryString;
    }

    public static function danhSachHoaDon()
    {
        $queryString = "call v2_sp_danhSachHoaDon()";
        return $queryString;
    }

    public static function chiTietPhieuThue($soPhieuThue)
    {
        $queryString = "call v2_sp_chiTietPhieuThue(" . $soPhieuThue . ")";
        return $queryString;
    }
}

?>