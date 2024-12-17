<?php
namespace Octuspi\Querybuilder\Directors;

use Octuspi\Querybuilder\Builders\Insert;
use Octuspi\Querybuilder\Builders\Update;
use Octuspi\Querybuilder\Contracts\Builder;



class Query
{
    public static function insert():Builder
    {
        return new Insert();
    }

    public static function update():Builder
    {
        return new Update();
    }
}