<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amphur extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'AMPHUR_ID',
        'AMPHUR_CODE',
        'AMPHUR_NAME',
        'AMPHUR_NAME_ENG',
        'GEO_ID',
        'PROVINCE_ID'
    ];
}
