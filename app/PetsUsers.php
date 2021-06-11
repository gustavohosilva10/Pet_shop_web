<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetsUsers extends Model
{
    protected $table = 'pets_user';

    protected $fillable = [
        'name_pet',
        'age',
        'weight',
        'breed',
        'sex_pet',
        'pet_picture',
        'id_user',
    ];
}
