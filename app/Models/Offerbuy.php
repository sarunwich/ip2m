<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offerbuy extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'profile_id',
        'endorser_id',
        'Interest_data',
        'offbuy_detail',
        'offbuy_date',
        'offerbuy_startdate',
        'offerbuy_enddate',
        'offerbuy_price',
    ];
   
    public function imagesbuy()
    {
        return $this->hasMany(ProductImagebuy::class, 'offerbuy_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
}
