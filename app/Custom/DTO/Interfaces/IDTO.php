<?php

namespace App\Custom\DTO\Interfaces;

use App\Custom\Interfaces\Arrayable;

interface IDTO
{
    public function getDTO(): Arrayable;
}