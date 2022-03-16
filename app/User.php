<?php

namespace FinancialControl;

use FinancialControl\Custom\DTO\IDTO;
use FinancialControl\Custom\DTO\Response\UserResponse;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function removeRememberToken()
    {
        $this->remember_token = null;

        $this->save();
    }

    public function removeSessions()
    {
        \Illuminate\Support\Facades\DB::table('sessions')
            ->where('user_id', '=',  $this->id)
            ->delete();
    }

    public function getDTO(): IDTO
    {
        return new UserResponse($this);
    }
}
