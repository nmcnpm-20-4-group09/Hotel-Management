<?php

namespace DTO;

class SurchargeDTO implements DTOInterface
{
    private $maPhuThu;
    private $tenPhuThu;
    private $tiLe;

    public function __construct($maPhuThu, $tenPhuThu, $tiLe)
    {
        $this->maPhuThu = $maPhuThu;
        $this->tenPhuThu = $tenPhuThu;
        $this->tiLe = $tiLe;
    }

    public function getDBColumnMapper()
    {
        return [
            "MaPhuThu" => null,
            "TenPhuThu" => null,
            "TiLe" => null
        ];
    }

    public function getNewInstance($dbColumnMapper)
    {
        return new SurchargeDTO(
            $dbColumnMapper["MaPhuThu"],
            $dbColumnMapper["TenPhuThu"],
            $dbColumnMapper["TiLe"]
        );
    }

    public function maPhuThu()
    {
        return $this->maPhuThu;
    }

    public function tenPhuThu()
    {
        return $this->tenPhuThu;
    }

    public function tiLe()
    {
        return $this->tiLe;
    }
}

?>