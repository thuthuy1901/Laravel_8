<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'content'
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class, 'customer_id', 'id');
    }
}
