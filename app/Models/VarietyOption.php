<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VarietyOption extends Model
{
    use HasFactory;
    protected $fillable = ['value','variety_id'];
    public function variety(){
        return $this->belongsTo(Variety::class);
    }
    public function productitem(){
        return $this->belongsToMany(ProductItem::class);
    }
    public function configItemProducts()
    {
        return $this->hasMany(ConfigItemProduct::class);
    }
}
