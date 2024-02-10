<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPdata extends Model
{
    use HasFactory;
    protected $fillable = [
        'iptype_id',
        'rid',
    ];
    public function IPdataDetail()
    {
        return $this->hasMany(IPdataDetail::class ,'IPdata_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class ,'IPdata_id', 'id');
    }
}
