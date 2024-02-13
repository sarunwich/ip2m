<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImagebuy extends Model
{
    use HasFactory;
    protected $fillable = [
       'ProductImagebuy_id',
        'ProductImagebuy_name',
        'path',
        'offerbuy_id',
    ];
    protected $primaryKey = 'ProductImagebuy_id';
    public function Offerbuy()
    {
        return $this->belongsTo(Offerbuy::class);
    }
}
