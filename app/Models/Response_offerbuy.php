<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response_offerbuy extends Model
{
    use HasFactory;
    protected $fillable = [
        'res_id',
        'offerbuy_id',
        'response_date',
        'response_detail',
        'status',  
    ];
}
