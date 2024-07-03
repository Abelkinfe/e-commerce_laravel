<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{  use HasFactory;
    protected $fillable = ['name','description','product_img','category_id','creator_user_id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function productItems(){
        return $this->hasMany(ProductItem::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
  
}
