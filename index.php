<?php

require_once './vendor/autoload.php';

use Octuspi\Querybuilder\Directors\Query;


$sql = Query::update()
            ->table('users')
            ->values(['name' => 'octuspi', 'email' => 'octus@mail', 'niver' => 334])
            ->where(['id' => 2])
            ->sql();

echo $sql;
