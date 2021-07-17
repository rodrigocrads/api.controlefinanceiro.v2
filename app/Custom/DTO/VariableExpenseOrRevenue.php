<?php

namespace FinancialControl\Custom\DTO;

use Illuminate\Database\Eloquent\Model;

class VariableExpenseOrRevenue implements IDTO
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->model->id,
            'title' => $this->model->title,
            'description' => $this->model->description,
            'value' => (double) $this->model->value,
            'register_date' => $this->model->register_date,
            'category' => [
                'id' => $this->model->category->id,
                'name' => $this->model->category->name,
            ],
        ];
    }
}