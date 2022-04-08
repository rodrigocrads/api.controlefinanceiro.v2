<?php

namespace FinancialControl\Custom\DTO\Response;

use FinancialControl\Custom\DTO\IDTO;
use Illuminate\Database\Eloquent\Model;

class UserResponse implements IDTO
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
            'name' => $this->model->name,
            'email' => $this->model->email,
        ];
    }
}