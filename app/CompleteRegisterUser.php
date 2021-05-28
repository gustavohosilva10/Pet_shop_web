<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class CompleteRegisteUser extends Model
{
    protected $table = 'complete_register_user';

    protected $fillable = [
        'address',
        'telephone',
        'cellphone',
        'profile_picture',
        'cep_user'
        'id_user'
    ];
}
