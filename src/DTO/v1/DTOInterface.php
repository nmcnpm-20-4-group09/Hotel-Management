<?php

namespace DTOv1;

interface DTOInterface
{
    public function getDBColumnMapper();
    public function getNewInstance($dbColumnMapper);
    public function toDictionary();
    public static function getPrototype();
}

?>