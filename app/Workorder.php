<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workorder extends Model
{
    public $table = "workorder";
    protected $primaryKey = 'WOId';
}
