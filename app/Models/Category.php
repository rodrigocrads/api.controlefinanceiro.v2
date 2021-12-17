<?php

namespace FinancialControl\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use FinancialControl\Custom\Traits\GlobalScopeByAuthUserId;

class Category extends Model
{
    use SoftDeletes;
    use GlobalScopeByAuthUserId;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'user_id',
    ];

    public function variableRevenue()
    {
        return $this->hasMany(VariableRevenue::class);
    }

    public function variableExpense()
    {
        return $this->hasMany(VariableExpense::class);
    }

    public function hasSomeVariableExpense(): bool
    {
        return isset($this->variableExpense) && count($this->variableExpense) > 0;
    }

    public function hasSomeVariableRevenue(): bool
    {
        return isset($this->variableRevenue) && count($this->variableRevenue) > 0;
    }
}
