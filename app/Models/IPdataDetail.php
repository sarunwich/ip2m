<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPdataDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'IPdata_id',
        'ipdetail_id',
        'IPdataDetail_data',
    ];
    public function IPdata()
    {
        return $this->belongsTo(IPdata::class);
    }
    public function IPdetail()
    {
        return $this->belongsTo(IPdetail::class,'ipdetail_id','ipdetail_id');
    }
    
}
