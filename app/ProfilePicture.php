<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfilePicture extends Model
{
    protected $table = 'pictures_profile';

    protected $fillable = [
        'id_profile',
        'image'
    ];
}
