<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\CompleteRegisteUser;

class CompleteRegisterUserController extends BaseController
{
    public function index()
    {
        try {
            return CompleteRegisteUser::all();
        } catch (\Throwable $th) {
            Log::error($th);
            throw $th;
        }
    }

    public function store(Request $request){
        try {
            $complete_user = CompleteRegisteUser::create($request->all());

            if ($complete_user) {
                return response()->json([ 
                    'gravou' => true,
                ]);
            } else {
                return response()->json([
                    'gravou' => false,
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function show($id){
        try {
            $complete_user = CompleteRegisteUser::findOrFail($id);

            if (isset($complete_user)) {
                return response()->json($complete_user);
            }

            return response('Endereço não encontrado', 404);
        } catch (\Throwable $th) {
            return response()->json(['error', $th]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $complete_user = CompleteRegisteUser::findOrFail($id);

            $complete_user->update($request->all());
            
        } catch (\Throwable $th) {
            throw $th;
        }

    }
}