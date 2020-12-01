<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Foundation\Auth\Users as Authenticatable;

class Users extends Model 
{
    protected $table = "users";
    protected $primaryKey = 'UserId';

    protected $hidden = ['Password', 'remember_token'];

    public function operator()
    {
        return $this->hasOne('Operator::class');
    }


    public function is_admin()
    {
        if($this->RoleId == '3')
        {
            return true;
        }

        return false;
    }
}

