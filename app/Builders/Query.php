<?php
namespace Octuspi\Querybuilder\Builders;

use Octuspi\Querybuilder\Contracts\Builder;

abstract class Query implements Builder
{
    protected string $base_sql = '';

    public function reset(): Builder
    {
        return $this;
    }

    public function sql(): string{
        return $this->base_sql;
    }

    public function table(string $table): self
    {
        $this->base_sql = str_replace('{{table}}', $table, $this->base_sql);
        return $this;
    }

    public function where(array $params): self
    {
        return $this;
    }
    public function orwhere(array $params): self
    {
        return $this;
    }
    public function between(array $params): self
    {
        return $this;
    }
    public function order(array $params): self
    {
        return $this;
    }

    public function values(array $params):self
    {
        return $this;
    }
}