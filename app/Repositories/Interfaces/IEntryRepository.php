<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface IEntryRepository
{
    public function create(array $data);

    public function update(array $data, $id);

    public function find($id);

    public function list(array $filters = []);

    public function delete($id);

    public function getTotalExpenses(string $startDate, string $endDate): float;

    public function getTotalRevenues(string $startDate, string $endDate): float;

    public function getTotalByCategory(string $type, string $startDate, string $endDate): Collection;

    public function listByPeriod(string $startDate, string $endDate): Collection;
}
