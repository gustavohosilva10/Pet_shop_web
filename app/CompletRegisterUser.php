<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompletRegisterUser extends Model
{
    protected $table = 'complete_register_user';

    protected $fillable = [
        'address',
        'telephone',
        'cellphone',
        'profile_picture',
        'cep_user',
        'id_user'
    ];
}
