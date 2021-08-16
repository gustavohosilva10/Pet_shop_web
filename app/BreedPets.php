<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BreedPets extends Model
{
    protected $table = 'breed_pet';

    protected $fillable = [
        'name',
        'type'
    ];
}
