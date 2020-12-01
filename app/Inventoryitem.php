<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventoryitem extends Model
{
    public $table = "inventoryitem";
    protected $primaryKey = 'InvId';
}
