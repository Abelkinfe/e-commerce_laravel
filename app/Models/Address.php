<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    
    use HasFactory;
    protected $fillable = ['city', 'region', 'country_id'];
    protected $table = 'addresses';
public function Users() {
    return $this->belongsToMany(User::class );
}
public function Country()
{
    return $this->belongsTo(Country::class);
}
}
