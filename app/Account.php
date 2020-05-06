<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Account extends Model
{
    use Notifiable;
    protected $table = 'accounts';
    protected $primaryKey = 'accountId';

     protected $fillable = [
        'amount', 'charges','tax','customerId','email'
    ];

    public function user(){
    	return $this->belongsTo(User::class,'customerId');
    }
}
