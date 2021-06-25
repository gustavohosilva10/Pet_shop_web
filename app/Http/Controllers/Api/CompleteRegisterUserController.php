<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\CompletRegisterUser;
use App\ProfilePicture;
use App\Http\Requests\CreateCompleteRegisterUserRequest;
use DB;
use Illuminate\Support\Facades\Storage;
use File;
class CompleteRegisterUserController extends Controller
{
    public function index()
    {
        try {
            return CompletRegisterUser::all();
        } catch (\Throwable $th) {
            Log::error($th);
            throw $th;
        }
    }

    public function saveProfilePicture(Request $request)
    {
        try {
            $id_user = auth()->user()->id;
            $complete_user = new ProfilePicture();

            if ($request->file('image') == null) {
                $name = "";
            }else{
            
                if (!File::isDirectory('storage/PerfilUsuarios/'.$id_user)) {
                    File::makeDirectory('storage/PerfilUsuarios/'.$id_user);
                }

                $extension = $request->image->getClientOriginalExtension();
                $name = time().'.' . $extension;
                $picture = $request->file('image');
                $picture->storeAs('PerfilUsuarios/'.$id_user, $name);

            }    
            $complete_user->image = $name;
            $complete_user->id_profile = $id_user;
            $complete_user->save();

        } catch (\Throwable $th) {
            Log::error($th);
            throw $th;
        }
    }

    public function store(Request $request){
        try {
            
            $complete_user = new CompletRegisterUser();
            $complete_user->address = $request->input('address'); 
            $complete_user->telephone = $request->input('telephone');
            $complete_user->cellphone = $request->input('cellphone');
            $complete_user->id_user = auth()->user()->id;
            $complete_user->cep_user = $request->input('cep_user');
            $complete_user->save();

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function show($id){
        try {
            $complete_user = CompletRegisterUser::findOrFail($id);

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