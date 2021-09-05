<?php

namespace FinancialControl\Models;

use FinancialControl\Custom\Traits\GlobalScopeByAuthUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FixedExpense extends Model
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
        'user_id',
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

    public function isActive(string $periodStartDate, string $periodEndDate = null): bool
    {
        $endDate = $this->activationControl->end_date;
        $startDate = $this->activationControl->start_date;

        $periodMonth = now()->createFromFormat('Y-m-d', $periodStartDate)->month;
        $periodEndDate = $periodEndDate ?? now();

        $isValidExpirationDay = true;
        if ($this->closesActivationThisMonth($periodMonth)) {
            $isValidExpirationDay = $this->isValidExpirationDay();
        }

        return strtotime($startDate) <= strtotime($periodEndDate)
            && ((empty($endDate)) || ( strtotime($endDate) >= strtotime($periodStartDate) ))
            && $isValidExpirationDay;
    }

    private function isValidExpirationDay()
    {
        $endDate = $this->activationControl->end_date;
        $expirationDay = $this->activationControl->expiration_day;

        if (empty($endDate)) return true;

        $endDateDay = now()->createFromFormat('Y-m-d', $endDate)->day;

        return $expirationDay <= $endDateDay;
    }

    private function closesActivationThisMonth(int $periodMonth): bool
    {
        $endDate = $this->activationControl->end_date;

        if (empty($endDate)) return false;

        $endDateMonth = now()->createFromFormat('Y-m-d', $endDate)->month;

        return $endDateMonth === $periodMonth;
    }

    public function hasAlreadyExpired(string $periodExpirationDay): bool
    {
        $expirationDay = $this->activationControl->expiration_day;

        return $periodExpirationDay >= $expirationDay;
    }
}
