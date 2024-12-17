<?php
namespace Octuspi\Querybuilder\Builders;

use Octuspi\Querybuilder\Contracts\Builder;
use Octuspi\Querybuilder\Security\Sanitize;



class Insert extends Query implements Builder
{
    protected string $base_sql = 'INSERT INTO {{table}} ({{params}}) VALUES ({{values}});';

    public function reset(): Builder
    {
        return new Insert();
    }
    
    public function values(array $params):self
    {
        $params = Sanitize::clear($params);

        $keys = implode(',', array_keys($params));
        $values = implode(',', array_map(function ($value) {
            return "'{$value}'";
        }, $params));

        $this->base_sql = str_replace(['{{params}}', '{{values}}'], ['params'=>$keys, 'values'=>$values], $this->base_sql);

        return $this;
    }
}