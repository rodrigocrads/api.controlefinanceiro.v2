<?php

namespace App\Models;

use App\Custom\DTO\Interfaces\IDTO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Custom\Traits\GlobalScopeByAuthUserId;
use App\Custom\DTO\Response\EntryResponse;
use App\Custom\Interfaces\Arrayable;
use App\Models\Interfaces\IFilterMapper;

class Entry extends Model implements IFilterMapper, IDTO
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

    public function getDTO(): Arrayable
    {
        return new EntryResponse($this);
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
