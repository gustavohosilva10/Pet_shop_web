<?php

namespace App\Http\Controllers\Api;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;
use App\Services\ResponseService;

class AuthController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user; 
    }

    public function login(Request $request)
    {
      $credentials = $request->only('email', 'password');
      try {
            $token = $this->user->login($credentials);
        } 
        catch (\Throwable|\Exception $e) {
            //return ResponseService::exception('users.login',null,$e);
            throw $e;
        }
      return response()->json(compact('token'));
    }

    public function logout(Request $request) {
        try {
            //$token = $this->user->logout($request->input('token'));
            $token = $this->user->logout($request->token);
        } catch (\Throwable|\Exception $e) {
            //return ResponseService::exception('users.logout',null,$e);
            throw $e;
        }
        return response(['status' => true,'msg' => 'Deslogado com sucesso'], 200); 
    }

    public function register(Request $request)
    {
            $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

}
