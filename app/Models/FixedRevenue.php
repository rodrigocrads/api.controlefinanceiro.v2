<?php

namespace FinancialControl\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FixedRevenue extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'value',
    ];

    protected $casts = [
        ['value', 'double']
    ];

    public function activationControl()
    {
        return $this->hasOne(ActivationControl::class); 
    }
}