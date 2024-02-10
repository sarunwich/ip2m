<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [

        'profile_name',
        'institute',
        'profile_picture',
        'country',
        'address',
        'province',
        'district',
        'tombon',
        'zipcode',
        'tel',
        'website',
        'facebook',
        'twitter',
        'line',
        'Instagram',
        'rid',
       
    ];
    protected $primaryKey = 'profile_id';
}
