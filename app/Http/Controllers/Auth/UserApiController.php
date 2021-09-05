<?php

namespace FinancialControl\Http\Controllers\Auth;

use FinancialControl\User;
use Illuminate\Support\Facades\Auth;
use FinancialControl\Http\Controllers\Controller;

class UserApiController extends Controller
{
    public function logout()
    {
        if (Auth::check()) {
            /** @var User */
            $user = Auth::user();

            $user->removeSessions();
            $user->token()->revoke();

            return response()->json('', 200);
        } else {

            return response()->json('', 500);
        }
    }
}
