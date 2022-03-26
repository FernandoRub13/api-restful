<?php

namespace App\Models;


class Buyer extends User
{
    protected $guarded = ['id'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}
