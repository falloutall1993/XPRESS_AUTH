<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;

class AuthController extends BaseController
{
    /**
     * Login api return Bearer Token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->phone, 'password' => $request->password])){
            $user                   = Auth::user();
            $success['token']       =  $user->createToken('MyApp')-> accessToken;

            return $this->sendResponse($success, 'User login successfully.');
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

    /**
     * Logout api
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        Auth()->user()->token()->revoke();

        return $this->sendResponse([], 'User logout successfully.');
    }
}
