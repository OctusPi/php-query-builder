<?php 
namespace Octuspi\Querybuilder\Contracts;

interface Builder
{
    public function sql(): string;
    public function reset(): Builder;
    public function table(string $table): Builder;
    public function values(array $params): Builder;
    public function where(array $params): Builder;
    public function orwhere(array $params): Builder;
    public function between(array $params): Builder;
    public function order(array $params): Builder;

}