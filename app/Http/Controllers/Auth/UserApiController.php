<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Actions\User\ChangePasswordAction;
use App\Actions\User\UpdateAction;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\UpdateRequest;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    public function logout()
    {
        if (Auth::check()) {
            /** @var User */
            $user = Auth::user();

            $user->removeSessions();
            $user->token()->revoke();
            $user->removeRememberToken();

            return response()->json('', 200);
        } else {

            return response()->json('', 500);
        }
    }

    public function update(UpdateRequest $request)
    {
        try {
            $action = resolve(UpdateAction::class, [
                'data' => [
                    'id' => Auth::user()->id,
                    'data' => $request->validated()
                ]
            ]);

            return response()->json($action->run());

        } catch (Exception $e) {

            return response()->json("", $e->getCode());
        }
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $action = resolve(ChangePasswordAction::class, [
                'data' => [
                    'id' => $request->user()->id,
                    'data' => $request->validated()
                ]
            ]);

            $action->run();

            return response()->json('');

        } catch (Exception $e) {

            return response()->json("", $e->getCode());
        }
    }
}
