<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $table = "role";
    protected $primaryKey = 'RoleId';
}
