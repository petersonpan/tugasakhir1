<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    //public $timestamps=true;
    // protected $casts=[
    //     'price' => 'float'
    // ];
    //protected $fillable=[
        //'cat_id','name','description','price','created_at'
    //];

    public function Category(){
    	return $this->belongsTo(Category::class,"cat_id","id");
    }

    public function Satuan(){
        return $this->belongsTo(Satuan::class,"satuan_id","id");
    }

    public function attributes(){
        return $this->hasMany(ProductAttr::class,"products_id","id");
    }

    public function ImageModel(){
        return $this->hasOne(ImageModel::class);
    }

}
