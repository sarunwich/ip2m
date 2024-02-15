<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPdetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'ipdetail_name',
        'type',
        'require',
    ];
    protected $primaryKey = 'ipdetail_id';
}
