<?php

namespace App\Custom\DTO\Response;

use App\Custom\Interfaces\Arrayable;
use App\User;

class UserResponse implements Arrayable
{
    private $model;

    public function __construct(User $model)
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