<?php

namespace Demo\PhpMvc\Repositories;

interface Repository
{
    public function create($model);

    public function update(int $id, $model);

    public function read(int $id);

    public function delete(int $id);

    public function index();

    public function find(string $param);
}
