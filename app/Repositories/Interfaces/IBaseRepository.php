<?php

namespace App\Repositories\Interfaces;

interface IBaseRepository
{
    public function create(array $data);

    public function update(array $data, $id);

    public function find($id);

    public function list(array $filters = []);

    public function delete($id);
}
