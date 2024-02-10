<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'ProductImage_id',
        'ProductImage_name',
        'pid',
        'path'
      
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
