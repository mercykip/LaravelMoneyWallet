<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $primarykey = 'transactionId';
    protected $fillable = [
        'amount', 'email','accountId',
    ];
    public function account(){
        return $this->belongsTo(Account::class,'accountId');
    }

}
