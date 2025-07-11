<?php 

namespace App\Http\Controllers\api;

use App\Helper\ResponseBuilder;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Auth;
use Request;
class AuthController extends Controller{

    public function login(LoginRequest $request){
        $dataUser = $request->authenticate();
        $token = $dataUser->createToken("token", [])->plainTextToken;
        $data = ["token" => $token];
        return response ($data,200);
    }

    public function validateToken(Request $request){
        $user = Auth::user();
        $data = ["user" => $user];
        return response($data,200);
    }

}