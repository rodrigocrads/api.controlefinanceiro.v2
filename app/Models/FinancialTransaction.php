<?php

namespace App\Models;

use App\Custom\DTO\IDTO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Custom\Traits\GlobalScopeByAuthUserId;
use App\Custom\DTO\Response\FinancialTransactionResponse;

class FinancialTransaction extends Model implements IFilterMapper
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
        'type',
        'category_id',
        'register_date',
        'user_id',
    ];

    protected $casts = [
        ['value', 'double'],
    ];

    public function category()
    {
        return $this->belongsTo(Category::class); 
    }

    public function getDTO(): IDTO
    {
        return new FinancialTransactionResponse($this);
    }

    public function getFiltersMapper(): array
    {
        return [
            'title' => [
                'field' => 'title',
                'operator' => 'like',
            ],
            'type' => [
                'field' => 'type',
                'operator' => '=',
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
                'operator' => '<=',
            ]
        ];
    }
}
