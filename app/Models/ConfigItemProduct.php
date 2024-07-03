<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigItemProduct extends Model
{
    use HasFactory;
    protected $fillable = ['product_item_id', 'variety_option_id'];

    public function productItem()
    {
        return $this->belongsTo(ProductItem::class);
    }

    public function varietyOption()
    {
        return $this->belongsTo(VarietyOption::class);
    }
}
