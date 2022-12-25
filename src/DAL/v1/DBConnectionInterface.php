<?php

namespace DALv1;

interface DBConnectionInterface
{
    public static function instance(); // Singleton
    public function execQuery(
        $queryString,
        $isReading = false,
        $dto = null
    );
}

?>