<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public $table = "permission";
    protected $primaryKey = 'PermissionId';
}
