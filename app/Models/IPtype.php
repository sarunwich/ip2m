<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPtype extends Model
{
    use HasFactory;
    protected $fillable = [
        'iptype_name',
      
    ];
}
