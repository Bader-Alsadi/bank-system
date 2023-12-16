<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authContoller extends Controller
{
    use ApiResponse;
    public function login(Request $request)
    {

        if (Auth::attempt($request->all())) {

            $user = request()->user();
            $user->tooken = $user->createToken('token-api')->plainTextToken;
            return $this->success_resposnes($user);
        } else return $this->fiald_resposnes();
    }
}
