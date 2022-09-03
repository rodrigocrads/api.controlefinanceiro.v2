<?php

namespace App\Repositories;

interface IRepository
{
    public function create(array $data);

    public function update(array $data, $id);

    public function find($id);

    public function all();

    public function delete($id);
}
