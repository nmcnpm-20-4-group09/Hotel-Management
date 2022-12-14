<?php

namespace DTO;

class SurchargeDTO
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