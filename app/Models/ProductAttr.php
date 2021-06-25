<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttr extends Model
{
    use HasFactory;
    protected $table='product_attr';
    protected $primaryKey='id';
    protected $fillable=['sku','size','price','stock'];

    public function products(){
        return $this->belongsTo(Product::class);
    }
}
