<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    
    protected $primaryKey = 'roleId';
    protected $fillable = [
        'roleName','statusId',
    ];

    protected $casts = [
        'roleName' => 'array'
    ];
    public function user(){
        return $this->belongsToMany('User','users_roles');
    }
}
