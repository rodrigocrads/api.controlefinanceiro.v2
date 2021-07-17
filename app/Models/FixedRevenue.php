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
        'category_id',
    ];

    protected $casts = [
        ['value', 'double']
    ];

    public function activationControl()
    {
        return $this->hasOne(ActivationControl::class); 
    }

    public function category()
    {
        return $this->belongsTo(Category::class); 
    }

    public function isActive(string $startPeriod, ?string $endPeriod = null): bool
    {
        $endDate = $this->activationControl->end_date;
        $startDate = $this->activationControl->start_date;

        $startPeriod = $startPeriod ?? now();
        $endPeriod = $endPeriod ?? now();

        return $startDate >= $startPeriod && ((empty($endDate)) || $endDate >= $endPeriod);
    }

    public function hasExpiredDay(): bool
    {
        $currentDay = now()->day;
        $expirationDay = $this->activationControl->expiration_day;

        return $currentDay >= $expirationDay;
    }
}
