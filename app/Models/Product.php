<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'product_name',
        'price',
        'highlight',
        'product_detail',
        'display',
        'keyword',
        'category_id',
        'group_id',
        'IPdata_id',
        
    ];
    // public function pimgage()
    // {
    //     return $this->hasOne(ProductImage::class);
    // }
    public function IPdata()
    {
        return $this->belongsTo(IPdata::class,'id', 'IPdata_id');
    }
    public function IPdatails()
    {
        return $this->hasMany(IPdataDetail::class, 'IPdata_id', 'IPdata_id');
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'pid', 'id');
    }
}
