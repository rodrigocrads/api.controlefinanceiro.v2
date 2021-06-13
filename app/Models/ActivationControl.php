<?php

namespace FinancialControl\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivationControl extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_date',
        'end_date',
        'activation_type',
        'activation_day',
        'fixed_revenue_id',
        'fixed_expense_id',
    ];
}
