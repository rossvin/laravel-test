<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    public function transaction()
    {
        return $this->hasMany('App\Transaction');
    }

    public function deposit()
    {
        return $this->hasMany('App\Deposit');
    }
}
