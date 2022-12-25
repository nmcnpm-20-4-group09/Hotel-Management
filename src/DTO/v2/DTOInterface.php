<?php

namespace DTOv2;

interface DTOInterface
{
    public function getDBColumnMapper();
    public function getNewInstance($dbColumnMapper);
    public function toDictionary();
    public static function getPrototype();
}

?>