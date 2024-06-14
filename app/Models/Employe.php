<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;


   protected $primaryKey = 'id';


    protected $hidden = ['password'];

    protected $fillable = [
        'id',
        'fullname',
        'username',
        'password',
        'type_employe',
        'email',
        'phone_number',
        'file_cv'
    ];
}
