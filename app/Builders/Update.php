<?php
namespace Octuspi\Querybuilder\Builders;

use Octuspi\Querybuilder\Contracts\Builder;
use Octuspi\Querybuilder\Security\Sanitize;



class Update extends Query implements Builder
{
    protected string $base_sql = 'UPDATE {{table}} SET ({{values}}) WHERE {{where}};';

    public function reset(): Builder
    {
        return new Insert();
    }

    public function where(array $params): self
    {
        $params = Sanitize::clear($params);
        $where = implode(' AND ', array_map(function ($k, $v) {
            return "{$k}={$v}";
        }, array_keys($params), $params));

        $this->base_sql = str_replace('{{where}}', $where, $this->base_sql);
        return $this;
    }
    public function orwhere(array $params): self
    {
        return $this;
    }

    public function values(array $params):self
    {
        $params = Sanitize::clear($params);
        $values = implode(' , ', array_map(function ($k, $v) {
            return "'{$k}'='{$v}'";
        }, array_keys($params), $params));

        $this->base_sql = str_replace('{{values}}', $values, $this->base_sql);
        return $this;
    }
}