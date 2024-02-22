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
        return $this->belongsTo(IPdata::class,'IPdata_id','id' );
    }
    public function seller()
    {
        return $this->belongsTo(Seller::class ,'id', 'pid');
    }
    public function IPdatails()
    {
        return $this->hasMany(IPdataDetail::class, 'IPdata_id', 'IPdata_id');
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'pid', 'id');
    }
    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'product_user', 'product_id', 'user_id')->withTimestamps();
    }

    public function likesCount()
    {
        return $this->likedByUsers()->count();
    }

   
}
