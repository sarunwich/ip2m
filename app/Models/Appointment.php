<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'sid',
        'rid',
        'appointment_time',
        'purpose1',
        'purpose2',
        'purpose3',
        'appointment_detail',
        'other'
    ];
    public function Seller()
    {
        return $this->belongsTo(Seller::class , 'sid', 'sid');
    }

}
