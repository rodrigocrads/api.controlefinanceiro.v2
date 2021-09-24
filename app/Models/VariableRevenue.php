<?php

namespace FinancialControl\Models;

use FinancialControl\Custom\DTO\IDTO;
use FinancialControl\Custom\DTO\Response\VariableExpenseOrRevenueResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use FinancialControl\Custom\Traits\GlobalScopeByAuthUserId;

class VariableRevenue extends Model implements IFilterMapper
{
    use SoftDeletes;
    use GlobalScopeByAuthUserId;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'value',
        'category_id',
        'register_date',
        'user_id',
    ];

    protected $casts = [
        ['value', 'double']
    ];

    public function category()
    {
        return $this->belongsTo(Category::class); 
    }

    public function getDTO(): IDTO
    {
        return new VariableExpenseOrRevenueResponse($this);
    }

    public function getFiltersMapper(): array
    {
        return [
            'title' => [
                'field' => 'title',
                'operator' => 'like',
            ],
            'category_id' => [
                'field' => 'category_id',
                'operator' => '=',
            ],
            'start_date' => [
                'field' => 'register_date',
                'operator' => '>=',
            ],
            'end_date' => [
                'field' => 'register_date',
                'operator' => '<',
            ]
        ];
    }
}
