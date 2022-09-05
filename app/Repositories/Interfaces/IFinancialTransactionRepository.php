<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface IFinancialTransactionRepository
{
    public function create(array $data);

    public function update(array $data, $id);

    public function find($id);

    public function list(array $filters = []);

    public function delete($id);

    public function getTotalExpenses(string $startDate, string $endDate): float;

    public function getTotalRevenues(string $startDate, string $endDate): float;

    public function getTotalExpensesByCategories(string $startDate, string $endDate): Collection;

    public function listByPeriod(string $startDate, string $endDate): Collection;
}
