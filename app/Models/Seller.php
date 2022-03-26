<?php

namespace App\Models;

class Seller extends User
{
    protected $guarded = ['id'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
