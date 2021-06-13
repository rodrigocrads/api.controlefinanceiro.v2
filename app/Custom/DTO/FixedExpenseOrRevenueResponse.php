<?php

namespace FinancialControl\Custom\DTO;

use DateTimeImmutable;
use Illuminate\Database\Eloquent\Model;

class FixedExpenseOrRevenueResponse
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
            'category' => [
                'id' => $this->model->category->id,
                'name' => $this->model->category->name,
            ],
            'activation_control' => [
                "start_date" => $this->convertISODateToBR($this->model->activationControl->start_date),
                "end_date" => $this->convertISODateToBR($this->model->activationControl->end_date),
                "expiration_day" => $this->model->activationControl->expiration_day,
                "periodicity" => $this->model->activationControl->periodicity,
            ],
        ];
    }

    private function convertISODateToBR(?string $date): ?string
    {
        return !empty($date)
            ? (new DateTimeImmutable($date))->format('d/m/Y')
            : $date;
    }
}