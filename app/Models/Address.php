<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    public function Users() {
        return $this->belongsToMany(User::class );
    }
    public function Country()
    {
        return $this->belongsTo(Country::class);
    }
    use HasFactory;
}
