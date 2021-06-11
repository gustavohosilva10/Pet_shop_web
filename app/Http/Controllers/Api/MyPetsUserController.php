<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\PetsUsers;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateCompleteRegisterUserRequest;
use File;
use DB;

class CompleteRegisterUserController extends Controller
{
    public function index()
    {
        try {
            return PetsUsers::all();
        } catch (\Throwable $th) {
            Log::error($th);
            throw $th;
        }
    }

    public function savePetPicture(Request $request)
    {
        try {
            $id_user = auth()->user()->id;
            $pet_picture = new PetsUsers();

            if ($request->file('pet_picture') === null) {
                $nome = "";
            }else{
            
                if (!File::isDirectory('storage/PetsUsuario/profile-picture'.$id_user)) {
                    File::makeDirectory('storage/PetsUsuario/profile-picture'.$id_user);
                }

                $extension = $request->pet_picture->getClientOriginalExtension();
                $name = time().'.' . $extension;
                $picture = $request->file('pet_picture');
                $picture->storeAs('pet-picture', $name);

            }    
            
            $pet_picture->pet_picture = $nome;
            $pet_picture->save();

        } catch (\Throwable $th) {
            Log::error($th);
            throw $th;
        }
    }

    public function store(Request $request){
        try {
            
            $register_pet = new PetsUsers();
            $register_pet->name_pet = $request->input('name_pet'); 
            $register_pet->age = $request->input('age');
            $register_pet->weight = $request->input('weight');
            $register_pet->breed = $request->input('breed');
            $register_pet->sex_pet = $request->input('sex_pet');
            $register_pet->id_user = auth()->user()->id;
            $register_pet->save();

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function show($id){
        try {
            $edit_register_pet = PetsUsers::findOrFail($id);

            if (isset($edit_register_pet)) {
                return response()->json($edit_register_pet);
            }

            return response('Pet não encontrado', 404);
        } catch (\Throwable $th) {
            return response()->json(['error', $th]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $update_register_pet = PetsUsers::findOrFail($id);

            $update_register_pet->update($request->all());

        } catch (\Throwable $th) {
            throw $th;
        }

    }
}