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
            'title' => $this->model->title,
            'description' => $this->model->description,
            'value' => $this->model->value,
            'activation_control' => [
                "start_date" => $this->model->activationControl->start_date,
                "end_date" => $this->model->activationControl->end_date,
                "activation_day" => $this->model->activationControl->activation_day,
                "activation_type" => $this->model->activationControl->activation_type,
            ],
        ];
    }
}