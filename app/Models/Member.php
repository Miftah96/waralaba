<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'phone',
        'photo',
        'id_card_number',
        'gender',
        'date_of_birth',
        'level'
    ];

}
