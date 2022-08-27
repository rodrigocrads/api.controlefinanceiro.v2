<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Custom\Traits\GlobalScopeByAuthUserId;

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


    public function financialTransaction()
    {
        return $this->hasMany(FinancialTransaction::class);
    }

    public function hasSomeFinancialTransaction(): bool
    {
        return isset($this->financialTransaction) && count($this->financialTransaction) > 0;
    }
}
