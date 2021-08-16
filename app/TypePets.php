<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypePets extends Model
{
    protected $table = 'pet_category';

    protected $fillable = [
        'name',
        'type'
    ];
}
