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


    public function entry()
    {
        return $this->hasMany(Entry::class);
    }

    public function hasSomeEntry(): bool
    {
        return isset($this->entry) && count($this->entry) > 0;
    }
}
