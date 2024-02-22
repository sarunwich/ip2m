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

    // protected $primaryKey = 'sid';
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'id', 'sid')->orderBy('created_at','desc');
    }
    public function product()
    {
        return $this->belongsTo(Product::class ,'pid', 'id');
    }
    public function profile()
    {
        return $this->belongsTo(Profile::class ,'profile_id', 'profile_id');
    }
}
