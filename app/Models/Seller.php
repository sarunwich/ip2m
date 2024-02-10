<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;
    protected $fillable = [

        'profile_id',
        'pid',
        'store_name',
        'id_number',
        'person_type',
        'accept',
        
    ];
    protected $primaryKey = 'sid';
}
