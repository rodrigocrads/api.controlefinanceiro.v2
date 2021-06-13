<?php

namespace FinancialControl\Custom\DTO;

use FinancialControl\Models\FixedRevenue;

class FixedRevenueResponse
{
    private $model;

    public function __construct(FixedRevenue $model)
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
            'activation_control' => [
                "start_date" => $this->model->activationControl->start_date,
                "end_date" => $this->model->activationControl->end_date,
                "expiration_day" => $this->model->activationControl->activation_day,
                "periodicity" => $this->model->activationControl->periodicity,
            ],
        ];
    }
}