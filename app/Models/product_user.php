<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_user extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsToMany(User::class ,'user_id', 'id');
    }

    public function product()
    {
        return $this->belongsToMany(Product::class ,'product_id', 'id');
    }
}
