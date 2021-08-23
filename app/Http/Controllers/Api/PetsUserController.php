<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\CompleteRegisteUser;

class CompleteRegisterUserController extends Controller
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
          
            $complete_user = new CompleteRegisteUser();
            $complete_user->address = $request->input('address');
            $complete_user->telephone = $request->input('telephone');
            $complete_user->cellphone = $request->input('cellphone');
            $complete_user->id_user = $request->input('id_user');
       
            if ($request->file('profile_picture') === null) {
                $nome = "";
            }else{
            
                if (!File::isDirectory('storage/profile-picture/'.$request->input('id_user')) {
                    File::makeDirectory('storage/profile-picture/'.$request->input('id_user'));
                }

                $extension = $request->profile_picture->getClientOriginalExtension();
                $name = time().'.' . $extension;
                $picture = $request->file('profile_picture');
                $picture->storeAs('profile-picture/'.$request->input('id_user'), $name);

            }    
            $complete_user->profile_picture = $nome;
            $complete_user->save();

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