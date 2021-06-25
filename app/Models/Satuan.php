<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;

    protected $table = "satuan";

    protected $primaryKey="id";
    
    public function product(){
    	return $this->hasOne('App\Models\Product');
    }
    
}
