<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

   
    protected $fillable = [
        'country_name',
       
    ];

    
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }


    use HasFactory;
}
