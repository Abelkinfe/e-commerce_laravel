<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['category_name','parent_category_id'];
    public function products(){
        return $this->hasMany(Product::class);
    }

    /**
     * Summary of parent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(){
        return $this->belongsTo(Category::class,'parent_category_id');
    }
    public function child(){
        return $this->hasMany(Category::class, 'parent_category_id');
    }
    public function promotion() {
        return $this->belongsToMany(Promotion::class );
    }
}
