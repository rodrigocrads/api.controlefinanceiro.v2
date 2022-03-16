<?php

namespace FinancialControl\Http\Controllers\Auth;

use Exception;
use FinancialControl\Actions\User\UpdateAction;
use FinancialControl\User;
use Illuminate\Support\Facades\Auth;
use FinancialControl\Http\Controllers\Controller;
use FinancialControl\Http\Requests\User\UpdateRequest;
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
                    'id' => $request->route('id'),
                    'data' => array_merge(
                        $request->validated(),
                        [ 'user_id' => Auth::user()->id ]
                    ),
                ]
            ]);

            return response()->json($action->run());

        } catch (Exception $e) {

            return response()->json("", $e->getCode());
        }
    }

    public function me(Request $request)
    {
        try {
            /** @var User */
            $user = $request->user();

            return response()->json(
                $user->getDTO()
                    ->toArray()
            );

        } catch (Exception $e) {

            return response()->json("", $e->getCode());
        }
    }
}
